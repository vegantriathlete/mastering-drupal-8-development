<?php

namespace Drupal\iai_product;

use Drupal\node\NodeInterface;

/**
 * Defines an interface to retrieve product data.
 *
 * We have defined our Product content type within the iai_product module.
 * Nonetheless, in order to avoid referencing specific field names within our
 * code we will create a service that is responsible for retrieving our Product
 * data.
 */
interface ProductManagerServiceInterface {

  /**
   * Get all of a Product's images
   *
   * @param \Drupal\node\NodeInterface $product
   *   The fully loaded Product
   *
   * @return array $imageData 
   *   An array of all the image data for imate type fields.
   */
  public function retrieveProductImages(NodeInterface $product);
}
