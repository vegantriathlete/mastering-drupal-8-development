<?php

namespace Drupal\iai_ocean_temperature;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/******************************************************************************
 **                                                                          **
 ** For more information about the access control handler                    **
 ** @see: https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Entity%21entity.api.php/group/entity_api/8.5.x **
 ** paying attention to the section about the access handler class           **
 **                                                                          **
 ** You can find a similar example at                                        **
 ** core/modules/taxonomy/src/TermAccessControlHandler                       **
 **                                                                          **
 ******************************************************************************/

/**
 * Determines access to IAI Ocean Temperature entities
 */
class IaiOceanTemperatureAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view iai_ocean_temperature entity');
      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit iai_ocean_temperature entity');
      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete iai_ocean_temperature entity');
      default:
        // No opinion.
        return AccessResult::neutral();
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add iai_ocean_temperature entity');
  }

}
