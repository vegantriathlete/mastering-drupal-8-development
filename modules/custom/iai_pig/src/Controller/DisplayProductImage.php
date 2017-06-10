<?php

/**
 * @file
 * Contains \Drupal\iai_pig\DisplayProductImage
 */

namespace Drupal\iai_pig\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Drupal\node\NodeInterface;

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

    if (isset($node->field_product_image[$delta])) {
      $imageData = $node->field_product_image[$delta]->getValue();
      $file = File::load($imageData['target_id']);
      $render_array['image_data'] = array(
        '#theme' => 'image_style',
        '#uri' => $file->getFileUri(),
        '#style_name' => 'product_large',
        '#alt' => $imageData['alt'],
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
