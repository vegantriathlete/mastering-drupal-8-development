<?php

namespace Drupal\Tests\iai_product\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\Entity\Node;

/**
 * Tests the product manager service.
 *
 * @group iai_product
 */
class ProductManagerServiceKernelTest extends EntityKernelTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = [
    'file',
    'iai_product',
    'image',
    'menu_ui',
    'node'
  ];

  /**
   * The tested Product Manager Service
   *
   * @var \Drupal\iai_product\ProductManagerService
   */
  protected $productManagerService;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
/******************************************************************************
 **                                                                          **
 ** We have only one test method in this class, so it's not necessary to     **
 ** have this setUp method. We could do everything in the test method        **
 ** itself if we choose.                                                     **
 **                                                                          **
 ******************************************************************************/
    parent::setup();

    $this->installEntitySchema('file');
    $this->installSchema('file', ['file_usage']);
/******************************************************************************
 **                                                                          **
 ** We do need to install the config of node before iai_product or we will   **
 ** get an error.                                                            **
 **                                                                          **
 ******************************************************************************/
    $this->installConfig(['node', 'iai_product']);

    // Create water eco action pieces of content
    $node = Node::create(array(
      'title' => t('Product Number 1'),
      'type' => 'product',
      'language' => 'en',
      'field_product_description' => 'Product number 1',
    ));
    $node->field_product_image->generateSampleItems(1);
    $node->save();

    $node = Node::create(array(
      'title' => t('Product Number 2'),
      'type' => 'product',
      'language' => 'en',
      'field_product_description' => 'Product number 2',
    ));
    $node->field_product_image->generateSampleItems(2);
    $node->save();

    $node = Node::create(array(
      'title' => t('Product Number 3'),
      'type' => 'product',
      'language' => 'en',
      'field_product_description' => 'Product number 3',
    ));
    $node->field_product_image->generateSampleItems(3);
    $node->save();

    $this->productManagerService = \Drupal::service('iai_product.product_manager_service');
  }

  /**
   * Tests that the service retrieves the product images.
   */
  public function testRetrieveProductImages() {

    $node = Node::load(1);
    $imageData = $node->field_product_image->getValue();
    $productImages = $this->productManagerService->retrieveProductImages($node);
    $this->assertEquals($imageData, $productImages);

    $node = Node::load(2);
    $imageData = $node->field_product_image->getValue();
    $productImages = $this->productManagerService->retrieveProductImages($node);
    $this->assertEquals($imageData, $productImages);

    $node = Node::load(3);
    $imageData = $node->field_product_image->getValue();
    $productImages = $this->productManagerService->retrieveProductImages($node);
    $this->assertEquals($imageData, $productImages);
  }

}
