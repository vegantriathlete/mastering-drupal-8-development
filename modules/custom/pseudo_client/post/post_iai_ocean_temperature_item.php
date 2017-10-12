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
 ** in which we will send the data.                                          **
 **                                                                          **
 ** The URI we use is determined by the Annotation in our resource,          **
 ** specifically the link-relation/create entry.                             **
 **  uri_paths = {                                                           **
 **    "canonical" = "/iai_wea/actions/{id}",                                **
 **    "https://www.drupal.org/link-relations/create" = "/iai_wea/actions"   **
 **  }                                                                       **
 **                                                                          **
 ******************************************************************************/
$rest_uri = 'http://' . $domain . '/iai_ocean_temperature/data?_format=' . $format;
$timestamp = date('F j, Y g:i a');

/******************************************************************************
 **                                                                          **
 ** Look how much simpler our POST fields are!                               **
 **                                                                          **
 ******************************************************************************/
$post_fields = array(
  'label' => 'My custom POSTed IAI Ocean Temperature Item - ' . $timestamp,
  'coordinates' => '39.7392° N, 104.9903° W',
  'temperature' => 54.2,
  'depth' => 25,
  'date' => time(),
  'reporter' => 'post_iai_ocean_temperature_item.php'
);
if (isset($_GET['language'])) {
  $post_fields['language_code'] = $_GET['language'];
}

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
    <title>"POST"ing data via custom code</title>
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
    curl_setopt($ch, CURLOPT_USERPWD, 'ocean_data_reporter:ocean_data_reporter');
    // We need to set the header at the end because PHP cURL sets it to
    // 'Content-type: application/x-www-form-urlencoded'
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-type: application/json',
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
