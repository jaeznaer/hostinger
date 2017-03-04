<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

//echo "Connected to server successfully\r\n"."<br>";
//jaeznet.pe.hu/addStock.php?nse-stock=NIFTY

$nse_stock = $_GET[ 'nse-stock' ] ;
date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d');
$sql = "INSERT INTO NseStocks (nse_stock_name,date) VALUES ('$nse_stock','$date')";
echo file_get_contents("http://finance.google.com/finance/info?client=ig&q=NSE:NIFTY",NULL,NULL,2);
echo "<br>";
//echo substr('// [ { "id": "15274130" ,"t" : "BHEL" ,"e" : "NSE" ,"l" : "158.25" ,"l_fix" : "158.25" ,"l_cur" : "₹158.25" ,"s": "0" ,"ltt":"3:40PM GMT+5:30" ,"lt" : "Mar 3, 3:40PM GMT+5:30" ,"lt_dts" : "2017-03-03T15:40:10Z" ,"c" : "+0.05" ,"c_fix" : "0.05" ,"cp" : "0.03" ,"cp_fix" : "0.03" ,"ccol" : "chg" ,"pcls_fix" : "158.2" } ]',3);
$context = stream_context_create(array(
    'http' => array('ignore_errors' => true),
));
echo file_get_contents("http://finance.google.com/finance/info?client=ig&q=NSE:" . $nse_stock, false, $context);
echo "<br>";
if (file_get_contents("http://finance.google.com/finance/info?client=ig&q=NSE:" . $nse_stock, false, $context)){
	if (mysqli_query($con, $sql) ) {
		echo "Values have been inserted successfully\r\n"."<br>";
	}
	else {
		echo "Error in running query";
	}
}else{
	echo "Stock not listed in NSE";
}

mysqli_close($con) ;
//echo "Connected to server closed successfully\r\n";
?>		
