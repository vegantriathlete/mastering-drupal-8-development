<?php

namespace Drupal\iai_ocean_temperature\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/******************************************************************************
 **                                                                          **
 ** We are leveraging some basic functionality that the Entity API provides  **
 ** us. It will give us a functional interface, although it will be lacking  **
 ** in some regards. We could have done more work directly in this builder   **
 ** like the node and user core modules did. Instead, we are choosing to     **
 ** leave writing a custom controller as part of your student exercises.     **
 ** @see: core/modules/node/src/NodeListBuilder                              **
 **       core/modules/user/src/UserListBuilder                              **
 **                                                                          **
 ******************************************************************************/

/**
 * Provides a list controller for IAI Ocean Temperature entities.
 */
class IaiOceanTemperatureListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['ot_coordinates'] = $this->t('Coordinates');
    $header['ot_temperature'] = $this->t('Temperature');
    $header['ot_reported_date'] = $this->t('Reported');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['ot_coordinates'] = $entity->ot_coordinates->value;
    $row['ot_temperature'] = $entity->ot_temperature->value;
    $row['ot_reported_date'] = $entity->ot_reported_date->value;
    return $row + parent::buildRow($entity);
  }

}
