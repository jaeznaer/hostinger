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
	checkData($con, $stock);
}

function checkData($con, $stock){

$result = mysqli_query($con,"SELECT close_chg FROM $stock 
ORDER BY id DESC
LIMIT 3");
$chgArray = Array();
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    $chgArray[] =  $row['close_chg'];  
}

$chgRes = Array();
foreach ($chgArray as $chg){
	if (1/$chg > 0){
		$chgRes[] = "high";
	}else{
		$chgRes[] = "low";
	}
}
if (!in_array("high", $chgRes)) {
    echo "All Low <br>";
}
else if (!in_array("low", $chgRes)) {
    echo "All High <br>";
}
else {
	foreach ($chgRes as $value){
		echo $value."<br>";
	}
}

mysqli_close($con) ;
//echo "Connection to server closed successfully\r\n";
?>
