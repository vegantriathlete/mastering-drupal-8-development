<?php

namespace Drupal\iai_wea\Plugin\rest\resource;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\node\Entity\Node;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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
 * Provides a resource for a water eco action item.
 *
 * @RestResource(
 *   id = "iai_wea_resource",
 *   label = @Translation("Water eco action item"),
 *   uri_paths = {
 *     "canonical" = "/iai_wea/actions/{id}",
 *     "https://www.drupal.org/link-relations/create" = "/iai_wea/actions"
 *   }
 * )
 */
class WEAResource extends ResourceBase {

/******************************************************************************
 **                                                                          **
 ** We have chosen not to use the $nodeStorage service. Instead, we have     **
 ** opted to use Node:: to perform our operations. It was stricly a personal **
 ** choice based on our opinion that the code looks cleaner this way. The    **
 ** entity type manager is already being injected into our constructor anyway**
 ** and it would have been fine for us to retrieve node storage like         **
 **   $this->nodeStorage = $entity_type_manager->getStorage('node');         **
 ** as we have done in other code.                                           **
 **                                                                          **
 ******************************************************************************/

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
   * Responds to entity GET requests.
   *
   * Returns a water eco action item for the specified ID.
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
    if ($node = Node::load($id)) {
      $translatedNode = $node->getTranslation($this->currentLanguage->getId());

/******************************************************************************
 **                                                                          **
 ** Make sure that you check that the client has access! You don't want your **
 ** REST resources to create access bypass vulnerabilities.                  **
 **                                                                          **
 ******************************************************************************/
      $nodeAccess = $translatedNode->access('view', NULL, TRUE);
      if (!$nodeAccess->isAllowed()) {
        throw new AccessDeniedHttpException();
      }
      if ($node->getType() == 'water_eco_action' && $translatedNode->status->value == 1) {
        $record = [
          'title' => $translatedNode->getTitle(),
          'description' => $translatedNode->field_wea_description->value,
          'coordinates' => $translatedNode->field_wea_coordinates->value
        ];
      }
    }

/******************************************************************************
 **                                                                          **
 ** We don't need to worry about how to serialize our data. Drupal will take **
 ** care of that for us!                                                     **
 **                                                                          **
 ******************************************************************************/
    if (!empty($record)) {
      $response = new ResourceResponse($record, 200);
      $response->addCacheableDependency($record);
      return $response;
    }

/******************************************************************************
 **                                                                          **
 ** We need to make sure that our method returns something, even if that is  **
 ** an exception that we throw. Drupal will turn the exception into a        **
 ** response.                                                                **
 **                                                                          **
 ******************************************************************************/
    throw new NotFoundHttpException(t('Water eco action item with ID @id was not found', array('@id' => $id)));
  }
}
