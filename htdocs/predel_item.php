<html>
<head>
	<title>Saintmed</title>
</head>
<body>
	<?php
	session_start();
	try {
		include "connect.php";  // Using database connection file here

		$item0 = $_GET['ID'];

	
	if(!empty($item0) && empty($_POST['delete'])){
		$query = "DELETE FROM req_pre WHERE ID = ".$_GET['ID']." ";
		$stmt = $conn->query( $query );
		
		
		$stmt = null;
		$conn = null;

		header("Location: edit_prereq.php?ID=".$_GET['PPID']."&PID=".$_GET['PID']." ");
		}

	elseif(empty($_POST['delete'])){
		
		$stmt = null;
		$conn = null;
	header("Location: edit_prereq.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']);
		}
}

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
	?>
</body>
</html>