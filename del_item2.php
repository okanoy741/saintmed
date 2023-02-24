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

		
		$query = "DELETE FROM req WHERE ID = ".$_GET['ID']." ";
		$stmt = $conn->query( $query );
		
		$query2 = "INSERT INTO edit_log (project_id_fk,edit_log,date1) VALUES (".$_GET['PPID'].", 'ลบสินค้าโดย ".$_SESSION["user"]."',date())";
		$stmt2 = $conn->query( $query2 );
		
		$stmt = null;
		$stmt2 = null;
		$conn = null;

		header("Location: viewAP_req.php?ID=".$_GET['PPID']."&PID=".$_GET['PID']." ");
	}

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
	?>
</body>
</html>