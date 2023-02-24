<?php
try {
	session_start();
		require_once "connect.php";  // Using database connection file here
		$user =  $_SESSION["user"];
		
		$query2 = "SELECT statusReq, employee_id_fk FROM projects WHERE ID = ".$_GET['ID']."";
		$stmt2 = $conn->query( $query2 );
		$row = $stmt2->fetch(PDO::FETCH_ASSOC);
		$employeeid = $row["employee_id_fk"];

		$query3 = "SELECT ID, manager_id_fk, uid FROM employee2 WHERE ID = $employeeid";
		$stmt3 = $conn->query( $query3 );
		$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
		$MA = $row3["manager_id_fk"];

		$query6 = "SELECT username, sales_code FROM users WHERE username = '$user'";
		$stmt6 = $conn->query( $query6 );
		$row6 = $stmt6->fetch(PDO::FETCH_ASSOC);
		$stname = $row6["sales_code"];

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
$query5 = "SELECT count_bm_appove FROM projects WHERE ID = ".$_GET['ID']." ";
			$stmt5 = $conn->query( $query5 );
			$row5 = $stmt5->fetch(PDO::FETCH_ASSOC);
			$sumBM = $row5['count_bm_appove'];

			$query = "UPDATE projects SET count_bm_appove = $sumBM+1 WHERE ID = ".$_GET['ID']." ";
			$stmt = $conn->query( $query );

			$query2 = "INSERT INTO edit_log (project_id_fk,edit_log,BM,date1) VALUES (".$_GET['ID'].", 'BM appove by ".$_SESSION["user"]."' ,'$stname' ,date())   ";
			$stmt2 = $conn->query( $query2 );
			
			$message = "ดำเนินการ Appove เอกสารเรียบร้อยแล้ว";
			echo "<script type='text/javascript'>alert('$message');</script>";
			
			$stmt = null;
			$stmt2 = null;
			$conn = null;
			
			header("Refresh:0; url= viewBMappoved.php?ID=". $_GET['ID']."&PID=". $_GET['PID']."");
			exit;
		}
		else{

		}
		
	}

	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>