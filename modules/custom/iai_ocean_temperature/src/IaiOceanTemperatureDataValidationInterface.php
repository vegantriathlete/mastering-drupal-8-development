<?php

namespace Drupal\iai_ocean_temperature;

/**
 * Defines an interface that provides functionality to validation services.
 */
interface IaiOceanTemperatureDataValidationInterface {

  /**
   * Validate required fields
   *
   * @param array $data
   *   The information that was passed
   *
   * @return boolean
   */
  public function hasRequiredFields($data);

  /**
   * Validate coordinates
   *
   * @param string $ot_coordinates
   *   The latitude and longitude at which the reading was taken
   *
   * @return boolean
   */
  public function isValidCoordinates($ot_coordinates);

  /**
   * Validate depth
   *
   * @param float $ot_depth
   *   The depth at which the reading was taken
   *
   * @return boolean
   */
  public function isValidDepth($ot_depth);

  /**
   * Validate temperature
   *
   * @param float $ot_temperature
   *   The measured temperature
   *
   * @return boolean
   */
  public function isValidTemperature($ot_temperature);

  /**
   * Validate reporting date
   *
   * @param int $ot_reported_date
   *   The date on which the reading was taken
   *
   * @return boolean
   */
  public function isValidDate($ot_reported_date);

}
