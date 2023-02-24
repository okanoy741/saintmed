<html>
<head>
<title>Saintmed</title>
</head>
<body>
<?php

	try {
		session_start();
		$item1 = $_POST['username'];

		include "connect.php";  // Using database connection file here
		
		$query = "SELECT username,code FROM users WHERE username =  '$item1' ";
		$stmt = $conn->query( $query );
		$row = $stmt->fetch(PDO::FETCH_ASSOC);	

		$query2 = "SELECT status FROM projects WHERE ID = ".$_GET['ID']."";
		$stmt2 = $conn->query( $query2 );
		$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
		if ($row2["status"] == 12) {
			$_SESSION["user"] = $row["username"];
			
	$stmt = null;
	$stmt2 = null;
	$conn = null;

			header("Refresh:1; url= viewAP_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
		}else{
			
			if (empty($row["username"])) {
			//Fail
				$message = "ไม่พบ User กรุณาลองใหม่";
				echo "<script type='text/javascript'>alert('$message');</script>";
				
	$stmt = null;
	$stmt2 = null;
	$conn = null;
				
				header("Refresh:1; url= appove.php");
			}
			elseif ($row["code"] != "A" && $row["code"] != "BM" && $row["code"] != "ADMN" && $row["code"] != "A2" && $row["code"] != "A3" && $row["username"] != "chalermluck" && $row["username"] != "montri" && $row["username"] != "san" && $row["username"] != "siriluck" && $row["username"] != "tanyaporn" && $row["username"] != "koragit" && $row["username"] != "preecha" && $row["username"] != "nisarat_t" && $row["username"] != "savinee" && $row["username"] != "AM3" && $row["username"] != "AM4" && $row["username"] != "AM5" && $row["username"] != "AM6" && $row["username"] != "AM7" && $row["username"] != "AM8" && $row["username"] != "AM9" && $row["username"] != "AM10") {
				# code...
				$message = "คุณไม่มีสิทธิ์ Appove";
				echo "<script type='text/javascript'>alert('$message');</script>";
				
	$stmt = null;
	$stmt2 = null;
	$conn = null;
				
				header("Refresh:1; url= http://saintmed.dyndns.biz/sales/tender_list_am.asp?");
			}
			
			else {
			$_SESSION["user"] = $row["username"];
			//Pass
				echo $_SESSION["user"];
	$stmt = null;
	$stmt2 = null;
	$conn = null;
				header("location: viewAP_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']." ");
			}
		}
	}
		

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>
</body>
</html>