<?php 
    include('include/conn.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <title>Kalulu Exchange Rates</title>
</head>
<body style="background: #003;">
<?php 
$sql="SELECT * FROM exchange_rates WHERE exch_type='sell'";
$results=mysqli_query($conn, $sql);
if (mysqli_num_rows($results) > 0){
    while ($row = mysqli_fetch_assoc($results)) {
        // code...
        $exch_type = $row['exch_type'];
        $kess = $row['kes'];
        $ugxs = $row['ugx'];
        $usdus = $row['usdu'];
        $usdks = $row['usdk'];
        $dates = $row['date'];?>
        <?php 
        $pap="SELECT * FROM exchange_rates WHERE exch_type='buy'";
        $res=mysqli_query($conn, $pap);
        if (mysqli_num_rows($res) > 0){     
            while ($rows = mysqli_fetch_assoc($res)){
            $exch_type = $row['exch_type'];
            $kesb = $rows['kes'];
            $ugxb = $rows['ugx'];   
            $usdkb = $rows['usdk'];
            $usdub = $rows['usdu'];
            $dateb = $rows['date'];?>

<?php
if (isset($_POST['sub'])){
    $num1=$_POST['n1'];
    $oprnd=$_POST['sub'];
    $exch=$_POST['exchange'];
    $rates=$_POST['rates'];
    $currency=$_POST['currency'];
    if ($currency=="kes") {
        if ($exch=="buy"){
            if ($rates=="ugx")
                $ans= $num1*$ugxb;
            elseif ($rates=="kes")
                $ans=$num1;
            elseif ($rates=="usd")
                $ans=$num1/$usdkb;
        } elseif ($exch="sell") {
            if ($rates=="ugx")
                $ans=$num1*$ugxs;
            else if ($rates=="kes")
                $ans=$num1;
            else if ($rates=="usd")
                $ans=$num1/$usdks;
        }
    } elseif ($currency=="ugx"){
        if ($exch=="buy"){
            if ($rates=="ugx")
                $ans= $num1;
            elseif ($rates=="kes")
                $ans=$num1/$kesb;
            elseif ($rates=="usd")
                $ans=$num1/$usdub;
        } elseif ($exch="sell") {
            if ($rates=="ugx")
                $ans=$num1;
            else if ($rates=="kes")
                $ans=$num1/$kess;
            else if ($rates=="usd")
                $ans=$num1/$usdus;
        }
    } else {
        if ($exch=="buy"){
            if ($rates=="ugx")
                $ans= $num1*$usdub;
            elseif ($rates=="kes")
                $ans=$num1*$usdkb;
            elseif ($rates=="usd")
                $ans=$num1;
        } elseif ($exch="sell") {
            if ($rates=="ugx")
                $ans=$num1*$usdus;
            else if ($rates=="kes")
                $ans=$num1*$usdks;
            else if ($rates=="usd")
                $ans=$num1;
        }
    }


    require_once('include/google-api/vendor/autoload.php');
    function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Project');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        //PATH TO JSON FILE DOWNLOADED FROM GOOGLE CONSOLE
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
        $currency
        , $num1
      , $exch
      , $rates 
      , $ans
      , date("j, Y, g:i a", time()) 
    ]]);

    $conf = ["valueInputOption" => "RAW"];
    $response = $service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf);
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 text-light">
            <h4 class="text-light text-center" style="font-family: cursive; font-weight: bolder; text-shadow: 0px 1px 2px red;">Kalulu Enterprise</h4><br>
            <div class="bg-transparent p-4" style="width: 100%; height: 100px; border: 1px solid red;">
                <span class="float-left">Result:</span> 
                <span class="text-light float-right h2"><?php 
                if ($ans=="")
                    $ans = 0;
                echo $ans; ?>
                </span>
            </div>
            <form method="POST" action="">
            <label>Amount <i class="fa fa-money"></i>: </label> 
            <div class="row">
                <div class="col-4">
                    <select required name="currency" class="form-control"> 
                    <option selected disabled>currency</option> 
                    <option value="kes">KES</option> 
                    <option value="ugx">UGX</option> 
                    <option value="usd">USD</option> 
                </select> 
                </div>
                <div class="col-8">
                    <input type="number" name="n1" value="" placeholder="Enter Amount" class="form-control" required>
                </div>                
            </div> <label>Exchange <i class="fa fa-exchange"></i>:</label> <select name="exchange" class="form-control">
                <option selected disabled>---select exchange--</option>
                <option value="buy" onselect="">Buy</option>
                <option value="sell">Sell</option>
            </select>
            <label>Rates <i class="fa fa-clock-o"></i> :</label> <select name="rates" class="form-control">
                <option selected disabled>--select rates---</option>
                <option value="ugx">Uganda (UGX)</option>   
                <option value="kes">Kenya (KES)</option>
                <option value="usd">US (USD)</option>
            </select> <br>
            <center><input type="submit" name="sub" class="btn btn-success w-50 bg-transparent text-success" style="font-weight: bold; font-size: 18px;" value="="></center><br>
            </form>
            <!-- start exchange rates section -->
            <center>
                <table class="table table-center table-striped table-dark" style="font-size: 10px; font-weight: bolder; font-family: ;">
                    <thead>
                        <tr class="bg-success">
                            <td></td>
                            <td>KES</td>
                            <td>$(K)</td>
                            <td>UGX</td>
                            <td>$(U)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-light" style="text-shadow: 1px 1px 2px red;">
                            <td class="bg-primary text-light">Buy</td>
                            <td><?php echo $kesb; ?></td>
                            <td><?php echo $usdkb; ?></td>
                            <td><?php echo $ugxb; ?></td>
                            <td><?php echo $usdub; ?></td>
                        </tr>
                        <tr class="text-danger">
                            <td class="bg-danger text-light">Sell</td>
                            <td><?php echo $kess; ?></td>
                            <td><?php echo $usdks; ?></td>
                            <td><?php echo $ugxs; ?></td>
                            <td><?php echo $usdus; ?></td>
                        </tr>
                    </tbody>
                </table>
            </center>
            <!-- end exchange rates section -->
        </div>

        <div class="col-md-4">
            
        </div>
    </div>
</div>
<?php  } } } } ?>
</body>
</html>