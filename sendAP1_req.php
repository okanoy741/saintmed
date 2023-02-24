<?php
try {
	session_start();
		include "connect.php";  // Using database connection file here
		$user =  $_SESSION["user"];
		
		$query2 = "SELECT statusReq, employee_id_fk FROM projects WHERE ID = ".$_GET['ID']."";
		$stmt2 = $conn->query( $query2 );
		$row = $stmt2->fetch(PDO::FETCH_ASSOC);
		$employeeid = $row["employee_id_fk"];

		$query3 = "SELECT ID, manager_id_fk, uid FROM employee2 WHERE ID = $employeeid";
		$stmt3 = $conn->query( $query3 );
		$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
		$MA = $row3["manager_id_fk"];

		$query4 = "SELECT count(alloitm.u_bm) AS BM
		FROM (req LEFT JOIN alloitm ON req.ItemCode = alloitm.ItemCode)
		WHERE req.project_id_fk = ".$_GET['ID']." 
		";
		$stmt4 = $conn->query( $query4 );
		$row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
		$BMC = $row4["BM"];

		if ($row["statusReq"] == 10) {
		//Fail
			$message = "ไม่สามารถดำเนินการได้เนื่องจากยังดำเนินการ req ไม่สมบูรณ์";
			echo "<script type='text/javascript'>alert('$message');</script>";
			session_destroy();
			
			$stmt2 = null;
			$conn = null;

			header("Refresh:0; url= http://saintmed.dyndns.biz/sales/tender_list_am.asp?");
		}
		elseif ($row["statusReq"] == 13) {
		//Fail
			$message = "ไม่สามารถดำเนินการได้เนื่องจากยังดำเนินการ req ไม่สมบูรณ์";
			echo "<script type='text/javascript'>alert('$message');</script>";
			session_destroy();
			
			$stmt2 = null;
			$conn = null;

			header("Refresh:0; url= http://saintmed.dyndns.biz/sales/tender_list_am.asp?");
		}
		elseif ($row["statusReq"] == 12) {
			$message = "ขออภัย เนื่องจากมีการส่งเอกสารรับการ Appove แล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			session_destroy();
			
			$stmt2 = null;
			$conn = null;

			header("Refresh:0; url= http://saintmed.dyndns.biz/sales/tender_list_am.asp?");
		}
		else{	
			$query = "UPDATE projects SET statusReq = 12, bm_appove = $BMC WHERE ID = ".$_GET['ID']." ";
			$stmt = $conn->query( $query );

			$query2 = "UPDATE req SET appove = '$user' WHERE project_id_fk = ".$_GET['ID']." ";
			$stmt2 = $conn->query( $query2 );
			
			$message = "ดำเนินการ Appove เอกสารเรียบร้อยแล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			
			$stmt = null;
			$stmt2 = null;
			$conn = null;
			
			header("Refresh:0; url= noti_AP.php?ID=". $_GET['ID']."&PID=". $_GET['PID']."&MA=". $row3["manager_id_fk"]);
		}
	}

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>