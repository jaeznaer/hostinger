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
	setIncrement($con, $stock);
	fetchData($con, $stock);
	deleteData($con, $stock);
}

function fetchData($con, $stock){
$stockArray = Array();
	
$sql = "SELECT ltp FROM Daily$stock
ORDER BY id ASC
LIMIT 1";
$open = mysqli_query($con, $sql);
$row = mysqli_fetch_array($open, MYSQL_ASSOC);
$stockArray[0]=$row['ltp'];
//echo $stockArray[0]."<br>";

$sql1 = "SELECT ltp FROM Daily$stock
ORDER BY id DESC
LIMIT 1";
$close = mysqli_query($con, $sql1);
$row = mysqli_fetch_array($close, MYSQL_ASSOC);
$stockArray[1]=$row['ltp'];
//	echo $stockArray[1]."<br>";

$sql2 = "SELECT MAX(ltp) AS highPrice FROM Daily$stock";
$high = mysqli_query($con, $sql2);
//echo $high."<br>";
//Object of class mysqli_result could not be converted to string
//echo $high->fetch_object()->ltp;
$row = mysqli_fetch_array($high, MYSQL_ASSOC);
$stockArray[2]=$row['highPrice'];
//	echo $stockArray[2]."<br>";

$sql3 = "SELECT MIN(ltp) AS lowPrice FROM Daily$stock";
$low = mysqli_query($con, $sql3);
//echo $low."<br>";
$row = mysqli_fetch_array($low, MYSQL_ASSOC);
$stockArray[3]=$row['lowPrice'];
//	echo $stockArray[3]."<br>";

$closePrice = round($stockArray[1],3);
	
$sql4 = "SELECT DISTINCT chg FROM Daily$stock WHERE ROUND(ltp,3) = '$closePrice'";
$close_chg = mysqli_query($con, $sql4);
$row = mysqli_fetch_array($close_chg, MYSQL_ASSOC);
$stockArray[4]=$row['chg'];
//	echo $stockArray[4]."<br>";

$sql5 = "SELECT DISTINCT chg_p FROM Daily$stock WHERE ROUND(ltp,3) = '$closePrice'";
$close_cp = mysqli_query($con, $sql5);
$row = mysqli_fetch_array($close_cp, MYSQL_ASSOC);
$stockArray[5]=$row['chg_p'];
//	echo $stockArray[5]."<br>";

$sql6 = "SELECT DISTINCT stamp FROM Daily$stock WHERE ROUND(ltp,3) = '$closePrice'";
$stamp1 = mysqli_query($con, $sql6);
$row = mysqli_fetch_array($stamp1, MYSQL_ASSOC);
$stamp=$row['stamp'];
$stockArray[6] = substr($stamp,0,10);
//	echo $stockArray[6]."<br>";
	
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

function setIncrement($con, $stock){

$sql = "SET @count = 0;";
$sql .= "UPDATE Daily$stock SET Daily$stock.id = @count:= @count + 1;";
$sql .= "ALTER TABLE Daily$stock AUTO_INCREMENT = 1";
	
	if (mysqli_multi_query($con, $sql) ) {
		do
		{
			// Store first result set
			if ($result=mysqli_store_result($con)){
			// Free result set	    
			mysqli_free_result($result);
			}
		}
		while (mysqli_next_result($con));
			//echo "Values have been inserted successfully in $stock"."<br>";
	}
	else {
		echo "Error in setting the increment";
	}
}
mysqli_close($con) ;
//echo "Connection to server closed successfully\r\n";
?>
