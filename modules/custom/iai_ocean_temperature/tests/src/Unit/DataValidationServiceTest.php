<?php

/**
 * @file
 *
 * Contains \Drupal\Tests\iai_ocean_temperature\Unit\DataValidationServiceTest
 */

namespace Drupal\Tests\iai_ocean_temperature\Unit;

use Drupal\iai_ocean_temperature\IaiOceanTemperatureDataValidationService;
use Drupal\Tests\UnitTestCase;

/**
 * Tests methods in the Data Validation Service
 *
 * @coversDefaultClass \Drupal\iai_ocean_temperature\IaiOceanTemperatureDataValidationService
 * @group iai_ocean_temperature
 */
class DataValidationServiceTest extends UnitTestCase {

  /**
   * The data validation service under test.
   *
   * @var \Drupal\iai_ocean_temperature\IaiOceanTemperatureDataValidationService
   */
  protected $dataValidationService;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    $this->dataValidationService = new IaiOceanTemperatureDataValidationService();
  }

  /**
   * Test missing required data
   *
   * @covers ::hasRequiredFields
   * @dataProvider provideMissingRequiredFields
   */
  public function testMissingRequiredFields($data) {
    $this->assertFalse($this->dataValidationService->hasRequiredFields($data));
  }

  /**
   * Provides data that is missing required fields
   *
   * @return array
   *   The data to use for items that are missing the required fields
   */
  public function provideMissingRequiredFields() {
    return [
      [array(
        'label' => 'I am a label',
        'coordinates' => '39.7392° N, 104.9903° W',
        'depth' => 11,
        'temperature' => 98.6,
        'date' => 1325533342
      )],
      [array(
        'label' => 'I am a label',
        'coordinates' => '39.7392° N, 104.9903° W',
        'depth' => 11,
        'temperature' => 98.6,
        'reporter' => 'DataValidationServiceTest.php'
      )],
      [array(
        'label' => 'I am a label',
        'coordinates' => '39.7392° N, 104.9903° W',
        'depth' => 11,
        'date' => 1325533342,
        'reporter' => 'DataValidationServiceTest.php'
      )],
      [array(
        'label' => 'I am a label',
        'coordinates' => '39.7392° N, 104.9903° W',
        'temperature' => 98.6,
        'date' => 1325533342,
        'reporter' => 'DataValidationServiceTest.php'
      )],
      [array(
        'label' => 'I am a label',
        'depth' => 11,
        'temperature' => 98.6,
        'date' => 1325533342,
        'reporter' => 'DataValidationServiceTest.php'
      )],
      [array(
        'coordinates' => '39.7392° N, 104.9903° W',
        'depth' => 11,
        'temperature' => 98.6,
        'date' => 1325533342,
        'reporter' => 'DataValidationServiceTest.php'
      )],
    ];
  }

  /**
   * Test having all the required fields
   *
   * @covers ::hasRequiredFields
   * @dataProvider provideHavingRequiredFields
   */
  public function testHavingRequiredFields($data) {
    $this->assertTrue($this->dataValidationService->hasRequiredFields($data));
  }

  /**
   * Provides data that has required fields
   *
   * @return array
   *   The data to use for items that have the required fields
   */
  public function provideHavingRequiredFields() {
    return [
      [array(
        'label' => 'I am a label',
        'coordinates' => '39.7392° N, 104.9903° W',
        'depth' => 11,
        'temperature' => 98.6,
        'date' => 1325533342,
        'reporter' => 'DataValidationServiceTest.php'
      )],
    ];
  }

  /**
   * Test invalid coordinates
   *
   * @covers ::isValidCoordinates
   * @dataProvider provideInvalidCoordinates
   */
  public function testInvalidCoordinates($ot_coordinate) {
    $this->assertFalse($this->dataValidationService->isValidCoordinates($ot_coordinate));
  }

  /**
   * Provides invalid data for coordinates
   *
   * @return array
   *   The data to use for invalid coordinates
   */
  public function provideInvalidCoordinates() {
/******************************************************************************
 **                                                                          **
 ** I actually FAIL the fifth test. I've got a bug in the method.            **
 **                                                                          **
 ******************************************************************************/
    return [
      ['Way up north'],
      ['39.7392° N'],
      ['104.9903° W'],
      ['39.7392 N, 104.9903 W'],
      ['39° 44\' 31.3548" N, 104° 59\' 29.5116" W'],
      ['99.7392° N, 104.9903° W'],
      ['39.7392° N, 184.9903° W']
    ];
  }

  /**
   * Test valid coordinates
   *
   * @covers ::isValidCoordinates
   * @dataProvider provideValidCoordinates
   */
  public function testValidCoordinates($ot_coordinate) {
    $this->assertTrue($this->dataValidationService->isValidCoordinates($ot_coordinate));
  }

  /**
   * Provides valid data for coordinates
   *
   * @return array
   *   The data to use for valid coordinates
   */
  public function provideValidCoordinates() {
    return [
      ['39.7392° N, 104.9903° W'],
      ['-39.7392° N, 104.9903° W'],
      ['39.7392° N, -104.9903° W'],
      ['-39.7392° N, -104.9903° W'],
    ];
  }

  /**
   * Test invalid depth
   *
   * @covers ::isValidDepth
   * @dataProvider provideInvalidDepth
   */
  public function testInvalidDepth($ot_depth) {
    $this->assertFalse($this->dataValidationService->isValidDepth($ot_depth));
  }

  /**
   * Provides invalid data for depth
   *
   * @return array
   *   The data to use for invalid depth
   */
  public function provideInvalidDepth() {
    return [
      [100000],
      [-10],
      ['Whoops!'],
      ['10,000.00'],
      ['1000.O1']
    ];
  }

  /**
   * Test valid depth
   *
   * @covers ::isValidDepth
   * @dataProvider provideValidDepth
   */
  public function testValidDepth($ot_depth) {
    $this->assertTrue($this->dataValidationService->isValidDepth($ot_depth));
  }

  /**
   * Provides valid data for depth
   *
   * @return array
   *   The data to use for valid depth
   */
  public function provideValidDepth() {
    return [
      [10000],
      [1.0],
      [1000.00]
    ];
  }

  /**
   * Test invalid temperature
   *
   * @covers ::isValidTemperature
   * @dataProvider provideInvalidTemperature
   */
  public function testInvalidTemperature($ot_temperature) {
    $this->assertFalse($this->dataValidationService->isValidTemperature($ot_temperature));
  }

  /**
   * Provides invalid data for temperature
   *
   * @return array
   *   The data to use for invalid temperature
   */
  public function provideInvalidTemperature() {
    return [
      [100.1],
      [200],
      [-1],
      [28],
      [31.9],
      ['Whoops!'],
      ['39.7° F'],
    ];
  }

  /**
   * Test valid temperature
   *
   * @covers ::isValidTemperature
   * @dataProvider provideValidTemperature
   */
  public function testValidTemperature($ot_temperature) {
    $this->assertTrue($this->dataValidationService->isValidTemperature($ot_temperature));
  }

  /**
   * Provides valid data for temperature
   *
   * @return array
   *   The data to use for valid temperature
   */
  public function provideValidTemperature() {
    return [
      [32],
      [41.0],
      [99.9]
    ];
  }

  /**
   * Test invalid date
   *
   * @covers ::isValidDate
   * @dataProvider provideInvalidDate
   */
  public function testInvalidDate($ot_reported_date) {
    $this->assertFalse($this->dataValidationService->isValidDate($ot_reported_date));
  }

  /**
   * Provides invalid data for date
   *
   * @return array
   *   The data to use for invalid date
   */
  public function provideInvalidDate() {
    $theFuture = time() + 100;
    return [
      [0],
      [200],
      [$theFuture],
      [1420956031.9],
      ['Whoops!']
    ];
  }

  /**
   * Test valid date
   *
   * @covers ::isValidDate
   * @dataProvider provideValidDate
   */
  public function testValidDate($ot_reported_date) {
    $this->assertTrue($this->dataValidationService->isValidDate($ot_reported_date));
  }

  /**
   * Provides valid data for date
   *
   * @return array
   *   The data to use for valid date
   */
  public function provideValidDate() {
    $now = time();
    $lastYear = $now - 365 * 24 * 60 * 60;
    return [
      [$now],
      [$lastYear],
      [1420095661]
    ];
  }

}
