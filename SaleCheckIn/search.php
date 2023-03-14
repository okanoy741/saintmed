<?php
session_start();
try {
	//require_once "../SaleCheckIn/conn.php";  // Using database connection file here
	include ("../FDA/encode.php");
	$enc1=$_POST['enc1'];
	$enc2=$_POST['enc2'];
	$enc3=$_POST['enc3'];
	$enc4=$_POST['enc4'];
	//$enc2 = iconv('UTF-8', 'TIS-620',$_POST['cl']);
	
	header("Refresh:0; url=../SaleCheckIn/indexAM.php?enc1=$enc1&enc2=$enc2");

	
}

catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}

?>