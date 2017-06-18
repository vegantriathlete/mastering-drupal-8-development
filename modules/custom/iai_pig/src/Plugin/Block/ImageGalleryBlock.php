<?php

namespace Drupal\iai_pig\Plugin\Block;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Drupal\iai_product\ProductManagerServiceInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/******************************************************************************
 **                                                                          **
 ** The context ensures that the block is present only on node pages.        **
 **                                                                          **
 ** Whenever a node is saved it invalidates its cache context and the block  **
 ** will be rebuilt. We make use of this context in our build method with the**
 **   <code>$node = $this->getContextValue('node');</code>                   **
 **                                                                          **
 ** This block is not intended to be an "all powerful" block to be reused    **
 ** elsewhere. We are making certain assumptions to keep the example         **
 ** relatively simple.                                                       **
 **                                                                          **
 ******************************************************************************/
/**
 * Provides an image gallery block.
 *
 * @Block(
 *   id = "iai_product_image_gallery",
 *   admin_label = @Translation("Product Image Gallery"),
 *   category = @Translation("Image Display"),
 *   context = {
 *     "node" = @ContextDefinition(
 *       "entity:node",
 *       label = @Translation("Current Node")
 *     )
 *   }
 * )
 */
class ImageGalleryBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The Product Manager Service.
   *
   * @var \Drupal\iai_product\ProductManagerServiceInterface
   */
  protected $productManagerService;

  /**
   * The entity repository.
   *
   * @var \Drupal\Core\Entity\EntityRepositoryInterface
   */
  protected $entityRepository;

/******************************************************************************
 **                                                                          **
 ** This is an example of Dependency Injection. The necessary objects are    **
 ** being injected through the class's constructor.                          **
 **                                                                          **
 ******************************************************************************/
  /**
   * Constructs Product Image Gallery block object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\iai_product\ProductManagerServiceInterface $product_manager_service
   *   The Product Manager Service.
   * @param \Drupal\Core\Entity\EntityRepositoryInterface $entity_repository
   *   The entity repository.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ProductManagerServiceInterface $product_manager_service, EntityRepositoryInterface $entity_repository) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->productManagerService = $product_manager_service;
    $this->entityRepository = $entity_repository;
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
      $container->get('iai_product.product_manager_service'),
      $container->get('entity.repository')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    // By default, the block will display 5 thumbnails.
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
      '#title' => $this->t('Number of product images in block'),
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
    $build = array();

/******************************************************************************
 **                                                                          **
 ** @see:                                                                    **
 ** https://api.drupal.org/api/drupal/core!lib!Drupal!Component!Plugin!ContextAwarePluginBase.php/function/ContextAwarePluginBase%3A%3AgetContextValue/8.2.x
 **                                                                          **
 ******************************************************************************/
    $node = $this->getContextValue('node');

    // Determine if we are on a page that points to a product.
    $product = $this->getProduct($node);

    if ($product) {

      // Retrieve the product images
      $imageData = $this->productManagerService->retrieveProductImages($product);
      $blockCount = $this->configuration['block_count'];
      $itemCount = 0;
      $build['list'] = [
        '#theme' => 'item_list',
        '#items' => [],
      ];

/******************************************************************************
 **                                                                          **
 ** This logic is just to give some positive feedback that the block is being**
 ** rendered. In reality, we'd likely just not have the block render anything**
 ** in this situation.                                                       **
 **                                                                          **
 ******************************************************************************/
      $build['list']['#items'][0] = [
        '#type' => 'markup',
        '#markup' => $this->t('There were no product images to display.')
      ];

      while ($itemCount < $blockCount && isset($imageData[$itemCount])) {
        $file = File::load($imageData[$itemCount]['target_id']);
        $linkText = [
          '#theme' => 'image_style',
          '#uri' => $file->getFileUri(),
          '#style_name' => 'product_thumbnail',
          '#alt' => $imageData[$itemCount]['alt'],
        ];

/******************************************************************************
 **                                                                          **
 ** This is the Modal API.                                                   **
 ** @see: https://www.drupal.org/node/2488192 for more information.          **
 **                                                                          **
 ******************************************************************************/
        $options = array(
          'attributes' => array(
            'class' => array(
              'use-ajax',
            ),
            'data-dialog-type' => 'modal',
            'data-dialog-options' => Json::encode([
              'width' => 700,
            ]),
          ),
        );
        $url = Url::fromRoute('iai_pig.display_product_image', array('node' => $product->nid->value, 'delta' => $itemCount));
        $url->setOptions($options);
        $build['list']['#items'][$itemCount] = [
          '#type' => 'markup',
          '#markup' => Link::fromTextAndUrl(drupal_render($linkText), $url)
                       ->toString(),
        ];
        $itemCount++;
      }
      $build['#attached']['library'][] = 'core/drupal.dialog.ajax';
    }
    else {

/******************************************************************************
 **                                                                          **
 ** This logic is just to give some positive feedback that the block is being**
 ** rendered. In reality, we'd likely just not have the block render anything**
 ** in this situation.                                                       **
 **                                                                          **
 ******************************************************************************/
      $build['no_data'] = [
        '#type' => 'markup',
        '#markup' => $this->t('This page does not reference a product.'),
      ];
    }

    return $build;
  }

  /**
   * Get a product
   *
   * @param \Drupal\node\NodeInterface $node
   *   The fully loaded node object.
   * @return \Drupal\node\NodeInterface $product
   *   The fully loaded product
   */
  private function getProduct(NodeInterface $node) {

/******************************************************************************
 **                                                                          **
 ** For this example block we are concerned only with nodes. Specifically, we**
 ** are operating under the assumption that this block should render only    **
 ** when it's being viewed on a Book page that references a Product or when  **
 ** it's being viewed directly on a Product page.                            **
 **                                                                          **
 ******************************************************************************/
    if ($node) {
      // Check if this is a Product node already
      if ($node->getType() == 'product') {
        return $node;
      }

      // Check if this node references a Product
      $product = $this->getReferencedProduct($node);

      if ($product) {
        return $this->entityRepository->getTranslationFromContext($product);
      }
      else {
        return NULL;
      }
    }
    else {
      return NULL;
    }
  }

  /**
   * Get a referenced product
   *
   * @param \Drupal\node\NodeInterface $node
   *   The fully loaded node object.
   * @return \Drupal\node\NodeInterface $product
   *   The fully loaded referenced product
   */
  private function getReferencedProduct(NodeInterface $node) {

/******************************************************************************
 **                                                                          **
 ** We are making an assumption about a particular field name that Book pages**
 ** use for the entity reference to products. We added this field to the book**
 **  pages ourselves.                                                        **
 **                                                                          **
 ******************************************************************************/
    if (isset($node->field_product)) {
      $referencedEntities = $node->field_product->referencedEntities();
      $product = $referencedEntities[0];
      return $product;
    }
    else {
      return NULL;
    }
  }
}
