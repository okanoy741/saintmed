<html>
<head>
	<title>Saintmed</title>
</head>
<body>
	<?php
	
	try {
		include "connect.php";  // Using database connection file here
		$hospital = $_POST['client_id_fk'];
		$info = $_POST['info'];
		$employee_id_fk = $_POST['employee_id_fk'];
		$pro_code_a = "P".date('ymi');
		$date = date('Y-m-d H:i:s');

		$query = "INSERT INTO projects (project_code1, client_id_fk, info, employee_id_fk, statusReq, tender_date) VALUES ('$pro_code_a', '$hospital', '$info', '$employee_id_fk','3', '$date')"
		;
		$stmt = $conn->query( $query );
		
		$last_id = $conn->lastInsertId();
		$query2 = "INSERT INTO req (project_id_fk) VALUES ('$last_id')"				;
		$stmt2 = $conn->query( $query2 );

		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: req.php");
	}

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
	?>
</body>
</html>
