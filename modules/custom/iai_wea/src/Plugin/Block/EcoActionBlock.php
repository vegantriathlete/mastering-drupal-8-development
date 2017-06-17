<?php

namespace Drupal\iai_wea\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an Eco action block with actions that are nearby.
 *
 * @Block(
 *   id = "eco_action_block",
 *   admin_label = @Translation("Nearby Eco Actions"),
 *   category = @Translation("Lists (Views)")
 * )
 */
class EcoActionBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity storage for aquifers.
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
   * Constructs an EcoActionBlock object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
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
 ** The ContainerFactoryPluginInterface is what gave us access to Symfony's  **
 ** service container. Plugins don't get access to the service container if  **
 ** they don't implement the ContainerFactoryPluginInterface.                **
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
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    // By default, the block will contain 5 items and set the radius to 10.
    return array(
      'block_count' => 5,
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $range = range(2, 20);
    $form['block_count'] = array(
      '#type' => 'select',
      '#title' => $this->t('Number of action items in block'),
      '#default_value' => $this->configuration['block_count'],
      '#options' => array_combine($range, $range),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['block_count'] = $form_state->getValue('block_count');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

/******************************************************************************
 **                                                                          **
 ** We are just retrieving all of the eco actions. In a real situation we    **
 ** would do something like filtering the actions so that they were within a **
 ** certain radius of the user.                                              **
 **                                                                          **
 ******************************************************************************/
    $result = $this->nodeStorage->getQuery()
      ->condition('type', 'water_eco_action')
      ->range(0, $this->configuration['block_count'])
      ->sort('title', 'ASC')
      ->execute();

    if ($result) {
      $items = $this->nodeStorage->loadMultiple($result);

      $build['list'] = [
        '#theme' => 'item_list',
        '#items' => [],
      ];
      foreach ($items as $item) {
        $url = Url::fromRoute('entity.node.canonical', array('node' => $item->nid->value));
        $build['list']['#items'][$item->id()] = [
          '#type' => 'markup',
          '#markup' => Link::fromTextAndUrl($item->label(), $url)->toString(),
        ];
      }
    }
    else {
      $build['no_items'] = [
        '#type' => 'markup',
        '#markup' => $this->t('There are no actions in your area.'),
      ];
    }
    $build['#cache']['tags'][] = 'node_list';
    return $build;
  }
}
