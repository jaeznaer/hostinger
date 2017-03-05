<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

	//jaeznet.pe.hu/currentStock.php?nse-stock=NIFTY

	$stock = $_GET[ 'nse-stock' ] ;

	$json = file_get_contents("http://finance.google.com/finance/info?client=ig&q=NSE:$stock",NULL,NULL,4);
	
	print(json_decode($json));

mysqli_close($con) ;
//echo "Connection to server closed successfully\r\n";
?>
