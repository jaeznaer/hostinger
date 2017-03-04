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
//$sql = "INSERT INTO UserDetails (SrNo, FirstName, LastName, Email, Password, Date) VALUES (NULL, 'jaez', 'naer', 'jayesh94nair@rediffmail.com', 'qwerty', '1994-02-09')";
foreach ($stockArray as $stock){
	addStockDetails($stock);
}
function addStockDetails($stock){
	$json = file_get_contents("http://finance.google.com/finance/info?client=ig&q=NSE:$stock",NULL,NULL,4);
	//print_r($jdata);
	$data = json_decode($json,true);
	var_dump($data);
}
mysqli_close($con) ;
//echo "Connection to server closed successfully\r\n";
?>
