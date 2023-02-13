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
		$query2 = "SELECT statusReq FROM projects WHERE ID = ".$_GET['ID']."";
		$stmt2 = $conn->query( $query2 );
		$row = $stmt2->fetch(PDO::FETCH_ASSOC);
		if ($row["statusReq"] == 11) {
		//Fail
			$message = "ขออภัย เนื่องจากมีการส่งเอกสารขอรับการ Appove แล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			session_destroy();
			
	$stmt2 = null;
	$conn = null;

			header("Refresh:1; url= view_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
		}elseif ($row["statusReq"] == 12) {
		//Fail
			$message = "ขออภัย เนื่องจากมีการส่งเอกสารรับการ Appove แล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			session_destroy();
			
	$stmt2 = null;
	$conn = null;

			header("Refresh:1; url= view_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
		}else{
			$query = "SELECT username FROM users WHERE username =  '$item1' ";
			$stmt = $conn->query( $query );
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if (empty($row["username"])) {
			//Fail
				$message = "ไม่พบ User กรุณาลองใหม่";
				echo "<script type='text/javascript'>alert('$message');</script>";
				
	$stmt = null;
	$conn = null;
				header("Refresh:1; url= chk.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
			} else {
			$_SESSION["user"] = $row["username"];
			//Pass
				echo $_SESSION["user"];
	$stmt = null;
	$conn = null;
				header("location: edit_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
			}
		}
	}
		

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>
</body>
</html>