<?php
include ('../include/conn.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<title>Admin Dashboard-sell</title>
	<style type="text/css">
		.exch{
			background-color: ;
			width: 100%;
			height: 50px;
			border: 1px solid white;
			color: whitesmoke;
		}
		.exch:hover {
			background-color: transparent;
			color: red;
			border: 1px solid red;

		}
		.excha{
			width: 100%;
			height: 50px;
			border: 1px solid white;
			color: whitesmoke;
		}
		.excha:hover {
			background-color: transparent;
			color: red;
			border: 1px solid red;

		}
	</style>
</head>
<body style="background-color: #002;">
<?php 
$sql="SELECT * FROM exchange_rates WHERE exch_type='sell'";
$results=mysqli_query($conn, $sql);
if (mysqli_num_rows($results) > 0){
	while ($row = mysqli_fetch_assoc($results)) {
		// code...
		$exch_type = $row['exch_type'];
		$kess = $row['kes'];
		$ugxs = $row['ugx'];
		$usdks = $row['usdk'];
		$usdus = $row['usdu'];
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
<div class="container">
	<div class="row">
		<div class="col-md-3">
			
		</div>
		<div class="col-md-4 mt-4">
			<form action="dash1.php" method="post">
			<center><table class="table table-center table-striped table-dark">
	            <thead>
	                <tr>
	                    <td>Currency</td>
	                    <td><a href="buy.php" class="btn p-2 excha">Buy</a></td>
	                    <td class="btn p-2 mt-2 exch" disabled selected>Sell</a> </td>
	                </tr>
	            </thead>
	            <tr>
	                <td>KES</td>
	                <td><input type="text" value="<?php echo $kesb; ?>" name="b_kes" disabled></td>
	                <td><input type="text" value="<?php echo $kess?>" name="s_kes"></td>
	            </tr>
	            <tr>
	                <td>UGX</td>
	                <td><input type="text" value="<?php echo $ugxb; ?>" disabled name="b_ugx"></td>
	                <td><input type="text" value="<?php echo $ugxs; ?>" name="s_ugx" ></td>
	            </tr>
	            <tr>
	                <td>USD(K)</td>
	                <td><input type="number" value="<?php echo $usdkb; ?>" disabled name="b_usdk"></td>
	                <td><input type="number" value="<?php echo $usdks; ?>" name="s_usdk"></td>
	            </tr>
	            <tr>
	                <td>USD(U)</td>
	                <td><input type="number" value="<?php echo $usdub; ?>" disabled name="b_usdu"></td>
	                <td><input type="number" value="<?php echo $usdus; ?>" name="s_usdu"></td>
	            </tr>
	            <tr>
	            	<td colspan="3">
	            		<input type="submit" name="sub" value="Submit changes" class="form-control">
	            	</td>
	            </tr>
	        </table></center></form>
		</div>
	</div>
</div>
<?php } } } } ?>
</body>
</html>