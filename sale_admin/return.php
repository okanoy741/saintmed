<?php
	session_start();

	try {
		include "../connect.php";
		
		$query = "SELECT ap_status,funnel_id FROM projects_pre WHERE ID = ".$_GET['ID']."";
		$stmt = $conn->query( $query );
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row["ap_status"] == 13) {
		//True
		$query4 = "UPDATE projects_pre SET ap_status = 14 WHERE ID = ".$_GET['ID']."";
		$stmt4 = $conn->query( $query4 );
			
		
		$stmt = null;
		$stmt4 = null;
		$conn = null;	
		
			$message = "รายการนี้ส่งกลับไปในรายการขอเลขรหัสโครงการ ";
			echo "<script type='text/javascript'>alert('$message');</script>";
		
			header("Refresh:1; url= ../sale_admin/chk_projects.php?");

		}

		elseif ($row["ap_status"] == 15 || $row["ap_status"] == 16) {
		//Fail
		
			$message = "สถานะของรายการไม่ถูกต้อง";
			echo "<script type='text/javascript'>alert('$message');</script>";
		
			header("Refresh:1; url= ../sale_admin/chk_projects.php?");

		}
		
			
		}
		

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>