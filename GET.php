<?php
$con=mysqli_connect("example. com", "username", "password", "database name") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}
$username = $_GET[ ' username' ] ;
$password = $_GET[ ' password' ] ;
$result = mysqli_query($con, "SELECT Role FROM table1 where Username=' $username'
and Password=' $password' ") ;
$row = mysqli_fetch_array($result) ;
$data = $row[ 0] ;
if($data) {
echo $data;
}m
ysqli_close($con) ;
?>