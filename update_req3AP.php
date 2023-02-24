
<?php
session_start();
try {
	include "connect.php";  // Using database connection file here
	$item0 = $_GET['ID'];
	$item4 = iconv('UTF-8', 'TIS-620',$_POST['item4']);
	$item5 = $_POST['item5'];
	$item6 = $_POST['item6'];

	if(!empty($item4) && !empty($item5) && !empty($item6)){
	$query = "UPDATE req SET itemname = '$item4', unitnum = $item5, price = '$item6' WHERE ID = ".$_GET['ID']."";
	$stmt = $conn->query( $query );

	$query2 = "INSERT INTO edit_log (project_id_fk,edit_log,date1) VALUES (".$_GET['PPID'].", 'แก้ไขข้อมูลโดย ".$_SESSION["user"]."',date())";
	$stmt2 = $conn->query( $query2 );
	
	$stmt = null;
	$stmt2 = null;
	$conn = null;

	header("Location: viewAP_req.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']);
	}
	elseif(!empty($item4) && !empty($item5) && empty($item6)){
	$query = "UPDATE req SET itemname = '$item4', unitnum = $item5, price = 0 WHERE ID = ".$_GET['ID']."";
	$stmt = $conn->query( $query );

	$query2 = "INSERT INTO edit_log (project_id_fk,edit_log,date1) VALUES (".$_GET['PPID'].", 'แก้ไขข้อมูลโดย ".$_SESSION["user"]."',date())";
	$stmt2 = $conn->query( $query2 );
	
	$stmt = null;
	$stmt2 = null;
	$conn = null;

	header("Location: viewAP_req.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']);
	}
}
catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}
?>