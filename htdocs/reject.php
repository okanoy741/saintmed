<?php
	session_start();

	try {
		$item7 = $_POST['item7'];
		include "connect.php";
			
		$query2 = "SELECT statusReq FROM projects WHERE ID = ".$_GET['ID']."";
		$stmt2 = $conn->query( $query2 );
		$row = $stmt2->fetch(PDO::FETCH_ASSOC);
		if ($row["statusReq"] == 10) {
		//Fail
			$message = "ขออภัย เนื่องจากมีการทำ Reject เอกสารแล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			session_destroy();
		
		$stmt2 = null;
		$conn = null;	
		
			header("Refresh:1; url= http://saintmed.dyndns.biz/sales/tender_list_am.asp?");
		}
		
		elseif ($row["statusReq"] == 13) {
		//Fail
			$message = "ขออภัย เนื่องจากมีการทำ Reject เอกสารแล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			session_destroy();
		
		$stmt2 = null;
		$conn = null;	
		
			header("Refresh:1; url= http://saintmed.dyndns.biz/sales/tender_list_am.asp?");
		}
		
		else{	
			$query = "UPDATE projects SET statusReq = 13, info = '$item7' WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );

			$query2 = "UPDATE req SET appove = ' ' WHERE project_id_fk = ".$_GET['ID']." ";
			$stmt2 = $conn->query( $query2 );

			
			$message = "ดำเนินการ Reject ข้อมูลกลับไปยังผู้รับผิดชอบเรียบร้อยแล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			
		$stmt = null;
		$stmt2 = null;
		$conn = null;
			
			header("Refresh:1; url= noti_rej.php?ID". $_GET['ID']."&PID=". $_GET['PID']);
		}
	}

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>