<?php

namespace Drupal\Tests\iai_wea\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests the water eco action listing block.
 *
 * @group iai_wea
 */
class PlaceEcoActionBlockFunctionalTest extends BrowserTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = array('iai_wea', 'iai_personalization', 'block');

  /**
   * Tests that the block retrieves all three water eco actions.
   */
  public function testWeaBlockListing() {

    // Create some water eco action pieces of content
    $this->drupalCreateNode(array(
      'title' => t('Oil Spill'),
      'type' => 'water_eco_action',
    ));
    $this->drupalCreateNode(array(
      'title' => t('Beach Cleanup'),
      'type' => 'water_eco_action',
    ));
    $this->drupalCreateNode(array(
      'title' => t('Test for contaminants'),
      'type' => 'water_eco_action',
    ));

    // Place the Aquifer block
    $this->drupalPlaceBlock('eco_action_block');
    $this->drupalGet('');
    $page_text = $this->getTextContent();
    $this->assertContains('Oil Spill', $page_text);
    $this->assertSession()->LinkByHrefExists('/node/1');
    $this->assertContains('Beach Cleanup', $page_text);
    $this->assertSession()->LinkByHrefExists('/node/2');
    $this->assertContains('Test for contaminants', $page_text);
    $this->assertSession()->LinkByHrefExists('/node/3');
  }

  /**
   * Tests that the empty block displays a message.
   */
  public function testWeaEmptyBlockListing() {

    // Place the Aquifer block
    $this->drupalPlaceBlock('eco_action_block');
    $this->drupalGet('');
    $message = 'There are no actions in your area.';
    $page_text = $this->getTextContent();
    $this->assertContains($message, $page_text);
  }

}
