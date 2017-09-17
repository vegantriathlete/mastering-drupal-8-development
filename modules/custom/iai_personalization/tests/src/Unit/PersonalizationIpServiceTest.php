<?php

/**
 * @file
 *
 * Contains \Drupal\Tests\iai_personalization\Unit\PersonalizationIpServiceTest
 */

namespace Drupal\Tests\iai_personalization\Unit;

use Drupal\iai_personalization\PersonalizationIpService;
use Drupal\Tests\UnitTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tests methods in the Personalization Ip Service
 *
 * @coversDefaultClass \Drupal\iai_personalization\PersonalizationIpService
 * @group iai_personalization
 */
class PersonalizationIpServiceTest extends UnitTestCase {

  /**
   * The mocked request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack|\PHPUnit_Framework_MockObject_MockObject
   */
  protected $requestStack;

  /**
   * The tested Personalization Ip Service
   *
   * @var \Drupal\personalization\PersonalizationIpService
   */
  protected $personalizationIpService;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

/******************************************************************************
 **                                                                          **
 ** We will use the same mocked objects in all of our tests so we are        **
 ** mocking them in the setUp method. This method is called prior to running **
 ** each test.                                                               **
 **                                                                          **
 ******************************************************************************/
    $this->requestStack = $this->getMock('Symfony\Component\HttpFoundation\RequestStack');
    $request = Request::create('/test-path');
    $request->server->set('REMOTE_ADDR', '127.0.0.1');
    $this->requestStack->expects($this->any())
      ->method('getCurrentRequest')
      ->willReturn($request);
    $this->personalizationIpService = new PersonalizationIpService($this->requestStack);

  }

  /**
   * Test returning the Ip Address
   *
   * @covers ::getIpAddress
   */
  public function testGetIpAddress() {
/******************************************************************************
 **                                                                          **
 ** The IP Address should be equal to whatever we set the remote address to  **
 ** be in the request object we mocked in our setUp method.                  **
 **                                                                          **
 ******************************************************************************/
    $this->assertEquals('127.0.0.1', $this->personalizationIpService->getIpAddress());
  }

  /**
   * Test mapping the Ip Address
   *
   * @covers ::mapIpAddress
   * @dataProvider provideIpAddresses
   */
  public function testMapIpAddress($mappedResult, $ipAddress) {
    $this->assertEquals($mappedResult, $this->personalizationIpService->mapIpAddress($ipAddress));
  }

  /**
   * Provides Ip Addresses to test
   *
   * @return array
   *   The data to test for Ip Addresses
   */
  public function provideIpAddresses () {
/******************************************************************************
 **                                                                          **
 ** The mapIpAddress method always returns the same coordinates no matter    **
 ** what is passed into it. The first test should result in mapIpAddress     **
 ** receiving 127.0.0.1 (which is what we specified in the mocked request    **
 ** object) after it calls the getIpAddress method. We have already tested   **
 ** the getIpAddress method in another test, so it's not strictly necessary  **
 ** to have a test case with a blank IP Address. In fact, it's not strictly  **
 ** necessary to test with an additional IP Address. However, it's useful to **
 ** have this data provider set up in the event that some day we update the  **
 ** mapIpAddress method so that it has more logic in it.                     **
 **                                                                          **
 ******************************************************************************/
    return [
      ['39.7392° N, 104.9903° W', ''],
      ['39.7392° N, 104.9903° W', '151.101.113.175']
    ];
  }

}
