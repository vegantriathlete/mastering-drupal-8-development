<?php

namespace Drupal\Tests\iai_pig\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\JavascriptTestBase;

/**
 * Tests the image gallery block.
 *
 * @group iai_pig
 */
class ImageGalleryBlockFunctionalJavascriptTest extends JavascriptTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = array('iai_pig', 'iai_product', 'block');

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
/******************************************************************************
 **                                                                          **
 ** We can't place the block using drupalPlaceBlock() because the product    **
 ** image gallery block is a context aware block. We need to emulate the     **
 ** process of using the block layout interface to place the block in a      **
 ** region.                                                                  **
 **                                                                          **
 ******************************************************************************/
    // Create and log in an administrative user.
    $adminUser = $this->drupalCreateUser(array(
      'administer blocks',
      'access administration pages',
    ));
    $this->drupalLogin($adminUser);

    // Place the block in the content area
    $block_url = 'admin/structure/block/add/iai_product_image_gallery/classy';
    $edit = [
      'region' => 'content',
    ];
    $this->drupalPostForm($block_url, $edit, 'Save block');
    $this->drupalLogout();
  }

  /**
   * Tests a product that does not have an image attached.
   */
  public function testProductWithoutImage() {

    // Create a product piece of content
    $node = $this->drupalCreateNode(array(
      'title' => t('Product without an image'),
      'type' => 'product',
      'field_product_description' => 'This product does not have an image attached.',
    ));
    $node->save();

    $message = 'There were no product images to display.';
    $this->drupalGet('node/' . $node->id());
    $this->assertContains($message, $this->getTextContent());
  }

  /**
   * Tests a product that has an image attached.
   */
  public function testProductWithImage() {

    // Create a product piece of content
    $node = $this->drupalCreateNode(array(
      'title' => t('Product with an image'),
      'type' => 'product',
      'field_product_description' => 'This product has an image attached.',
    ));
    $node->field_product_image->generateSampleItems();
    $node->save();

    $imageData = $node->field_product_image[0]->getValue();
    $altText = $imageData['alt'];
    $this->drupalGet('node/' . $node->id());
    $page = $this->getSession()->getPage();
/******************************************************************************
 **                                                                          **
 ** Once we visit the full node view of the product we have created, we want **
 ** to ensure that the expected things appear on the page. The link should   **
 ** have the data-dialog-type attribute that indicates it's supposd to open  **
 ** in a modal. Additionally, the link should reference the controllet that  **
 ** generates a page with a product image. When we are sure we have all the  **
 ** necessary conditions we will click the link.                             **
 **                                                                          **
 ******************************************************************************/
    $this->assertSession()->responseContains('data-dialog-type="modal"');
    $this->assertSession()->LinkByHrefExists('/iai_pig/display_product_image/' . $node->id() . '/0');
    $targetLink = $page->findLink($altText);
    $this->assertNotEmpty($targetLink);
    $targetLink->click();
/******************************************************************************
 **                                                                          **
 ** After we click the link we will use jQuery to search for the modal. Then **
 ** we allow time for the ajax request to finish and we look for the image   **
 ** inside of the modal.                                                     **
 **                                                                          **
 ******************************************************************************/
    $condition = "(jQuery('#drupal-modal').length > 0)";
    $this->assertJsCondition($condition);
    $this->assertSession()->assertWaitOnAjaxRequest();
    $condition = "(jQuery('#drupal-modal div img').length > 0)";
    $this->assertJsCondition($condition);
  }

}
