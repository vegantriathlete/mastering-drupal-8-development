<?php

/******************************************************************************
 **                                                                          **
 ** Remember to include the domain as a query argument!                      **
 ** Remember to include the item number as a query argument!                 **
 **                                                                          **
 ******************************************************************************/
$domain = $_GET['domain'];
$item = $_GET['item'];

// See if a particular format was requested
if (isset($_GET['format'])) {
  $format = $_GET['format'];
}  else {
  $format = 'json';
}

// See if a particular language was requested
if (isset($_GET['language'])) {
  $language = $_GET['language'];
}  else {
  $language = 'en';
}

/******************************************************************************
 **                                                                          **
 ** The URI we use is determined by the Annotation in our resource,          **
 ** specifically the canonical entry.                                        **
 **  uri_paths = {                                                           **
 **    "canonical" = "/iai_ocean_temperature/data/{id}",                     **
 **    "https://www.drupal.org/link-relations/create" = "/iai_ocean_temperature/data" **
 **  }                                                                       **
 **                                                                          **
 ******************************************************************************/
if ($language == 'en') {
  $rest_uri = 'http://' . $domain . '/iai_ocean_temperature/data/' . $item . '?_format=' . $format;
} else {
  $rest_uri = 'http://' . $domain . '/' . $language . '/iai_ocean_temperature/data/' . $item . '?_format=' . $format;
}

// Execute a cURL call
$curlExecutor = new curlExecutor($rest_uri);
$results = $curlExecutor->getRecords();
if ($format == 'xml') {
  $decoded_results = new SimpleXMLElement($results);
} else {
  $decoded_results = json_decode($results);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>"GET"ing Ocean Data</title>
  </head>
  <body>
    <h1>This is the data received.</h1>
<?php

/******************************************************************************
 **                                                                          **
 ** We haven't bothered to do any type of error checking. So, we may get     **
 ** various Notices, Warnings or Errors depending on what item we've         **
 ** requested. We also haven't bothered to change any of the text on the     **
 ** page to reflect a language other than English. The results we receive    **
 ** will be for either the English or Spanish translation as determined by   **
 ** the URI we use to call our REST resource.                                **
 **                                                                          **
 ******************************************************************************/
  echo "<ul>";
  echo "<li>Label: " . $decoded_results->label . "</li>";
  echo "<li>Coordinates: " . $decoded_results->coordinates . "</li>";
  echo "<li>Depth: " . $decoded_results->depth . "</li>";
  echo "<li>Temperature: " . $decoded_results->temperature . "</li>";
  echo "<li>Date: " . $decoded_results->date . "</li>";
  echo "<li>Reporter: " . $decoded_results->reporter . "</li>";
  echo "</ul>";
?>
  </body>
</html>
<?php
// Yippee! We successfully completed the script :)
exit(0);

/**
 * cURL Executor
 */
class curlExecutor {
  public $restURI;

  public function __construct(string $rest_uri) {
    $this->restURI = $rest_uri;
  }

  public function getRecords() {
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
