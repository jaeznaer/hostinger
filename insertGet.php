<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

//echo "Connected to server successfully\r\n"."<br>";

$firstName= $_GET[ 'firstName' ] ;
$secondName= $_GET[ 'secondName' ] ;
$emailId= $_GET[ 'emailId' ] ;
$password= $_GET[ 'password' ] ;
$formattedDate= $_GET[ 'formattedDate' ] ;

$sql1 = "SELECT SrNo FROM UserDetails WHERE Email='$emailId'";
$sql = "INSERT INTO UserDetails (SrNo, FirstName, LastName, Email, Password, Date) VALUES (NULL, '$firstName', '$secondName', '$emailId', '$password', '$formattedDate')";

$result = mysqli_query($con,$sql1);
$row = mysqli_fetch_array($result);
$data = $row[0];

if ($data) {
	echo "yes";
}
else {
	if (mysqli_query($con, $sql) ) {
	//echo "Values have been inserted successfully\r\n"."<br>";
	}
}
mysqli_close($con) ;
//echo "Connected to server closed successfully\r\n";
?>		