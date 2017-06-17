<?php

namespace Drupal\iai_aquifer;

use Drupal\Core\Entity\EntityManagerInterface;

/**
 * An implementation of AquiferManagerServiceInterface.
 */
class AquiferManagerService extends AbstractAquiferManagerService implements AquiferManagerServiceInterface {

  /**
   * Entity storage for node entities.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $nodeStorage;

  /**
   * Constructs the Aquifer Manager Service object.
   *
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   Entity storage for node entities.
   */
  public function __construct(EntityManagerInterface $entity_manager) {

/******************************************************************************
 **                                                                          **
 ** Symfony knows to pass the $entity_manager to our constructor because we  **
 ** specified it as an argument in our iai_aquifer.services.yml.             **
 **                                                                          **
 ******************************************************************************/
    $this->nodeStorage = $entity_manager->getStorage('node');
  }

  /**
   * {@inheritdoc}
   */
  protected function createAquifer(array $aquiferData) {
    $expectedFields = array('name', 'coordinates', 'status', 'volume');
    $operation = 'creating an aquifer';
    $this->validateExpectedFields($expectedFields, $operation, $aquiferData);
    $this->validatePassedFields($expectedFields, $operation, $aquiferData);
    $values = array(
      'title' => $aquiferData['name'],
      'type' => 'aquifer',
      'uid' => 1,
    );
    unset($aquiferData['name']);
    foreach ($aquiferData as $property => $value) {
      $values['field_aquifer_' . $property] = $value;
    }

/******************************************************************************
 **                                                                          **
 ** We haven't specified a 'langcode' for the node. When Drupal creates the  **
 ** node it will assign the site's default language, which in our case is    **
 ** English. The node's langcode will be set to 'en'.                        **
 **                                                                          **
 ******************************************************************************/
    $node = $this->nodeStorage->create($values);
    $this->nodeStorage->save($node);
    return (object) array('status' => 'created', 'object' => $node);
  }

  /**
   * {@inheritdoc}
   */
  public function readAquifer($aquiferName) {
    $node = $this->getAquifer($aquiferName);
    $aquiferData = array(
      'name' => $node->title->value,
      'coordinates' => $node->field_aquifer_coordinates->value,
      'status' => $node->field_aquifer_status->value,
      'volume' => $node->field_aquifer_volume->value
    );
    return $aquiferData;
  }

  /**
   * {@inheritdoc}
   */
  public function updateAquifer($aquiferData) {
    // See if the aquifer already exists.
    $query = $this->nodeStorage->getQuery()
      ->condition('type', 'aquifer')
      ->condition('title', $aquiferData['name'])
      ->count();

    $count_nodes = $query->execute();

    if ($count_nodes == 0) {
      $response = $this->createAquifer($aquiferData);
      return $response;
    }
    elseif ($count_nodes == 1) {
      // Retrieve the aquifer
      $node = $this->getAquifer($aquiferData['name']);

      unset($aquiferData['name']); // remove the name attribute
      $expectedFields = array('coordinates', 'status', 'volume');
      $this->validatePassedFields($expectedFields, 'updating an aquifer', $aquiferData);
      foreach ($aquiferData as $property => $value) {
        $node->set("field_aquifer_{$property}", $value);
      }
      $this->nodeStorage->save($node);
      return (object) array('status' => 'updated', 'object' => $node);
    }
    else {
      // Do something about the fact that there is more than one aquifer with
      // this name.
    }

  }

  /**
   * Retrieve the specific node
   *
   * @param string $aquiferName
   *   The name of the aquifer to retrieve
   *
   * @return \Drupal\node\NodeInterface $node
   *   The fully loaded node entity
   */
  private function getAquifer($aquiferName) {
    $result = $this->nodeStorage->getQuery()
      ->condition('type', 'aquifer')
      ->condition('title', $aquiferName)
      ->range(0, 1)
      ->execute();

    return $this->nodeStorage->load(reset($result));
  }

  /**
   * Validate the field data
   *
   * @param array $expectedFields
   *   The fields that are expected to be passed for the operation being
   *   performed
   * @param string $operation
   *   The operation being performed
   * @param array $aquiferData
   *   The data being passed in.
   *
   * @throws \InvalidArgumentException
   */
  private function validateExpectedFields($expectedFields, $operation, $aquiferData) {
    foreach ($expectedFields as $fieldName) {
      if (!isset($aquiferData[$fieldName])) {
        throw new \InvalidArgumentException('Missing expected field: ' . $fieldName . ' when ' . $operation . '.');
      }
    }
  }

  /**
   * Validate the field data
   *
   * @param array $expectedFields
   *   The fields that are expected to be passed for the operation being
   *   performed
   * @param string $operation
   *   The operation being performed
   * @param array $aquiferData
   *   The data being passed in.
   *
   * @throws \UnexpectedValueException
   */
  private function validatePassedFields($expectedFields, $operation, $aquiferData) {
    foreach ($aquiferData as $fieldName => $value) {
      if (!in_array($fieldName, $expectedFields)) {
        throw new \UnexpectedValueException('Unexpected field: ' . $fieldName . ' when ' . $operation . '.');
      }
    }
  }
}
