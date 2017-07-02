<?php

/******************************************************************************
 **                                                                          **
 ** Remember to include the domain as a query argument!                      **
 **                                                                          **
 ******************************************************************************/
$domain = $_GET['domain'];

// See if a particular format was requested
if (isset($_GET['format'])) {
  $format = $_GET['format'];
}  else {
  $format = 'json';
}

/******************************************************************************
 **                                                                          **
 ** Note that we are appending the _format query argument. This argument     **
 ** specifies the serialization format of Drupal's response, not the format  **
 ** in which we will send the data. We MUST send the data in hal+json format.**
 ** @see:
 ** https://www.drupal.org/docs/8/core/modules/rest/3-post-for-creating-content-entities
 ** As of Drupal 8.3.0 you may use /node instead of /entity/node. It is still**
 ** possible to use /entity/node until Drupal 9.0.                           **
 **                                                                          **
 ******************************************************************************/
$rest_uri = 'http://' . $domain . '/entity/node?_format=' . $format;
$timestamp = date('F j, Y g:i a');

/******************************************************************************
 **                                                                          **
 ** Drupal requires us to supply the '_links' key. The easiest way to figure **
 ** out how to build the links key is to first to a "GET" on the node type   **
 ** you wish to build and examine the response. Doing this also helps you    **
 ** figure out how to build the rest of the data.                            **
 **                                                                          **
 ******************************************************************************/
$post_fields = array(
  '_links' => array(
    'type' => array(
      'href' => 'http://' . $domain . '/rest/type/node/water_eco_action',
    ),
  ),
  'title' => array(0 => array('value' => 'My POSTed WEA - ' . $timestamp)),
  'type' => array(0 => array('target_id' => 'water_eco_action')),
  'field_wea_description' => array(0 => array('value' => 'I successfully created this with a POST operation at ' . $timestamp . '!')),
);

/******************************************************************************
 **                                                                          **
 ** Drupal (supposedly) requires a token in order to prevent Cross Site      **
 ** Request Forgery.                                                         **
 ** @see:
 ** https://www.drupal.org/docs/8/api/restful-web-services-api/restful-web-services-api-overview#fundamentals--x-csrf-token
 **                                                                          **
 ******************************************************************************/
$tokenRetriever = new tokenRetriever($domain);
$token = $tokenRetriever->getToken();

// Execute a cURL call
$curlExecutor = new curlExecutor($rest_uri, $token, $post_fields);
$result = $curlExecutor->postFields();
if ($format == 'xml') {
  $decoded_result = new SimpleXMLElement($result);
} else {
  $decoded_result = json_decode($result);
}

/******************************************************************************
 **                                                                          **
 ** We are going to display the results of our cURL request as a simple      **
 ** HTML page.                                                               **
 **                                                                          **
 ******************************************************************************/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>"POST"ing data via Drupal core</title>
  </head>
  <body>
    <h1>Here is some lovely information for you!</h1>
    <h2>This is the data we sent.</h2>
<?php
echo "<pre>" . print_r($post_fields, 1) . "</pre>";
?>
    <h2>This is the data we received.</h2>
<?php
echo "<pre>" . print_r($decoded_result, 1) . "</pre>";
?>
  </body>
</html>
<?php
// Yippee! We successfully completed the script :)
exit(0);

/**
 * cURL Token Retriever
 */
class tokenRetriever {
  public $domain;
  public $restURI;
  public function __construct(string $domain) {
    $this->domain = $domain;
    $this->restURI = 'http://' . $domain . '/session/token';
  }
  public function getToken() {
    // Setup the cURL request.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->restURI);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    // Report any errors
    if ($error = curl_error($ch)) {
      $error_message = "cURL error at $this->endPoint: $error";
      throw new Exception($error_message);
    }
    curl_close($ch);
    return $result;
  }
}

/**
 * cURL Executor
 */
class curlExecutor {
  public $restURI;
  public $token;
  public $postFields;
  public function __construct(string $rest_uri, string $token, array $post_fields) {
    $this->restURI = $rest_uri;
    $this->token = $token;
    $this->postFields = $post_fields;
  }

  public function postFields() {
    // Setup the cURL request.
    $data = json_encode($this->postFields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->restURI);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

/******************************************************************************
 **                                                                          **
 ** Look out! We are sending a clear text user:password combination. We'd    **
 ** really want to:                                                          **
 **   1) Pull our credentials from a protected file on the server            **
 **   2) Use only sites that run secure http protocol (https://)             **
 **                                                                          **
 ******************************************************************************/
    curl_setopt($ch, CURLOPT_USERPWD, 'rest_user:rest_user');
    // We need to set the header at the end because PHP cURL sets it to
    // 'Content-type: application/x-www-form-urlencoded'
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-type: application/hal+json',
      'X-CSRF-Token: ' . $this->token
    ));
    $result = curl_exec($ch);
    // Report any errors
    if ($error = curl_error($ch)) {
      $error_message = "cURL error at $this->endPoint: $error";
      throw new Exception($error_message);
    }
    curl_close($ch);
    return $result;
  }

}
