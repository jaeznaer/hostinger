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
	fetchData($con, $stock);
}
function fetchData($con, $stock){
$stockArray = Array();

$sql = "SELECT stamp FROM Daily$stock
ORDER BY id DESC
LIMIT 1";
$todayStamp = mysqli_query($con, $sql);
$row = mysqli_fetch_array($todayStamp, MYSQL_ASSOC);
$currentStamp=$row['stamp'];
$date = substr($currentStamp,0,10);
echo $date."<br>";

$sql0 = "SELECT ltp FROM Daily$stock
WHERE stamp LIKE '$date%'
ORDER BY id ASC
LIMIT 1";
$open = mysqli_query($con, $sql0);
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
	
$sql2 = "SELECT MAX(ltp) AS highPrice FROM Daily$stock WHERE stamp LIKE '$date%'";
$high = mysqli_query($con, $sql2);
//echo $high."<br>";
//Object of class mysqli_result could not be converted to string
//echo $high->fetch_object()->ltp;
$row = mysqli_fetch_array($high, MYSQL_ASSOC);
$stockArray[2]=round($row['highPrice'],3);
	echo $stockArray[2]."<br>";
	
$sql3 = "SELECT MIN(ltp) AS lowPrice FROM Daily$stock WHERE stamp LIKE '$date%'";
$low = mysqli_query($con, $sql3);
//echo $low."<br>";
$row = mysqli_fetch_array($low, MYSQL_ASSOC);
$stockArray[3]=round($row['lowPrice'],3);
	echo $stockArray[3]."<br>";
	
$closePrice = round($stockArray[1],3);
	
$sql4 = "SELECT DISTINCT chg FROM Daily$stock WHERE ROUND(ltp,3) = '$closePrice'";
$close_chg = mysqli_query($con, $sql4);
$row = mysqli_fetch_array($close_chg, MYSQL_ASSOC);
$stockArray[4]=$row['chg'];
	echo $stockArray[4]."<br>";
	
$sql5 = "SELECT DISTINCT chg_p FROM Daily$stock WHERE ROUND(ltp,3) = '$closePrice'";
$close_cp = mysqli_query($con, $sql5);
$row = mysqli_fetch_array($close_cp, MYSQL_ASSOC);
$stockArray[5]=$row['chg_p'];
	echo $stockArray[5]."<br>";
	
$sql6 = "SELECT DISTINCT stamp FROM Daily$stock WHERE ROUND(ltp,3) = '$closePrice'";
$stamp1 = mysqli_query($con, $sql6);
$row = mysqli_fetch_array($stamp1, MYSQL_ASSOC);
$stamp=$row['stamp'];
$stockArray[6] = substr($stamp,0,10);
	echo $stockArray[6]."<br>";
	
//foreach ($stockArray as $value){
//	echo $value."<br>";
//}
//	insData($con, $stock, $stockArray);
}
function setIncrement($con, $stock){
$sql = "SET @count = 0;";
$sql .= "UPDATE Daily$stock SET Daily$stock.id = @count:= @count + 1;";
$sql .= "ALTER TABLE Daily$stock AUTO_INCREMENT = 1";
	
// Execute multi query
mysqli_multi_query($con,$sql);
	
}
function insData($con, $stock, $stockArray){
$sql = 	"INSERT INTO $stock (open, close, high, low, close_chg, close_cp, stamp) VALUES ('$stockArray[0]','$stockArray[1]','$stockArray[2]','$stockArray[3]','$stockArray[4]','$stockArray[5]','$stockArray[6]')";
	if (mysqli_query($con, $sql) ) {
		echo "Values inserted successfully to $stock"."<br>";
	}
	else {
		echo "$stock details for $stockArray[6] already exists"."<br>";
	}
}
mysqli_close($con) ;
//echo "Connection to server closed successfully\r\n";
?>
