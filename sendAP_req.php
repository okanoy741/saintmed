<?php
try {
	session_start();
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

			header("Refresh:0; url= view_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
		}elseif ($row["statusReq"] == 12) {
		//Fail
			$message = "ขออภัย เนื่องจากมีการส่งเอกสารรับการ Appove แล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			session_destroy();
			
			$stmt2 = null;
			$conn = null;

			header("Refresh:0; url= view_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
		}
		else{
			$query = "UPDATE projects SET statusReq = 11 WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );
			
			$message = "ดำเนินการส่งเอกสารร้องขอรับการ Appove เรียบร้อยแล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			
			$stmt = null;
			$stmt2 = null;
			$conn = null;
			
			header("Refresh:0; url= notify_line.php?ID=". $_GET['ID']."&PID=". $_GET['PID']."&MA=". $_GET['MA']);
		}
	}

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>