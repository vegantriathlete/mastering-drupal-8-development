<?php

namespace Drupal\iai_aquifer;

/**
 * An implementation of AquiferRetrievalServiceInterface.
 */

/******************************************************************************
 **                                                                          **
 ** This is just a mocked up service. It doesn't actually use any external   **
 ** service.                                                                 **
 **                                                                          **
 ******************************************************************************/
class AquiferRetrievalService implements AquiferRetrievalServiceInterface {

  /**
   * The base REST endpoint
   */
  protected $restEndpoint;

  /**
   * Constructs the Aquifer Retrieval Service object.
   *
   * @param string $rest_endpoint
   *   The base REST endpoint to call
   */
  public function __construct(string $rest_endpoint) {

/******************************************************************************
 **                                                                          **
 ** Symfony knows to pass the $rest_endpoint to our constructor because we   **
 ** specified it as an argument in our iai_aquifer.services.yml.             **
 **                                                                          **
 ******************************************************************************/
    $this->restEndpoint = $rest_endpoint;
  }

  /**
   * {@inheritdoc}
   */
  public function getTotalAquifers($region = 'ALL') {

/******************************************************************************
 **                                                                          **
 ** We aren't really going to pay attention to the arguments. If we were     **
 ** creating an actual service, then we'd query some endpoint and use the    **
 ** arguments to help refine our query. For the purpose of this example, we  **
 ** are just going to return the same hard-coded value every time.           **
 **                                                                          **
 ******************************************************************************/
    return 100;
  }

  /**
   * {@inheritdoc}
   */
  public function getAquiferNames($region = 'ALL', $limit = -1, $offset = 0) {
    $aquiferNames = array();

/******************************************************************************
 **                                                                          **
 ** We aren't really going to pay attention to the arguments. If we were     **
 ** creating an actual service, then we'd query some endpoint and use the    **
 ** arguments to help refine our query. For the purpose of this example, we  **
 ** are just going to return the same hard-coded value every time.           **
 **                                                                          **
 ******************************************************************************/
    $aquiferNames = array(
      'bigBlue',
      'deepOcean',
      'vastSea',
    );

    return $aquiferNames;
  }

  /**
   * {@inheritdoc}
   */
  public function getAquiferData($name = NULL) {

/******************************************************************************
 **                                                                          **
 ** If we were creating an actual service, then we'd query an endpoint to    **
 ** get the data. For the purpose of this example, we are expecting only     **
 ** three possible aquifers.                                                 **
 **                                                                          **
 ******************************************************************************/
    $aquiferData = array();
    switch ($name) {
      case 'bigBlue':
        $aquiferData['coordinates'] = '47.7231° N, 86.9407° W';
        $aquiferData['status'] = 'low';
        $aquiferData['volume'] = 1000000;
        break;
      case 'deepOcean':
        $aquiferData['coordinates'] = '14.5994° S, 28.6731° W';
        $aquiferData['status'] = 'full';
        $aquiferData['volume'] = 1000000000000;
        break;
      case 'vastSea':
        $aquiferData['coordinates'] = '34.5531° N, 18.0480° E';
        $aquiferData['status'] = 'adequate';
        $aquiferData['volume'] = 1000000000;
        break;
      default:
        $aquiferData['coordinates'] = 'unknown';
        $aquiferData['status'] = 'N/A';
        $aquiferData['volume'] = 'unknown';
    }
    return $aquiferData;
  }
}
