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
	fetchData($con, $stock);
}

function fetchData($con, $stock){
$stockArray = Array();
	
$sql = "SELECT ltp FROM Daily$stock
ORDER BY id ASC
LIMIT 1";
$open = mysqli_query($con, $sql);
$row = mysqli_fetch_array($open, MYSQL_ASSOC);
$stockArray[0]=$row['ltp'];
echo $stockArray[0]."<br>";

$sql1 = "SELECT ltp FROM Daily$stock
ORDER BY id DESC
LIMIT 1";
$close = mysqli_query($con, $sql1);
$row = mysqli_fetch_array($close, MYSQL_ASSOC);
$stockArray[1]=$row['ltp'];
	echo $stockArray[1]."<br>";

$sql2 = "SELECT MAX(ltp) AS highPrice FROM Daily$stock";
$high = mysqli_query($con, $sql2);
//echo $high."<br>";
//Object of class mysqli_result could not be converted to string
//echo $high->fetch_object()->ltp;
$row = mysqli_fetch_array($high, MYSQL_ASSOC);
$stockArray[2]=$row['highPrice'];
	echo $stockArray[2]."<br>";

$sql3 = "SELECT MIN(ltp) AS lowPrice FROM Daily$stock";
$low = mysqli_query($con, $sql3);
//echo $low."<br>";
$row = mysqli_fetch_array($low, MYSQL_ASSOC);
$stockArray[3]=$row['lowPrice'];
	echo $stockArray[3]."<br>";

$sql4 = "SELECT DISTINCT chg AS closeC FROM Daily$stock WHERE chg = '$close'";
$close_chg = mysqli_query($con, $sql4);
$row = mysqli_fetch_array($close_chg, MYSQL_ASSOC);
$stockArray[4]=$row['closeC'];
	echo $stockArray[4]."<br>";

$sql5 = "SELECT DISTINCT chg_p FROM Daily$stock WHERE chg = '$close'";
$close_cp = mysqli_query($con, $sql5);
$row = mysqli_fetch_array($close_cp, MYSQL_ASSOC);
$stockArray[5]=$row['chg_p'];

$sql6 = "SELECT DISTINCT stamp FROM Daily$stock WHERE chg = '$close'";
$stamp1 = mysqli_query($con, $sql6);
$row = mysqli_fetch_array($stamp1, MYSQL_ASSOC);
$stockArray[6]=$row['stamp'];
$stamp = $stockArray[6];
$date = substr($stamp,0,10);
echo $date."<br>";

foreach ($stockArray as $value){
	echo $value."<br>";
}
//	if (mysqli_query($con, $sql) ) {
//		echo "Values have been inserted successfully in $stock"."<br>";
//	}
//	else {
//		echo "Error in inserting details in  $stock";
//	}
}
mysqli_close($con) ;
//echo "Connection to server closed successfully\r\n";
?>
