<?php

/******************************************************************************
 **                                                                          **
 ** Remember to include the domain as a query argument!                      **
 ** Remember to include the item number as a query argument!                 **
 **                                                                          **
 ******************************************************************************/
$domain = $_GET['domain'];
$item = $_GET['item'];
$rest_uri = 'http://' . $domain . '/views/wea/' . $item;

// Execute a cURL call
$curlExecutor = new curlExecutor($rest_uri);
$results = $curlExecutor->getRecords();
$decoded_results = json_decode($results);

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
    <title>"GET"ing data from Views</title>
  </head>
  <body>
    <h1>This is the data received.</h1>
<?php
foreach ($decoded_results as $decoded_result) {
  echo "<ul>";
  echo "<li>Title: " . $decoded_result->wea_title . "</li>";
  echo "<li>Coordinates: " . $decoded_result->wea_coordinates . "</li>";
  echo "<li>Description: " . $decoded_result->wea_description . "</li>";
  echo "</ul>";
}
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
