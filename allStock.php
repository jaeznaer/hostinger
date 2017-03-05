<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

$sql = "SELECT * FROM NseStocks";

$result = mysqli_query($con,$sql);

while ($row = mysqli_fetch_array($result))
{
		$data[] = $row;
}

print(json_encode($data, JSON_FORCE_OBJECT));

mysqli_close($con) ;
?>		
