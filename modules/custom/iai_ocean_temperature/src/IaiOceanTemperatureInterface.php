<?php

namespace Drupal\iai_ocean_temperature;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/******************************************************************************
 **                                                                          **
 ** Even if we had not required any new methods beyond what                  **
 ** ContentEntityInterface and EntityChangedInterface require, best          **
 ** practice dictates that we create our own interface. Having an interface  **
 ** specifically for our entity allows the possibility to properly type hint **
 ** without having to use the class name itself. Recall that we want to      **
 ** support dependency injection and the ability to write custom             **
 ** implementations without having to hack code.                             **
 **                                                                          **
 ******************************************************************************/

/**
 * Provides an interface for the IAI Ocean Temperature entity.
 */
interface IaiOceanTemperatureInterface extends ContentEntityInterface, EntityChangedInterface {

  /**
   * Gets the label of the entity.
   *
   * @return string
   *   The label of the entity.
   */
  public function getLabel();

  /**
   * Gets the coordinates.
   *
   * @return string
   *   The latitude and longitude where the measurement was taken.
   */
  public function getCoordinates();

  /**
   * Gets the depth.
   *
   * @return float
   *   The depth at which the measurement was taken.
   */
  public function getDepth();

  /**
   * Gets the temperature.
   *
   * @return float
   *   The measured temperature.
   */
  public function getTemperature();

  /**
   * Gets the reported date.
   *
   * @return integer
   *   The unix timestamp of when the measurement was taken.
   */
  public function getReportedDate();

  /**
   * Gets the reporter.
   *
   * @return string
   *   The name of the person or organization reporting the data.
   */
  public function getReporter();

}
