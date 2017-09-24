<?php

namespace Drupal\Tests\iai_product_guide\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\JavascriptTestBase;

/**
 * Tests the image gallery block.
 *
 * @group iai_product_guide
 */
class TourLinkBlockFunctionalJavascriptTest extends JavascriptTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = [
    'block',
    'book',
    'tour',
    'iai_product_guide'
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    // Create and log in an administrative user.
    $adminUser = $this->drupalCreateUser(array(
      'administer blocks',
      'access administration pages',
    ));
    $this->drupalLogin($adminUser);

    // Place the blocks in the content area
    $edit = [
      'region' => 'content',
    ];
    $block_url = 'admin/structure/block/add/iai_tour_link/classy';
    $this->drupalPostForm($block_url, $edit, 'Save block');
    $this->drupalLogout();
  }

  /**
   * Tests taking the tour.
   */
  public function testTourLink() {

/******************************************************************************
 **                                                                          **
 ** We don't really care whether the pages reference products for the        **
 ** purpose of this test.                                                    **
 **                                                                          **
 ******************************************************************************/
    // Create a book with some pages
    $book = $this->drupalCreateNode(array(
      'title' => t('Product User Guide'),
      'type' => 'book',
      'book' => ['bid' => 'new'],
    ));
    $book->save();

    $page1 = $this->drupalCreateNode([
      'type' => 'book',
      'title' => '1st page',
      'book' => ['bid' => $book->id(), 'pid' => $book->id(), 'weight' => 0],
    ]);
    $page1->save();
    $page2 = $this->drupalCreateNode([
      'type' => 'book',
      'title' => '2nd page',
      'book' => ['bid' => $book->id(), 'pid' => $book->id(), 'weight' => 1],
    ]);
    $page2->save();

    // Create and log in a user.
    $testUser = $this->drupalCreateUser(array(
      'access content',
      'access tour',
    ));
    $this->drupalLogin($testUser);

/******************************************************************************
 **                                                                          **
 ** We are testing just to see that our tour link appears                    **
 **                                                                          **
 ******************************************************************************/
    $this->drupalGet('node/' . $book->id());
    $page = $this->getSession()->getPage();
    $targetLink = $page->findLink('Take the tour!');
    $this->assertNotEmpty($targetLink);
    $targetLink->click();
/******************************************************************************
 **                                                                          **
 ** We get the first tour item when we click the link                        **
 **                                                                          **
 ******************************************************************************/
    $condition = "(jQuery('.tip-introduction').is(':visible'))";
    $this->assertJsCondition($condition);
    $targetLink = $page->findLink('Next');
    $this->assertNotEmpty($targetLink);
    $targetLink->click();
/******************************************************************************
 **                                                                          **
 ** We get the second tour item when we click the link                       **
 **                                                                          **
 ******************************************************************************/
    $condition = "(jQuery('.tip-reading-the-book-page').is(':visible'))";
    $this->assertJsCondition($condition);
  }

}
