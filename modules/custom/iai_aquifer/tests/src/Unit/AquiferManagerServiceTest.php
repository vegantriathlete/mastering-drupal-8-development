<?php

/**
 * @file
 *
 * Contains \Drupal\Tests\iai_aquifer\Unit\AquiferManagerServiceTest
 */

namespace Drupal\Tests\iai_aquifer\Unit;

use Drupal\iai_aquifer\AquiferManagerService;
use Drupal\Tests\UnitTestCase;

/**
 * Tests methods in the Aquifer Manager Service
 *
 * @coversDefaultClass \Drupal\iai_aquifer\AquiferManagerService
 * @group iai_aquifer
 */
class AquiferManagerServiceTest extends UnitTestCase {

  /**
   * Test updating a non-existing aquifer
   *
   * @covers ::createAquifer
   */
  public function testCreateAquiferWithGoodData() {
/******************************************************************************
 **                                                                          **
 ** We want to test the AquiferManagerService; we ultimately need to do      **
 **   $aquiferManagerService = new AquiferManagerService($entityManager);    **
 ** Thus, we need to be able to inject $entityManager. The objects that we   **
 ** are mocking below all result from the end goal. To mock the entity       **
 ** manager, we need a node storage object. To mock the node storage object  **
 ** we need to mock a query object and a node object.                        **
 **                                                                          **
 ******************************************************************************/
    $query_object = $this->getMockBuilder('Drupal\Core\Entity\Query\QueryInterface')
      ->getMock();
    $query_object->expects($this->any())
      ->method('condition')
      ->willReturn($query_object);
    $query_object->expects($this->any())
      ->method('count')
      ->willReturn($query_object);
/******************************************************************************
 **                                                                          **
 ** It's not stricly necessary that we tell the query object what to do when **
 ** it receives the request for the execute method. However, it is a good    **
 ** idea for us to be explicit that we are expecting the count to be zero,   **
 ** which indicates that the aquifer was not found.                          **
 **                                                                          **
 ******************************************************************************/
    $query_object->expects($this->any())
      ->method('execute')
      ->willReturn(0);
    $node = $this->getMockBuilder('\Drupal\node\Entity\Node')
      ->disableOriginalConstructor()
      ->getMock();
    $nodeStorage = $this->getMockBuilder('\Drupal\Core\Entity\EntityStorageInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $nodeStorage->expects($this->any())
      ->method('getQuery')
      ->willReturn($query_object);
    $nodeStorage->expects($this->any())
      ->method('create')
      ->willReturn($node);
    $entityManager = $this->getMockBuilder('\Drupal\Core\Entity\EntityManagerInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $entityManager->expects($this->any())
      ->method('getStorage')
      ->with('node')
      ->willReturn($nodeStorage);
    $aquiferManagerService = new AquiferManagerService($entityManager);
/******************************************************************************
 **                                                                          **
 ** The key piece we are testing in our expected result is the               **
 **   'status' => 'created'                                                  **
 ** because we are testing creating a new aquifer. The                       **
 **   'object' => $node                                                      **
 ** will always match because we are mocking all the pieces that are         **
 ** involved in the aquifer creation process. Specifically, we have          **
 ** instructed the mocked node storage object to return our mocked node      **
 ** object when it receives the 'create' method request. It wouldn't make    **
 ** sense for us to cause an error on our own by putting anything other than **
 ** our mocked node object into the expected result.                         **
 **                                                                          **
 ******************************************************************************/
    $aquiferData = [
      'name' => 'Northern Aquifer',
      'coordinates' => 'Way up north',
      'status' => 'adequate',
      'volume' => '1'
    ];
    $expectedResult = (object) array('status' => 'created', 'object' => $node);
    $this->assertEquals($expectedResult, $aquiferManagerService->updateAquifer($aquiferData));
  }

  /**
   * Provides data that is missing fields for adding aquifers
   *
   * @return array
   *   The data to use for aquifers with missing data
   */
  public function provideMissingAquiferData () {
    return [
      [array(
        'name' => 'Northern Aquifer',
        'status' => 'adequate',
        'volume' => '1'
      )],
      [array(
        'name' => 'Eastern Aquifer',
        'coordinates' => 'Way to the east',
        'volume' => '2'
      )],
      [array(
        'name' => 'Southern Aquifer',
        'coordinates' => 'Way to the south',
        'status' => 'full',
      )],
      [array(
        'name' => 'Western Aquifer',
      )],
    ];
  }

  /**
   * Test updating a non-existing aquifer
   *
   * @covers ::createAquifer
   * @dataProvider provideMissingAquiferData
   * @expectedException \InvalidArgumentException
   */
  public function testCreateAquiferWithMissingData($aquiferData) {
/******************************************************************************
 **                                                                          **
 ** As already noted in our first test method, we are ultimately testing our **
 ** Aquifer Manager Service, which requires and entity manager interface to  **
 ** be injected. We mock all necessary objects to make that possible.        **
 **                                                                          **
 ******************************************************************************/
    $query_object = $this->getMockBuilder('Drupal\Core\Entity\Query\QueryInterface')
      ->getMock();
    $query_object->expects($this->any())
      ->method('condition')
      ->willReturn($query_object);
    $query_object->expects($this->any())
      ->method('count')
      ->willReturn($query_object);
/******************************************************************************
 **                                                                          **
 ** It's not stricly necessary that we tell the query object what to do when **
 ** it receives the request for the execute method. However, it is a good    **
 ** idea for us to be explicit that we are expecting the count to be zero,   **
 ** which indicates that the aquifer was not found.                          **
 **                                                                          **
 ******************************************************************************/
    $query_object->expects($this->any())
      ->method('execute')
      ->willReturn(0);
    $node = $this->getMockBuilder('\Drupal\node\Entity\Node')
      ->disableOriginalConstructor()
      ->getMock();
    $nodeStorage = $this->getMockBuilder('\Drupal\Core\Entity\EntityStorageInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $nodeStorage->expects($this->any())
      ->method('getQuery')
      ->willReturn($query_object);
/******************************************************************************
 **                                                                          **
 ** Note that we don't define the 'create' method for our node storage       **
 ** object. We should never need this method because we are expecting        **
 ** the service to throw \InvalidArgumentException                           **
 **                                                                          **
 ******************************************************************************/
    $entityManager = $this->getMockBuilder('\Drupal\Core\Entity\EntityManagerInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $entityManager->expects($this->any())
      ->method('getStorage')
      ->with('node')
      ->willReturn($nodeStorage);
    $aquiferManagerService = new AquiferManagerService($entityManager);
/******************************************************************************
 **                                                                          **
 ** We don't need an assertion. The call to the updateAquifer method should  **
 ** result in \InvalidArgumentException                                      **
 **                                                                          **
 ******************************************************************************/
    $aquiferManagerService->updateAquifer($aquiferData);
  }

  /**
   * Provides bad data for adding aquifers
   *
   * @return array
   *   The data to use for aquifers with undefined fields
   */
  public function provideBadAquiferData () {
    return [
      [array(
        'name' => 'Northern Aquifer',
        'coordinates' => 'Way up north',
        'status' => 'adequate',
        'volume' => '1',
        'bogusField' => 'throw an exception'
      )],
      [array(
        'name' => 'Eastern Aquifer',
        'coordinates' => 'Way to the east',
        'status' => 'low',
        'bogusField' => 'throw an exception',
        'volume' => '2'
      )],
      [array(
        'name' => 'Southern Aquifer',
        'coordinates' => 'Way to the south',
        'bogusField' => 'throw an exception',
        'status' => 'full',
        'volume' => '3'
      )],
      [array(
        'name' => 'Western Aquifer',
        'bogusField' => 'throw an exception',
        'coordinates' => 'Way to the south',
        'status' => 'critical',
        'volume' => '4'
      )],
    ];
  }

  /**
   * Test updating a non-existing aquifer
   *
   * @covers ::createAquifer
   * @dataProvider provideBadAquiferData
   * @expectedException \UnexpectedValueException
   */
  public function testCreateAquiferWithInvalidData($aquiferData) {
/******************************************************************************
 **                                                                          **
 ** As already noted in our first test method, we are ultimately testing our **
 ** Aquifer Manager Service, which requires and entity manager interface to  **
 ** be injected. We mock all necessary objects to make that possible.        **
 **                                                                          **
 ******************************************************************************/
    $query_object = $this->getMockBuilder('Drupal\Core\Entity\Query\QueryInterface')
      ->getMock();
    $query_object->expects($this->any())
      ->method('condition')
      ->willReturn($query_object);
    $query_object->expects($this->any())
      ->method('count')
      ->willReturn($query_object);
/******************************************************************************
 **                                                                          **
 ** It's not stricly necessary that we tell the query object what to do when **
 ** it receives the request for the execute method. However, it is a good    **
 ** idea for us to be explicit that we are expecting the count to be zero,   **
 ** which indicates that the aquifer was not found.                          **
 **                                                                          **
 ******************************************************************************/
    $query_object->expects($this->any())
      ->method('execute')
      ->willReturn(0);
    $node = $this->getMockBuilder('\Drupal\node\Entity\Node')
      ->disableOriginalConstructor()
      ->getMock();
/******************************************************************************
 **                                                                          **
 ** Note that we don't define the 'create' method for our node storage       **
 ** object. We should never need this method because we are expecting        **
 ** the service to throw \UnexpectedValueException                           **
 **                                                                          **
 ******************************************************************************/
    $nodeStorage = $this->getMockBuilder('\Drupal\Core\Entity\EntityStorageInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $nodeStorage->expects($this->any())
      ->method('getQuery')
      ->willReturn($query_object);
    $entityManager = $this->getMockBuilder('\Drupal\Core\Entity\EntityManagerInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $entityManager->expects($this->any())
      ->method('getStorage')
      ->with('node')
      ->willReturn($nodeStorage);
    $aquiferManagerService = new AquiferManagerService($entityManager);
/******************************************************************************
 **                                                                          **
 ** We don't need an assertion. The call to the updateAquifer method should  **
 ** result in \UnexpectedValueException                                      **
 **                                                                          **
 ******************************************************************************/
    $aquiferManagerService->updateAquifer($aquiferData);
  }

  /**
   * Provides good data for updating aquifers
   *
   * @return array
   *   The good data to use for updating aquifers
   */
  public function provideGoodUpdateAquiferData () {
    return [
      [array(
        'name' => 'Northern Aquifer',
        'coordinates' => 'Way up north',
      )],
      [array(
        'name' => 'Eastern Aquifer',
        'status' => 'low',
        'volume' => '2'
      )],
      [array(
        'name' => 'Southern Aquifer',
        'coordinates' => 'Way to the south',
        'volume' => '3'
      )],
      [array(
        'name' => 'Western Aquifer',
        'coordinates' => 'Way to the south',
        'status' => 'critical',
        'volume' => '4'
      )],
    ];
  }

  /**
   * Test updating an existing aquifer
   *
   * @covers ::updateAquifer
   * @dataProvider provideGoodUpdateAquiferData
   */
  public function testUpdateAquiferWithGoodData($aquiferData) {
/******************************************************************************
 **                                                                          **
 ** As already noted in our first test method, we are ultimately testing our **
 ** Aquifer Manager Service, which requires and entity manager interface to  **
 ** be injected. We mock all necessary objects to make that possible. We     **
 ** need an additional query object for the first query object to return so  **
 ** that we can have two different definitions for the 'execute' method. The **
 ** first execute must return a value of 1, which indicates that one aquifer **
 ** was found; we are going to update an existing aquifer. The other execute **
 ** method needs to return an array of values so that the reset() function   **
 ** will work.                                                               **
 **                                                                          **
 ******************************************************************************/
    $query_object2 = $this->getMockBuilder('Drupal\Core\Entity\Query\QueryInterface')
      ->getMock();
    $query_object2->expects($this->any())
      ->method('execute')
      ->willReturn(array(1));
    $query_object = $this->getMockBuilder('Drupal\Core\Entity\Query\QueryInterface')
      ->getMock();
    $query_object->expects($this->any())
      ->method('condition')
      ->willReturn($query_object);
    $query_object->expects($this->any())
      ->method('count')
      ->willReturn($query_object);
/******************************************************************************
 **                                                                          **
 ** It is most definitely necessary to return the value of 1 with this query **
 ** so that it appears that we have found an existing aquifer and we know    **
 ** that we will be updating it instead of creating a new aquifer.           **
 **                                                                          **
 ******************************************************************************/
    $query_object->expects($this->any())
      ->method('execute')
      ->willReturn(1);
    $query_object->expects($this->any())
      ->method('range')
      ->willReturn($query_object2);
    $node = $this->getMockBuilder('\Drupal\node\Entity\Node')
      ->disableOriginalConstructor()
      ->getMock();
    $nodeStorage = $this->getMockBuilder('\Drupal\Core\Entity\EntityStorageInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $nodeStorage->expects($this->any())
      ->method('getQuery')
      ->willReturn($query_object);
/******************************************************************************
 **                                                                          **
 ** Note that we are not defining the 'create' method but we have defined    **
 ** 'load' method. We are mocking the process of loading the aquifer we      **
 ** found. We are not going to have a need to create an aquifer, though.     **
 **                                                                          **
 ******************************************************************************/
    $nodeStorage->expects($this->any())
      ->method('load')
      ->willReturn($node);
    $entityManager = $this->getMockBuilder('\Drupal\Core\Entity\EntityManagerInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $entityManager->expects($this->any())
      ->method('getStorage')
      ->with('node')
      ->willReturn($nodeStorage);
    $aquiferManagerService = new AquiferManagerService($entityManager);
/******************************************************************************
 **                                                                          **
 ** The key piece we are testing in our expected result is the               **
 **   'status' => 'updated'                                                  **
 ** because we are testing updating an existing aquifer. The                 **
 **   'object' => $node                                                      **
 ** will always match because we are mocking all the pieces that are         **
 ** involved in the aquifer creation process. Specifically, the mocked node  **
 ** storage object doesn't actually do anything when we execute the save     **
 ** method. That actual method takes an object and acts on it directly.      **
 ** There is no reason for us to mock what the save method returns; it's     **
 ** supposed to return an integer value and the method that we are testing   **
 ** doesn't do anything with the return value. The method that we are        **
 ** testing returns the updated object, which in this case is our mocked     **
 ** node object.                                                             **
 **                                                                          **
 ******************************************************************************/
    $expectedResult = (object) array('status' => 'updated', 'object' => $node);
    $this->assertEquals($expectedResult, $aquiferManagerService->updateAquifer($aquiferData));
  }

  /**
   * Test updating an existing aquifer
   *
   * @covers ::updateAquifer
   * @dataProvider provideBadAquiferData
   * @expectedException \UnexpectedValueException
   */
  public function testUpdateAquiferWithBadData($aquiferData) {
/******************************************************************************
 **                                                                          **
 ** The mocking we do for this test is the same as we needed to do for the   **
 ** successful update test.                                                  **
 **                                                                          **
 ******************************************************************************/
    $query_object2 = $this->getMockBuilder('Drupal\Core\Entity\Query\QueryInterface')
      ->getMock();
    $query_object2->expects($this->any())
      ->method('execute')
      ->willReturn(array(1));
    $query_object = $this->getMockBuilder('Drupal\Core\Entity\Query\QueryInterface')
      ->getMock();
    $query_object->expects($this->any())
      ->method('condition')
      ->willReturn($query_object);
    $query_object->expects($this->any())
      ->method('count')
      ->willReturn($query_object);
/******************************************************************************
 **                                                                          **
 ** It is most definitely necessary to return the value of 1 with this query **
 ** so that it appears that we have found an existing aquifer and we know    **
 ** that we will be updating it instead of creating a new aquifer.           **
 **                                                                          **
 ******************************************************************************/
    $query_object->expects($this->any())
      ->method('execute')
      ->willReturn(1);
    $query_object->expects($this->any())
      ->method('range')
      ->willReturn($query_object2);
    $node = $this->getMockBuilder('\Drupal\node\Entity\Node')
      ->disableOriginalConstructor()
      ->getMock();
    $nodeStorage = $this->getMockBuilder('\Drupal\Core\Entity\EntityStorageInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $nodeStorage->expects($this->any())
      ->method('getQuery')
      ->willReturn($query_object);
/******************************************************************************
 **                                                                          **
 ** Note that we are not defining the 'create' method but we have defined    **
 ** 'load' method. We are mocking the process of loading the aquifer we      **
 ** found. We are not going to have a need to create an aquifer, though.     **
 **                                                                          **
 ******************************************************************************/
    $nodeStorage->expects($this->any())
      ->method('load')
      ->willReturn($node);
    $entityManager = $this->getMockBuilder('\Drupal\Core\Entity\EntityManagerInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $entityManager->expects($this->any())
      ->method('getStorage')
      ->with('node')
      ->willReturn($nodeStorage);
    $aquiferManagerService = new AquiferManagerService($entityManager);
/******************************************************************************
 **                                                                          **
 ** We don't need an assertion. The call to the updateAquifer method should  **
 ** result in \UnexpectedValueException                                      **
 **                                                                          **
 ******************************************************************************/
    $aquiferManagerService->updateAquifer($aquiferData);
  }

}
