<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}
echo "Connected to server successfully"."<br>";
$username = $_GET[ ' username' ] ;
$password = $_GET[ ' password' ] ;

//$username = $_GET[ ' username' ] ;
//$password = $_GET[ ' password' ] ;
//$sql="INSERT INTO table1 (FirstName, LastName, Age) VALUES (' admin' , ' admin' , ' adminstrator' ) "
//$sql = "INSERT INTO `u659193285_cldet`.`UserDetails (`SrNo`, `FirstName`, `LastName`, `Email`, `Password`, `Date`) VALUES (NULL, \'jaez\', \'naer\', \'jayesh94nair@rediffmail.com\', \'qwerty\', \'1994-02-09\');";

$sql = "INSERT INTO UserDetails (SrNo, FirstName, LastName, Email, Password, Date) VALUES (NULL, 'jaez', 'naer', 'jayesh94nair@rediffmail.com', 'qwerty', '1994-02-09')";

if (mysqli_query($con, $sql) ) {
echo "Values have been inserted successfully"."<br>";
}
mysqli_close($con) ;
echo "Connected to server closed successfully\r\n";
?>