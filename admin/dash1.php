<?php 
include ('../include/conn.php');
if (isset($_POST['submit'])){
    $kes = $_POST['b_kes'];
    $ugx = $_POST['b_ugx'];
    $usdk = $_POST['b_usdk'];
    $usdu = $_POST['b_usdu'];
    $admin_id = 1;
    $exch_type = 'buy';
    $pri_key = uniqid();
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE exchange_rates SET admin_id='$admin_id', pri_key='$pri_key', exch_type='$exch_type', kes='$kes', ugx='$ugx', usdk='$usdk', usdu='$usdu', date='$date' WHERE exch_type='buy'";
    if($conn->query($sql) === TRUE) {
        echo "<script>
            window.location='buy.php?success';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;  
    }
} else if (isset($_POST['sub'])){
    $kes = $_POST['s_kes'];
    $ugx = $_POST['s_ugx'];
    $usdk = $_POST['s_usdk'];
    $usdu = $_POST['s_usdu'];
    $admin_id = 1;
    $exch_type = 'sell';
    $pri_key = uniqid();
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE exchange_rates SET admin_id='$admin_id', pri_key='$pri_key', exch_type='$exch_type', kes='$kes', ugx='$ugx', usdk='$usdk', usdu='$usdu', date='$date' WHERE exch_type='sell'";
    if($conn->query($sql) === TRUE) {
        echo "<script>
            window.location='sell.php?success';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;  
    }
}
?>