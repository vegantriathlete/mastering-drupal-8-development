<?php

namespace Drupal\iai_wea\Plugin\rest\resource;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/******************************************************************************
 **                                                                          **
 ** @see:                                                                    **
 ** https://www.drupal.org/docs/8/api/restful-web-services-api/restful-web-services-api-overview
 ** and the "Creating REST resource plugins" section to learn more about     **
 ** uri_paths.                                                               **
 **                                                                          **
 ******************************************************************************/
/**
 * Provides a resource to list water eco action items.
 *
 * @RestResource(
 *   id = "iai_wea",
 *   label = @Translation("Water eco action item list"),
 *   uri_paths = {
 *     "canonical" = "/iai_wea/actions"
 *   }
 * )
 */
class WEAResourceList extends ResourceBase {

/******************************************************************************
 **                                                                          **
 ** This is an object, not just a language code.                             **
 **                                                                          **
 ******************************************************************************/
  /**
   * The currently selected language.
   *
   * @var \Drupal\Core\Language\Language
   */
  protected $currentLanguage;

  /**
   * The entity storage for water eco action items.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $nodeStorage;

/******************************************************************************
 **                                                                          **
 ** This is an example of Dependency Injection. The necessary objects are    **
 ** being injected through the class's constructor.                          **
 **                                                                          **
 ******************************************************************************/
  /**
   * Constructs a Drupal\wea\Plugin\rest\resource\WEAResourceList object.
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
    $this->nodeStorage = $entity_type_manager->getStorage('node');
  }

/******************************************************************************
 **                                                                          **
 ** To learn more about Symfony's service container visit:                   **
 **   http://symfony.com/doc/current/service_container.html                  **
 **                                                                          **
 ******************************************************************************/
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {

/******************************************************************************
 **                                                                          **
 ** If we plan to do anything in our constructor we need to call the parent  **
 ** constructor explicitly. Therefore, we need to ensure we've got all the   **
 ** necessary objects to pass to our parent.                                 **
 **                                                                          **
 ******************************************************************************/
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
   * Returns a list of water eco action items.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The response containing the list of items.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   */
  public function get() {

/******************************************************************************
 **                                                                          **
 ** We are just retrieving all of the water eco action items. In a real      **
 ** situation we might do something like inspecting query arguments to filter**
 ** and sort them by some other criteria.                                    **
 **                                                                          **
 ******************************************************************************/
    $result = $this->nodeStorage->getQuery()
      ->condition('type', 'water_eco_action')
      ->condition('langcode', $this->currentLanguage->getId())
      ->condition('status', 1)
      ->sort('title', 'ASC')
      ->execute();

    if ($result) {
      $items = $this->nodeStorage->loadMultiple($result);
      foreach ($items as $item) {
        $translatedItem = $item->getTranslation($this->currentLanguage->getId());

/******************************************************************************
 **                                                                          **
 ** Make sure that you check that the client has access! You don't want your **
 ** REST resources to create access bypass vulnerabilities.                  **
 **                                                                          **
 ******************************************************************************/
        $itemAccess = $translatedItem->access('view', NULL, TRUE);
        if ($itemAccess->isAllowed()) {
          $record[] = [
            'id' => $item->nid->value,
            'title' => $translatedItem->getTitle()
          ];
        }
      }
    }

/******************************************************************************
 **                                                                          **
 ** We don't need to worry about how to serialize our data. Drupal will take **
 ** care of that for us!                                                     **
 **                                                                          **
 ******************************************************************************/
    if (!empty($record)) {
      $response = new ResourceResponse($record);
      $response->addCacheableDependency(CacheableMetadata::createFromRenderArray([
        '#cache' => [
          'tags' => [
            'node_list',
          ],
        ],
      ]));
      return $response;
    }

/******************************************************************************
 **                                                                          **
 ** We need to make sure that our method returns something, even if that is  **
 ** an exception that we throw. Drupal will turn the exception into a        **
 ** response.                                                                **
 **                                                                          **
 ******************************************************************************/
    throw new NotFoundHttpException(t('No water eco action items were found.'));

  }
}
