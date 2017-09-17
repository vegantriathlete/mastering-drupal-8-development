<?php

namespace Drupal\Tests\iai_aquifer\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests the Aquifer listing block.
 *
 * @group iai_aquifer
 */
class PlaceAquiferBlockFunctionalTest extends BrowserTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = array('iai_aquifer', 'block');

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setup();

    // Create some aquifer pieces of content
    $this->drupalCreateNode(array(
      'title' => t('bigBlue'),
      'type' => 'aquifer',
      'field_aquifer_coordinates' => '47.7231° N, 86.9407° W',
      'field_aquifer_status' => 'low',
      'field_aquifer_volume' => 1000000,
    ));
    $this->drupalCreateNode(array(
      'title' => t('deepOcean'),
      'type' => 'aquifer',
      'field_aquifer_coordinates' => '14.5994° S, 28.6731° W',
      'field_aquifer_status' => 'full',
      'field_aquifer_volume' => 1000000000000,
    ));
    $this->drupalCreateNode(array(
      'title' => t('vastSea'),
      'type' => 'aquifer',
      'field_aquifer_coordinates' => '34.5531° N, 18.0480° E',
      'field_aquifer_status' => 'adequate',
      'field_aquifer_volume' => 1000000000,
    ));
  }

  /**
   * Tests that the block retrieves all three aquifer titles.
   */
  public function testAquiferBlockListing() {

    // Place the Aquifer block
    $this->drupalPlaceBlock('aquifer_block');
    $this->drupalGet('');
    $page_text = $this->getTextContent();
    $this->assertContains('bigBlue', $page_text);
    $this->assertContains('deepOcean', $page_text);
    $this->assertContains('vastSea', $page_text);
  }

}
