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

$sql = "SELECT ltp FROM Daily$stock
ORDER BY column_name ASC
LIMIT 1";
$open = mysqli_query($con, $sql);
echo $open."<br>";

$sql1 = "SELECT ltp FROM Daily$stock
ORDER BY column_name DESC
LIMIT 1";
$close = mysqli_query($con, $sql1);
echo $close."<br>";

$sql2 = "SELECT MAX(ltp) FROM Daily$stock";
$high = mysqli_query($con, $sql2);
//echo $high."<br>";
//Object of class mysqli_result could not be converted to string
echo $high->fetch_object()->ltp;

$sql3 = "SELECT MIN(ltp) FROM Daily$stock";
$low = mysqli_query($con, $sql3);
//echo $low."<br>";
echo $low->fetch_object()->ltp;

$sql4 = "SELECT DISTINCT chg FROM Daily$stock WHERE chg = '$close'";
$close_chg = mysqli_query($con, $sql4);
echo $close_chg->fetch_object()->chg;

$sql5 = "SELECT DISTINCT chg_p FROM Daily$stock WHERE chg = '$close'";
$close_cp = mysqli_query($con, $sql5);
echo $close_cp->fetch_object()->chg_p;

$sql6 = "SELECT DISTINCT stamp FROM Daily$stock WHERE chg = '$close'";
$stamp1 = mysqli_query($con, $sql6);
$stamp = $stamp1->fetch_object()->stamp;
$date = substr($stamp,0,10);
echo $date."<br>";

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
