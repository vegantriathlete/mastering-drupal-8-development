<?php

/**
 * @file
 * Contains \Drupal\iai_aquifer\DisplayAquifers
 */

namespace Drupal\iai_aquifer\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller methods for the DisplayAquifers controller
 *
 * The various methods in this controller build a render array to be displayed
 * in a page.
 */
class DisplayAquifers extends ControllerBase {

  /**
   * Return the total number of aquifers in a region
   *
   * @param string $region
   *   The region for which the number of aquifers should be displayed
   *
   * @return array
   *   The render array
   */
  public function getTotalAquifers($region = 'ALL') {
  }

  /**
   * Display the aquifer names
   *
   * @return array
   *   The render array
   */
  public function getAquiferNames() {
  }

  /**
   * Display the data for an aquifer
   *
   * @param string $aquiferName
   *   The name of the aquifer for which to display the data
   *
   * @return array
   *   The render array
   */
  public function getAquiferData($aquiferName) {
  }

}
