<?php
	session_start();

	try {
		include "../connect.php";
		$inpro = $_POST['proID'];
			
		$query2 = "SELECT ap_status FROM projects_pre WHERE ID = ".$_GET['ID']."";
		$stmt2 = $conn->query( $query2 );
		$row = $stmt2->fetch(PDO::FETCH_ASSOC);
		
		if ($row["ap_status"] == 16) {
		//Fail
			$message = "ขออภัย เนื่องจากมีการ Update แล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			session_destroy();
		
		$stmt2 = null;
		$conn = null;	
		
			header("Refresh:1; url= ../sale_admin/chk_projects.php?");
		}
		elseif ($row["ap_status"] == 13) {
		//Fail
			$message = "ขออภัย เนื่องจากมีการ Update แล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			session_destroy();
		
		$stmt2 = null;
		$conn = null;	
		
			header("Refresh:1; url= ../sale_admin/chk_projects.php?");
		}
		
		elseif ($row["ap_status"] == 15){	
			$query3 = "UPDATE projects SET funnel_id = '".$_GET['PID']."' WHERE project_code1 = '$inpro' ";
			$stmt3 = $conn->query( $query3 );
			
			
			$query = "UPDATE projects_pre SET ap_status = 13 WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );

			
			$message = "ดำเนินการ Update ข้อมูลเรียบร้อยแล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			
		$stmt = null;
		$stmt2 = null;
		$stmt3 = null;
		$conn = null;
			
			header("Refresh:1; url= ../sale_admin/chk_projects.php?");
		}
	}

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>