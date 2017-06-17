<?php

namespace Drupal\iai_aquifer;

/**
 * Defines an abstract class for the Aquifer Manager Service.
 */

/******************************************************************************
 **                                                                          **
 ** We created this abstract class because we want the createAquifer method  **
 ** to be protected; we can't define a protected method in an interface.     **
 ** Truth be told, we'd really like the method to be private so that it can  **
 ** be called only within the class. But, then we'd have to put it only in   **
 ** the AquiferManagerService class itself; we can't make an abstract method **
 ** private.                                                                 **
 **                                                                          **
 ******************************************************************************/
abstract class AbstractAquiferManagerService {

  /**
   * Create a new aquifer record
   *
   * It is not intended that it be possible to directly request to create an
   * aquifer. Instead, it is intended that the updateAquifer method should
   * always be called. If that method determines that the record does not exist
   * it will call this method.
   *
   * @param array $aquiferData
   *   An associative array to define the aquifer record:
   *     name: The name of the aquifer
   *     coordinates: The longitude and latitude of the aquifer
   *     status: [ critical | low | adequate | full | overflowing ]
   *     volume: The current estimated volume in cubic liters
   *
   * @return object
   *   ->status // 'created'
   *   ->object // The created $node entity
   *
   * @throws \InvalidArgumentException
   *   If the data is missing a required field.
   * @throws \UnexpectedValueException
   *   If the data contains an index that does not map to a field.
   */
  abstract protected function createAquifer(array $aquiferData);

}
