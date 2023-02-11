<?php
require_once('include/google-api/vendor/autoload.php');

function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Project');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
    //PATH TO JSON FILE DOWNLOADED FROM GOOGLE CONSOLE FROM STEP 7
    $client->setAuthConfig('include/kalulu-373607-bafda723bd28.json'); 
    $client->setAccessType('offline');
    return $client;
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets($client);
$spreadsheetId = '1IYeqSp3deEAzwITgfCigESwYi9kORfUTeS7AT5ax0gc'; // google sheets Id
$range = 'Sheet1'; // Sheet name
$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => ["a", "b"]]); // values for each cell
$valueRange->setValues(["values" => [
    $_POST["name"]
  , $_POST["email"]
  , $_POST["position"]
  , $_POST["phone"]
  , date("F j, Y, g:i a", time()) 
]]);

$conf = ["valueInputOption" => "RAW"];
$response = $service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf);
echo "<script>window.location='index.php'</script>";
?>
