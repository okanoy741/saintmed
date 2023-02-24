<html>
<head>
<title>Saintmed</title>
</head>
<body>
<?php
		
	try {
		include "connect.php";  // Using database connection file here

		$in1 = $_POST['in1'];
		$in2 = $_POST['in2'];
		$in3 = $_POST['in3'];
		$in5 = $_POST['in5'];
		$in6 = $_POST['in6'];
		$in7 = $_POST['in7'];
		$in8 = $_POST['in8'];
		$in9 = $_POST['in9'];
		$in10 = $_POST['in10'];
		$in11 = $_POST['in11'];
		$in12 = $_POST['in12'];
		$in13 = $_POST['in13'];
		$in14 = $_POST['in14'];
		$in15 = $_POST['in15'];
		$in16 = $_POST['in16'];
		$in17 = $_POST['in17'];
		$in18 = $_POST['in18'];

		
		$query = "UPDATE projects 
					SET tender_date 	= '$in1', 
						qt_date 		= '$in2', 
						sign_date 		= '$in3',
						announ_code 	= '$in5', 
						tender_code 	= '$in6', 
						pcode 			= '$in7', 
						budget 			= '$in8', 
						project_desc 	= '$in9', 
						unitnum 		= '$in10', 
						unitprice 		= '$in11', 
						pro_value 		= '$in12', 
						delidate 		= '$in13', 
						delitime 		= '$in14', 
						waran 			= '$in15', 
						onsite_within 	= '$in16', 
						employee_id_fk 	= '$in17', 
						info 			= '$in18' 
					WHERE ID = ".$_GET['ID']." "
				;
		$stmt = $conn->query( $query );

		$$stmt = null;
		$conn = null;

		header("Location: edit_req.php");
	}

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>
</body>
</html>