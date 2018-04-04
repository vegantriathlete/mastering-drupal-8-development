<?php

namespace Drupal\iai_ocean_temperature\Plugin\rest\resource;

use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Entity\EntityStorageException;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\iai_ocean_temperature\Entity\IaiOceanTemperature;
use Drupal\iai_ocean_temperature\IaiOceanTemperatureDataValidationInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Provides a resource for an ocean temperature data item.
 *
 * @RestResource(
 *   id = "iai_ocean_temperature_item",
 *   label = @Translation("Ocean Temperature Data item"),
 *   uri_paths = {
 *     "canonical" = "/iai_ocean_temperature/data/{id}",
 *     "https://www.drupal.org/link-relations/create" = "/iai_ocean_temperature/data"
 *   }
 * )
 */
class OceanTemperatureDataResource extends ResourceBase {

  /**
   * The currently selected language.
   *
   * @var \Drupal\Core\Language\Language
   */
  protected $currentLanguage;

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * The data validation service.
   *
   * @var \Drupal\iai_ocean_temperature\IaiOceanTemperatureDataValidationInterface
   */
  protected $dataValidationService;

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * Constructs a Drupal\iai_ocean_temperature\Plugin\rest\resource\OceanDataTemperatureResource object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   * @param \Drupal\Core\Session\AccountInterface $current_user
   *   The currently logged in user.
   * @param \Drupal\iai_ocean_temperature\IaiOceanTemperatureDataValidationInterface $data_validation_service
   *   The data validation service.
   * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
   *   The date formatter service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, $serializer_formats, LoggerInterface $logger, LanguageManagerInterface $language_manager, AccountInterface $current_user, IaiOceanTemperatureDataValidationInterface $data_validation_service, DateFormatterInterface $date_formatter) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
    $this->currentLanguage = $language_manager->getCurrentLanguage();
    $this->languageManager = $language_manager;
    $this->currentUser = $current_user;
    $this->dataValidationService = $data_validation_service;
    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {

    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('rest'),
      $container->get('language_manager'),
      $container->get('current_user'),
      $container->get('iai_ocean_temperature.data_validation_service'),
      $container->get('date.formatter')
    );
  }

  /**
   * Responds to entity GET requests.
   *
   * Returns an ocean temperature data item for the specified ID.
   *
   * @param string $id
   *   The ID of the object.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The response containing the entity with its accessible fields.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   */
  public function get($id) {
    if ($oceanTemperatureData = IaiOceanTemperature::load($id)) {
      $translatedOceanTemperatureData = $oceanTemperatureData->getTranslation($this->currentLanguage->getId());

      $oceanTemperatureAccess = $translatedOceanTemperatureData->access('view', NULL, TRUE);
      if (!$oceanTemperatureAccess->isAllowed()) {
        throw new AccessDeniedHttpException();
      }
      $record = [
        'label' => $translatedOceanTemperatureData->getLabel(),
        'coordinates' => $translatedOceanTemperatureData->getCoordinates(),
        'depth' => $translatedOceanTemperatureData->getDepth(),
        'temperature' => $translatedOceanTemperatureData->getTemperature(),
        'date' => $this->dateFormatter->format($translatedOceanTemperatureData->getReportedDate()),
        'reporter' => $translatedOceanTemperatureData->getReporter()
      ];
    }

    if (!empty($record)) {
      $response = new ResourceResponse($record, 200);
      $response->addCacheableDependency($translatedOceanTemperatureData);
      return $response;
    }

    throw new NotFoundHttpException(t('Ocean Temperature Data item with ID @id was not found', array('@id' => $id)));
  }

  /**
   * Responds to POST requests and saves a new ocean temperature data item.
   *
   * @param array $data
   *   The POST data.
   *
   * @return \Drupal\rest\ModifiedResourceResponse
   *   The HTTP response object.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   */
  public function post($data = NULL) {
    if ($data == NULL) {
      throw new BadRequestHttpException('No data received.');
    }

    if (!$this->currentUser->hasPermission('add iai_ocean_temperature entity')) {
      throw new AccessDeniedHttpException();
    }

    if (isset($data['language_code']) && (!in_array($data['language_code'], array_keys($this->languageManager->getLanguages())))) {
      throw new BadRequestHttpException('Language not defined on site.');
    }
    if (!isset($data['language_code'])) {
      $data['language_code'] = 'en';
    }

    if (!$this->dataValidationService->hasRequiredFields($data)) {
      $dataIsValid = FALSE;
    }
    elseif (!$this->dataValidationService->isValidCoordinates($data['coordinates'])) {
      $dataIsValid = FALSE;
    }
    elseif (!$this->dataValidationService->isValidDepth($data['depth'])) {
      $dataIsValid = FALSE;
    }
    elseif (!$this->dataValidationService->isValidTemperature($data['temperature'])) {
      $dataIsValid = FALSE;
    }
    elseif (!$this->dataValidationService->isValidDate($data['date'])) {
      $dataIsValid = FALSE;
    }
    else {
      $dataIsValid = TRUE;
    }
    if ($dataIsValid) {
      $oceanTemperatureDataItem = IaiOceanTemperature::create(
        array(
          'label' => $data['label'],
          'langcode' => $data['language_code'],
          'ot_coordinates' => $data['coordinates'],
          'ot_depth' => $data['depth'],
          'ot_temperature' => $data['temperature'],
          'ot_reported_date' => $data['date'],
          'ot_reporter' => $data['reporter']
        )
      );
      try {
        $oceanTemperatureDataItem->save();

        $this->logger->notice('Created Ocean Temperature Data item with ID %id.', array('%id' => $oceanTemperatureDataItem->id()));

        $url = $oceanTemperatureDataItem->urlInfo('canonical', ['absolute' => TRUE])->toString(TRUE);

        $response = new ModifiedResourceResponse($oceanTemperatureDataItem, 201, ['Location' => $url->getGeneratedUrl()]);
        return $response;
      }
      catch (EntityStorageException $e) {
        throw new HttpException(500, 'Internal Server Error', $e);
      }
    }
    else {
      throw new BadRequestHttpException('Invalid data received.');
    }
  }

}
