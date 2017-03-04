<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

//echo "Connected to server successfully\r\n"."<br>";
//jaeznet.pe.hu/addStock.php?nse-stock=NIFTY

$nse_stock = $_GET[ 'nse-stock' ] ;

$sql = "INSERT INTO NseStocks (nse_stock_name) VALUES ('$nse_stock')";

//$result = mysqli_query($con,$sql);
//$row = mysqli_fetch_array($result);
//$data = $row[0];

//if ($data) {
//	echo "yes";
//}
//else {
	if (mysqli_query($con, $sql) ) {
	echo "Values have been inserted successfully\r\n"."<br>";
	}
	else {
	echo "Error in running query";
	}
//}
mysqli_close($con) ;
//echo "Connected to server closed successfully\r\n";
?>		
