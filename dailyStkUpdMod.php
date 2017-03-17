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
	addStockDetails($con, $stock);
}
function addStockDetails($con, $stock){
	$url = "http://finance.google.com/finance/info?client=ig&q=NSE:$stock";
	$json = file_get_contents("http://finance.google.com/finance/info?client=ig&q=NSE:$stock",NULL,NULL,4);
	$curl_handle=curl_init();
	curl_setopt($curl_handle, CURLOPT_URL,'http://###.##.##.##/mp/get?mpsrc=http://mybucket.s3.amazonaws.com/11111.mpg&mpaction=convert format=flv');
	curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
	$query = curl_exec($curl_handle);
	curl_close($curl_handle);
	//print_r($jdata);
	$data = json_decode($json,true);
	//var_dump($data);
	$datetime = $data[0]['lt_dts'];
	//2017-03-03T15:53:27Z
	$ltp = $data[0]['l_fix'];
	$chg = $data[0]['c_fix'];
	$chg_p = $data[0]['cp_fix'];
	$p_close = $data[0]['pcls_fix'];
	$sql = "INSERT INTO Daily$stock (ltp, chg, chg_p, p_close, stamp) VALUES ('$ltp', '$chg', '$chg_p', '$p_close', '$datetime')";
	
	if ($ltp <> 0)
	{
		if (mysqli_query($con, $sql) ) {
			echo "Values have been inserted successfully in Daily$stock"."<br>";
		}
		else {
			echo "Error in inserting details in  Daily$stock";
		}
	}
	else{
		echo "Daily$stock ltp = 0 table not updated";
	}
}
mysqli_close($con) ;
//echo "Connection to server closed successfully\r\n";
?>
