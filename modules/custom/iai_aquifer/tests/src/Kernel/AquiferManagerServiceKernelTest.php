<?php

namespace Drupal\Tests\iai_aquifer\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\Entity\Node;

/**
 * Tests the Aquifer manager service.
 *
 * @group iai_aquifer
 */
class AquiferManagerServiceKernelTest extends EntityKernelTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = [
    'iai_aquifer',
    'content_translation',
    'language',
    'menu_ui',
    'node',
    'options'
  ];

  /**
   * The tested Aquifer Manager Service
   *
   * @var \Drupal\iai_aquifer\AquiferManagerService
   */
  protected $aquiferManagerService;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setup();

/******************************************************************************
 **                                                                          **
 ** We do need to install the config of node before iai_aquifer or we will   **
 ** get an error.                                                            **
 **                                                                          **
 ******************************************************************************/
    $this->installConfig(['node', 'iai_aquifer']);

    // Create an aquifer piece of content
    $node = Node::create(array(
      'title' => t('bigBlue'),
      'type' => 'aquifer',
      'language' => 'en',
      'field_aquifer_coordinates' => '47.7231° N, 86.9407° W',
      'field_aquifer_status' => 'low',
      'field_aquifer_volume' => 1000000,
    ));
    $node->save();

/******************************************************************************
 **                                                                          **
 ** Since we are running a Kernel test we have access to services. We don't  **
 ** need to mock objects.                                                    **
 **                                                                          **
 ******************************************************************************/
    $this->aquiferManagerService = \Drupal::service('aquifer.aquifer_manager_service');
  }

  /**
   * Tests that the service reads an aquifer.
   */
  public function testReadAquifer() {

/******************************************************************************
 **                                                                          **
 ** We are able to retrieve the node, that we created in the setUp method,   **
 ** from the database.                                                       **
 **                                                                          **
 ******************************************************************************/
    $aquiferData = $this->aquiferManagerService->readAquifer('bigBlue');

    $this->assertEquals('47.7231° N, 86.9407° W', $aquiferData['coordinates']);
    $this->assertEquals('low', $aquiferData['status']);
    $this->assertEquals(1000000, $aquiferData['volume']);
  }

  /**
   * Tests that the service updates an existing aquifer.
   */
  public function testUpdateAquifer() {

    $this->installSchema('node', ['node_access']);

    $aquiferData = array(
      'name' => 'bigBlue',
      'status' => 'adequate',
      'volume' => 123456789,
    );

/******************************************************************************
 **                                                                          **
 ** The Aquifer Manager service will find the bigBlue aquifer and will       **
 ** update it with the data we send. It will then return the updated object. **
 **                                                                          **
 ******************************************************************************/
    $response = $this->aquiferManagerService->updateAquifer($aquiferData);
    $node = $response->object;

    $this->assertEquals('updated', $response->status);
    $this->assertEquals($aquiferData['status'], $node->field_aquifer_status->value);
    $this->assertEquals($aquiferData['volume'], $node->field_aquifer_volume->value);
  }

  /**
   * Tests that the service creates a new aquifer.
   */
  public function testCreateAquifer() {

    $aquiferData = array(
      'name' => 'vastSea',
      'coordinates' => '34.5531° N, 18.0480° E',
      'status' => 'aqequate',
      'volume' => 1000000000,
    );

/******************************************************************************
 **                                                                          **
 ** The Aquifer Manager service will not find the vastSea aquifer and will   **
 ** create a new one. It will return the newly created node.                 **
 **                                                                          **
 ******************************************************************************/
    $response = $this->aquiferManagerService->updateAquifer($aquiferData);
    $node = $response->object;

    $this->assertEquals('created', $response->status);
    $this->assertEquals($aquiferData['coordinates'], $node->field_aquifer_coordinates->value);
    $this->assertEquals($aquiferData['status'], $node->field_aquifer_status->value);
    $this->assertEquals($aquiferData['volume'], $node->field_aquifer_volume->value);
  }

}
