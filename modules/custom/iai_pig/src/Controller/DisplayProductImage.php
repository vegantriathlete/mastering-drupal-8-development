<?php

/**
 * @file
 * Contains \Drupal\iai_pig\DisplayProductImage
 */

namespace Drupal\iai_pig\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Drupal\iai_product\ProductManagerServiceInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Display a given image for a given product
 */
class DisplayProductImage extends ControllerBase {

/******************************************************************************
 **                                                                          **
 ** In order to display a Modal, there needs to be a URL that will be        **
 ** displayed inside the modal.                                              **
 **                                                                          **
 ** This controller is responsible for providing the URL that will be        **
 ** displayed inside the modal.                                              **
 **                                                                          **
 ******************************************************************************/

  /**
   * Presentation Manager Service.
   *
   * @var \Drupal\iai_product\ProductManagerServiceInterface
   */
  protected $productManagerService;

/******************************************************************************
 **                                                                          **
 ** This is an example of Dependency Injection. The necessary objects are    **
 ** being injected through the class's constructor.                          **
 **                                                                          **
 ******************************************************************************/
  /**
   * {@inheritdoc}
   */
  public function __construct(ProductManagerServiceInterface $product_manager_service) {
    $this->productManagerService = $product_manager_service;
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
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('iai_product.product_manager_service')
    );
  }

  /**
   * Display a product image
   *
   * @param \Drupal\node\NodeInterface $node
   *   The fully loaded node entity
   * @param integer $delta
   *   The image instance to load
   *
   * @return array $render_array
   *   The render array
   */
  public function displayProductImage(NodeInterface $node, $delta) {

/******************************************************************************
 **                                                                          **
 ** Because we are using the NodeInterface type hint, we will receive a fully**
 ** loaded node object.                                                      **
 **                                                                          **
 ******************************************************************************/

    $productImages = $this->productManagerService->retrieveProductImages($node);
    if (isset($productImages[$delta])) {
      $file = File::load($productImages[$delta]['target_id']);
      $render_array['image_data'] = array(
        '#theme' => 'image_style',
        '#uri' => $file->getFileUri(),
        '#style_name' => 'product_large',
        '#alt' => $productImages[$delta]['alt'],
      );
    }
    else {
      $render_array['image_data'] = array(
        '#type' => 'markup',
        '#markup' => $this->t('You are viewing @title. Unfortunately, there is no image defined for delta: @delta.', array('@title' => $node->title->value, '@delta' => $delta)),
      );
    }
    return $render_array;
  }

}
