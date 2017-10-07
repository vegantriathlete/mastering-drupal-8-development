<?php

namespace Drupal\iai_ocean_temperature;

/**
 * Defines the data validation service.
 */
class IaiOceanTemperatureDataValidationService implements IaiOceanTemperatureDataValidationInterface {

  /**
   * {@inheritdoc}
   */
  public function hasRequiredFields($data) {
    if (isset($data['label']) &&
        isset($data['coordinates']) &&
        isset($data['depth']) &&
        isset($data['temperature']) &&
        isset($data['date']) &&
        isset($data['reporter'])) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function isValidCoordinates($ot_coordinates) {
/******************************************************************************
 **                                                                          **
 ** For the sake of keeping the example easy we are going to assume that the **
 ** only format we accept is decimal degrees and that the order must be      **
 ** latitude / longitude.                                                    **
 **                                                                          **
 ******************************************************************************/
    $pattern = '/([0-9]*.[0-9]*)°/';
    preg_match_all($pattern, $ot_coordinates, $matches);
    if (!isset($matches[1][0]) || !isset($matches[1][1])) {
      return FALSE;
    }
    if ((float) $matches[1][0] > 90 || (float) $matches[1][1] > 180) {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function isValidDepth($ot_depth) {
    if (!is_numeric($ot_depth)) {
      return FALSE;
    }
/******************************************************************************
 **                                                                          **
 ** For the sake of simplicity we will assume that we ask our reporters to   **
 ** transmit the depth in feet.                                              **
 **                                                                          **
 ******************************************************************************/
    if ((float) $ot_depth < 0) {
      return FALSE;
    }
    if ((float) $ot_depth > 36200) {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function isValidTemperature($ot_temperature) {
    if (!is_numeric($ot_temperature)) {
      return FALSE;
    }
/******************************************************************************
 **                                                                          **
 ** For the sake of simplicity we will assume that we ask our reporters to   **
 ** transmit the temperature in Fahrenheit.                                  **
 **                                                                          **
 ******************************************************************************/
    if ((float) $ot_temperature < 32) {
      return FALSE;
    }
    if ((float) $ot_temperature > 100) {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function isValidDate($ot_reported_date) {
    if (!ctype_digit($ot_reported_date)) {
      return FALSE;
    }
/******************************************************************************
 **                                                                          **
 ** We will assume that the reporting dates can't be before January 1, 2015. **
 **                                                                          **
 ******************************************************************************/
    if ((int) $ot_reported_date < 1420095660) {
      return FALSE;
    }
    if ((int) $ot_reported_date > time()) {
      return FALSE;
    }
    return TRUE;
  }

}
