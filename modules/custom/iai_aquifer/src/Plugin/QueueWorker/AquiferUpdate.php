<?php

namespace Drupal\iai_aquifer\Plugin\QueueWorker;

use Drupal\iai_aquifer\AquiferManagerServiceInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Queue\QueueWorkerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Updates the aquifer content types.
 *
 * @QueueWorker(
 *   id = "aquifer_updates",
 *   title = @Translation("Update Aquifers"),
 *   cron = {"time" = 60}
 * )
 */
class AquiferUpdate extends QueueWorkerBase implements ContainerFactoryPluginInterface {

  /**
   * The Aquifer Manager Service
   * @var Drupal\aquifer\AquiferManagerServiceInterface
   */
  protected $aquiferManagerService;

/******************************************************************************
 **                                                                          **
 ** This is an example of Dependency Injection. The Aquifer Manager Service  **
 ** is being injected through the class's constructor.                       **
 **                                                                          **
 ******************************************************************************/
  /**
   * Constructs the Queue Worker
   */
  public function __construct(AquiferManagerServiceInterface $aquifer_manager_service) {
    $this->aquiferManagerService = $aquifer_manager_service;
  }

/******************************************************************************
 **                                                                          **
 ** To learn more about Symfony's service container visit:                   **
 **   http://symfony.com/doc/current/service_container.html                  **
 **                                                                          **
 ******************************************************************************/
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {

/******************************************************************************
 **                                                                          **
 ** The ContainerFactoryPluginInterface is what gave us access to Symfony's  **
 ** service container. Plugins don't get access to the service container if  **
 ** they don't implement the ContainerFactoryPluginInterface.                **
 **                                                                          **
 ******************************************************************************/
    return new static(
      $container->get('aquifer.aquifer_manager_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function processItem($data) {
    $this->aquiferManagerService->updateAquifer($data);
  }

}
