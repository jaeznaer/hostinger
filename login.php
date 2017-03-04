<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

$userName= $_GET[ 'userName' ] ;
$password= $_GET[ 'password' ] ;

$sql = "SELECT SrNo FROM UserDetails WHERE Email='$userName' AND Password='$password'";

$result = mysqli_query($con,$sql1);
$row = mysqli_fetch_array($result);
$data = $row[0];

if ($data) {
	echo "yes";
}
else {
	echo "no";
}
mysqli_close($con) ;
?>		