<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

//echo "Connected to server successfully\r\n"."<br>";
//jaeznet.pe.hu/addStock.php?nse-stock=NIFTY

$nse_stock1 = $_GET[ 'nse-stock' ] ;
$nse_stock = strtoupper($nse_stock1);
date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d');
$sql = "INSERT INTO NseStocks (nse_stock_name,date) VALUES ('$nse_stock','$date')";
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

if (@file_get_contents("http://finance.google.com/finance/info?client=ig&q=NSE:" . $nse_stock)){
	if (mysqli_query($con, $sql) ) {
		echo "Values have been inserted successfully\r\n"."<br>";
		createTables();
	}
	else {
		echo "Error in running query";
	}
}else{
	echo "Stock not listed in NSE";
}

function createTables(){
	echo "Creating tables";
}

mysqli_close($con) ;
//echo "Connected to server closed successfully\r\n";
?>		
