<?php
$con=mysqli_connect("mysql.hostinger.in", "u659193285_jaez", "1994jitu", "u659193285_cldet") ;
if (mysqli_connect_errno($con) ) {
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

//$userName= $_GET[ 'userName' ] ;
//$password= $_GET[ 'password' ] ;

echo "Changes occured in Hostinger".<br/>

$sql = "SELECT * FROM UserDetails";

$result = mysqli_query($con,$sql);

$num_rows = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result))
{
		$data[] = $row;
}
$data1 = $row[0];

if ($data1) {
	echo "yes".PHP_EOL;
	$data[$num_rows]="Record is not available";
	print(json_encode($data));
}
else {
	echo "no";
	$data[$num_rows]="Success".PHP_EOL;
	printf(json_encode($data));
}
mysqli_close($con) ;
?>		
//<?php
//$username =’root';
//$password =”;
//$hostname =’localhost';
//$database =’db_name';
//
//$localhost = mysql_connect($hostname,$username,$password) or trigger_error(mysql_error(),E_USER_ERROR);
//mysql_select_db($database,$localhost);
//$i=mysql_query(“select * from table_name”);
//
//$num_rows = mysql_num_rows($i);
//while($row = mysql_fetch_array($i))
//{
//
//$r[]=$row;
//$check=$row['Id'];
//}
//
//if($check==NULL)
//{
//$r[$num_rows]=”Record is not available”;
//print(json_encode($r));
//}
//else
//{
//$r[$num_rows]=”success”;
//print(json_encode($r));
//}
//
//mysql_close($localhost);
//?>
