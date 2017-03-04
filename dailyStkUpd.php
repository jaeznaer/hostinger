<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}
//echo "Connected to server successfully"."<br>";
$result = mysql_query($con, "SELECT nse_stock_name FROM NseStocks");
$stockArray = Array();
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $stocks[] =  $row['nse_stock_name'];  
}
//$sql = "INSERT INTO UserDetails (SrNo, FirstName, LastName, Email, Password, Date) VALUES (NULL, 'jaez', 'naer', 'jayesh94nair@rediffmail.com', 'qwerty', '1994-02-09')";
foreach ($stockArray as $stock){
	echo $stock."<br>".
}
mysqli_close($con) ;
echo "Connected to server closed successfully\r\n";
?>