<?php
session_start();
try {
	require_once "../FDA/connect.php";  // Using database connection file here

	$item1 = $_POST['search'];
	//$item2 = iconv('UTF-8', 'TIS-620',$_POST['cl']);
	
	header("Refresh:0; url=../FDA/All_FDA.php?item=$item1 ");

	
}

catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}

?>