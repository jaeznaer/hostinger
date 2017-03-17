

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
	alterTable($con, $stock);
}

function alterTable($con, $stock){
	//ALTER TABLE Person MODIFY P_Id INT(11) NOT NULL;
$stockArray = Array();
	
//$sql = "ALTER TABLE Daily$stock MODIFY ltp float NOT NULL";
//$sql = "ALTER TABLE $stock MODIFY open float NOT NULL";
//$sql = "INSERT INTO $stock VALUES (NULL)";
//$sql = "DELETE FROM $stock WHERE open = 0";
$sql = "DELETE FROM Daily$stock WHERE ltp = 0";

//if(mysqli_multi_query($con, $sql)){
if(mysqli_query($con, $sql)){
	echo "Tables altered for Daily$stock <br>";
}else{
	echo "$stock error running query <br>";
}
}
mysqli_close($con) ;
//echo "Connection to server closed successfully\r\n";
?>
