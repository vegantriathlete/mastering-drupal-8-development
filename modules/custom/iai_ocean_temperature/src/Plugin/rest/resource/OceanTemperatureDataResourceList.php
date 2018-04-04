<?php

namespace Drupal\iai_ocean_temperature\Plugin\rest\resource;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Provides a resource to list ocean temperature data items.
 *
 * @RestResource(
 *   id = "iai_ocean_temperature",
 *   label = @Translation("Ocean Temperature Data item list"),
 *   uri_paths = {
 *     "canonical" = "/iai_ocean_temperature/data"
 *   }
 * )
 */
class OceanTemperatureDataResourceList extends ResourceBase {

  /**
   * The currently selected language.
   *
   * @var \Drupal\Core\Language\Language
   */
  protected $currentLanguage;

  /**
   * The entity storage for ocean temperature data items.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $oceanTemperatureDataStorage;

  /**
   * Constructs a Drupal\iai_ocean_temperature\Plugin\rest\resource\OceanTemperatureDataResourceList object.
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
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, $serializer_formats, LoggerInterface $logger, LanguageManagerInterface $language_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
    $this->currentLanguage = $language_manager->getCurrentLanguage();
    $this->oceanTemperatureDataStorage = $entity_type_manager->getStorage('iai_ocean_temperature');
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
      $container->get('language_manager')
    );
  }

  /**
   * Responds to GET requests.
   *
   * Returns a list of ocean temperature data items.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The response containing the list of items.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   */
  public function get() {

/******************************************************************************
 **                                                                          **
 ** We are just retrieving all of the ocean temperature data items. In a     **
 ** real situation we would do something to filter and sort them by some     **
 ** criteria the request passed.                                             **
 **                                                                          **
 ******************************************************************************/
    $result = $this->oceanTemperatureDataStorage->getQuery()
      ->condition('langcode', $this->currentLanguage->getId())
      ->sort('label', 'ASC')
      ->execute();

    if ($result) {
      $items = $this->oceanTemperatureDataStorage->loadMultiple($result);
      foreach ($items as $item) {
        $translatedItem = $item->getTranslation($this->currentLanguage->getId());

        $itemAccess = $translatedItem->access('view', NULL, TRUE);
        if ($itemAccess->isAllowed()) {
          $record[] = [
            'id' => $item->id->value,
            'label' => $translatedItem->getLabel()
          ];
        }
      }
    }

    if (!empty($record)) {
      $response = new ResourceResponse($record);
      $response->addCacheableDependency(CacheableMetadata::createFromRenderArray([
        '#cache' => [
          'tags' => [
            'iai_ocean_temperature_list',
          ],
        ],
      ]));
      return $response;
    }

    throw new NotFoundHttpException(t('No ocean temperature data items were found.'));

  }
}
