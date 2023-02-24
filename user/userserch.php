<?php
session_start();
try {
	require_once "../connect.php";  // Using database connection file here

	$item1 = iconv('UTF-8', 'TIS-620',$_POST['search']);
	
		header("Refresh:0; url=../user/user.php?uname=$item1 ");
}
	
catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}

?>