<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

//echo "Connected to server successfully\r\n"."<br>";
//jaeznet.pe.hu/removeStock.php?nse-stock=NIFTY

$nse_stock1 = $_GET[ 'nse-stock' ] ;
$nse_stock = mysqli_real_escape_string($con, strtoupper($nse_stock1));

$sql = "DELETE FROM NseStocks
        WHERE nse_stock_name = '$nse_stock'";


//echo file_get_contents("http://finance.google.com/finance/info?client=ig&q=NSE:NIFTY",NULL,NULL,4);
//echo "<br>";

//To ignore errors, but this makes the statement TRUE even in if it is FALSE
//$context = stream_context_create(array(
//    'http' => array('ignore_errors' => true),
//));
//echo file_get_contents("http://finance.google.com/finance/info?client=ig&q=NSE:" . $nse_stock, false, $context);
//echo "<br>";

//Handle file_get_contents error in php. Works like charm
//Step 1: check the return code: if($content === FALSE) { // handle error here... }

//Step 2: suppress the warning by putting an @ in front of the file_get_contents: $content = @file_get_contents($site);


	if (mysqli_query($con, $sql) ) {
		//dropTables($con, $nse_stock);
		// Instead write code for deleting stocks from user NseStocks table
		
		echo "$nse_stock removed successfully from your NSE stock list";
	}
	else {
		echo "$nse_stock could not be removed from your NSE stock list";
	}

function dropTables($con, $nse_stock){
	
	$daily = "Daily$nse_stock";
	
$sql = "DROP TABLE $daily";
	mysqli_query($con, $sql);	
	
$sql = "DROP TABLE $nse_stock";
	mysqli_query($con, $sql);
}

mysqli_close($con) ;
//echo "Connected to server closed successfully\r\n";
?>		
