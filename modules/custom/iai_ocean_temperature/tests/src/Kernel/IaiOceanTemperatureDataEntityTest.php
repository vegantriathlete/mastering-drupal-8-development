<?php

namespace Drupal\Tests\iai_ocean_temperature\Kernel;

use Drupal\iai_ocean_temperature\Entity\IaiOceanTemperature;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;

/**
 * Tests the IAI Ocean Temperature Entity.
 *
 * @group iai_ocean_temperature
 */
class IaiOceanTemperatureDataEntityTest extends EntityKernelTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = [
    'iai_ocean_temperature'
  ];

  /**
   * The creation time of the entity
   */
  protected $reportedDate;

  /**
   * The created entity
   */
  protected $entity;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setup();

    $this->installEntitySchema('iai_ocean_temperature');

    $this->reportedDate = time();

    // Create an ocean temperature data entity
    $oceanTemperatureEntity = IaiOceanTemperature::create(array(
      'label' => t('Kernel Test of IAI Ocean Temperature'),
      'langcode' => 'en',
      'ot_coordinates' => '47.7231° N, 86.9407° W',
      'ot_depth' => 1.5,
      'ot_temperature' => 58.0,
      'ot_reported_date' => $this->reportedDate,
      'ot_reporter' => 'IaiOceanTemperatureDataEntityTest.php'
    ));
    $oceanTemperatureEntity->save();
    $this->entity = $oceanTemperatureEntity;

  }

  /**
   * Tests the entity's getLabel method
   */
  public function testGetLabel() {
    $this->assertEquals('Kernel Test of IAI Ocean Temperature', $this->entity->getLabel());
  }

  /**
   * Tests the entity's getCoordinates method
   */
  public function testGetCoordinates() {
    $this->assertEquals('47.7231° N, 86.9407° W', $this->entity->getCoordinates());
  }

  /**
   * Tests the entity's getDepth method
   */
  public function testGetDepth() {
    $this->assertEquals(1.5, $this->entity->getDepth());
  }

  /**
   * Tests the entity's getTemperature method
   */
  public function testGetTemperature() {
    $this->assertEquals(58.0, $this->entity->getTemperature());
  }

  /**
   * Tests the entity's getReportedDate method
   */
  public function testGetReportedDate() {
    $this->assertEquals($this->reportedDate, $this->entity->getReportedDate());
  }

  /**
   * Tests the entity's getReporter method
   */
  public function testGetReporter() {
    $this->assertEquals('IaiOceanTemperatureDataEntityTest.php', $this->entity->getReporter());
  }

}
