<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

$firstName= $_GET[ 'firstName' ] ;
$secondName= $_GET[ 'secondName' ] ;
$emailId= $_GET[ 'emailId' ] ;
$password= $_GET[ 'password' ] ;
$formattedDate= $_GET[ 'formattedDate' ] ;
	
//$query = <<<_E_
//INSERT INTO Users
//  (Avatar, Biography, Birth_Date, Email, Location, Password, Profile_Views, Real_Name, Reputation, Signup_Date, Username)
//  VALUES ('default', :bio, '0000-00-00', :email, 'default', :pass, 0, 'default', 0, :singup, :uname);
//_E_;
$query = <<<_E_
INSERT INTO UserDetails (SrNo, FirstName, LastName, Email, Password, Date) 
VALUES (NULL, :firstName, :secondName, :emailId, :password, :formattedDate);
_E_;
$params = array(
  'firstName'      => $firstName,
  'secondName' 	   => $secondName,
  'emailId'  	   => $emailId, 
  'password' 	   => $password,
  'formattedDate'  => $formattedDate,
);
//if( mysqli_query("....") !== false ) {
//    // ok
//} else {
//    // zonk
//}
// you also like checking return values, right?
// of course.
if( ! $stmt = $dbh->prepare($query) ) { die($dbh->errorInfo()); }
if( ! $stmt->execute($params) ) { die($stmt->errorInfo()); }
mysqli_close($con) ;
echo "Connected to server closed successfully\r\n";
?>