<?php

namespace Drupal\iai_personalization;

/**
 * Defines an interface to personalize content based on Ip Address.
 */
interface PersonalizationIpServiceInterface {

  /**
   * Map an Ip Address to a Latitude / Longitude coordinate
   *
   * @param string $ip
   *   The Ip address to map
   * @return string $coordinate
   *   The Latitude / Longitude coordinate
   */
  public function mapIpAddress($ip = NULL);

  /**
   * Retrieve the Ip Address of the current user
   */
  public function getIpAddress();

}
