<?php

namespace Drupal\iai_aquifer;

/**
 * Defines an interface that provides information about aquifers.
 *
 * This interface defines methods to retrieve information about aquifers.
 * It is possible to find out about all known aquifers as well as to find out
 * details about a specific aquifer.
 */

/******************************************************************************
 **                                                                          **
 ** We are pretending that there is some third-party service that we can     **
 ** query to get information about all the aquifers in the world. Whether    **
 ** the third-party service has URIs or a class that we can use to get the   **
 ** data we want for our methods is not important. One of the benefits of    **
 ** defining an interface is that it lays out the rules of what we want,     **
 ** independent of what exists. The complexity of changing what exists into  **
 ** what we want will be hidden inside of the class that implements the      **
 ** interface.                                                               **
 **                                                                          **
 ******************************************************************************/
interface AquiferRetrievalServiceInterface {

  /**
   * Get the total number of aquifers
   *
   * @param string $region
   *   Region to which to limit the search
   *
   * @return int
   *   The number of tracked aquifers
   */
  public function getTotalAquifers($region = 'ALL');

/******************************************************************************
 **                                                                          **
 ** We are pretending that aquifers have names that uniquely identify them.  **
 **                                                                          **
 ******************************************************************************/
  /**
   * Get the names of aquifers
   *
   * @param string $region
   *   Region to which to limit the search
   * @param integer $limit
   *   The number of results to return
   * @param integer $offset
   *   The amount of results to skip
   *
   * @return array
   *   The names of aquifers
   */
  public function getAquiferNames($region = 'ALL', $limit = -1, $offset = 0);

  /**
   * Retrieve the current data for a given aquifer
   *
   * @param string $name
   *   The name of the acquifer for which the data is being retrieved
   *
   * @return array
   *   An associative array that contains the properties and their
   *   corresponding values for an aquifer. The properties are:
   *     coordinates: The latitude / longitude of the aquifer
   *     status: [ empty | critical | low | adequate | full | overflowing ]
   *     volume: measured in cubic liters
   */
  public function getAquiferData($name);
}
