<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}
//echo "Connected to server successfully"."<br>";
$result = mysqli_query($con,"SELECT nse_stock_name FROM NseStocks");
$stockArray = Array();
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    $stockArray[] =  $row['nse_stock_name'];  
}

foreach ($stockArray as $stock){
	//setIncrement($con, $stock);
	delData($con, $stock);
}

function delData($con, $stock){

$sql = "TRUNCATE TABLE Daily$stock";
	if (mysqli_query($con, $sql) ) {
		echo "Daily$stock truncated successfully "."<br>";
	}
	else {
		echo "Daily$stock is already truncated";
	}
}

mysqli_close($con) ;
//echo "Connection to server closed successfully\r\n";
?>
