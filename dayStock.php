<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

//jaeznet.pe.hu/dayStock.php?nse-stock=NIFTY

$nse_stock = strtoupper($_GET[ 'nse-stock' ] ); 

$sql = "SELECT open, high, low, close, close_chg, close_cp, stamp FROM $nse_stock";

$result = mysqli_query($con,$sql);

while ($row = mysqli_fetch_array($result)) 
{
		$data[] = $row;
}

print(json_encode($data));

mysqli_close($con) ;
?>		
