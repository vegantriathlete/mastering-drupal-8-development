<?php

namespace Drupal\iai_product;

use Drupal\node\NodeInterface;

/**
 * An implementation of ProductManagerServiceInterface.
 */
class ProductManagerService implements ProductManagerServiceInterface{

  /**
   * {@inheritdoc}
   */
  public function retrieveProductImages(NodeInterface $product) {
    $imageData = [];
    foreach ($product->field_product_image as $productImage) {
      $imageData[] = $productImage->getValue();
    }
    return $imageData;
  }
}
