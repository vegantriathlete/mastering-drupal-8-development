<?php

namespace Drupal\iai_aquifer;

/**
 * Defines an interface that provides functionality to manage aquifers.
 *
 * This is for managing the aquifer content type on the website. It is not
 * for managing the aquifer data that is contained in the (fictional) external
 * site that tracks aquifers world-wide. The only methods that this interface
 * will define are read and update. It is not intended that delete will be
 * available. It is also not intended that the create functionality will be
 * used directly. Rather, the implementation of this interface will handle
 * defining a createAquifer method internally.
 */
interface AquiferManagerServiceInterface {

  /**
   * Read (view) an aquifer
   *
   * @param string $aquiferName
   *   The name of the aquifer to view
   *
   * @return array
   *   An associative array of the aquifer's properties:
   *     name: The name of the aquifer
   *     coordinates: The longitude and latitude of the aquifer
   *     status: [ critical | low | adequate | full | overflowing ]
   *     volume: The current estimated volume in cubic liters
   */
  public function readAquifer($aquiferName);

  /**
   * Update an aquifer
   *
   * @param array $aquiferData
   *   An associative array to define the aquifer record:
   *     name: The name of the aquifer
   *     coordinates: The longitude and latitude of the aquifer
   *     status: [ critical | low | adequate | full | overflowing ]
   *     volume: The current estimated volume in cubic liters
   *
   * @return object
   *   ->status // 'updated'
   *   ->object // The updated $node entity
   *
   * @throws \UnexpectedValueException
   *   If the data contains an index that does not map to a field.
   */
  public function updateAquifer($aquiferData);

}
