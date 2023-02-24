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
		
		$query = "SELECT username,code,sales_code FROM users WHERE username =  '$item1' ";
		$stmt = $conn->query( $query );
		$row = $stmt->fetch(PDO::FETCH_ASSOC);	

		$query2 = "SELECT status FROM projects WHERE ID = ".$_GET['ID']."";
		$stmt2 = $conn->query( $query2 );
		$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

		$query3 = "SELECT req.ID,projects.ID as pid,projects.project_code1,req.unitnum ,alloitm.ItemName,alloitm.itemCode, req.unitnum, req.price ,req.description,req.itemName as itemName1,alloitm.u_bm
		FROM ((req 
			INNER JOIN projects ON req.project_id_fk = projects.ID) 
		LEFT JOIN alloitm ON req.ItemCode = alloitm.ItemCode)
		WHERE req.project_id_fk = ".$_GET['ID']." AND req.unitnum IS NOT NULL  
		order by req.price DESC
		";
		$stmt3 = $conn->query( $query3 );


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
				
				header("Refresh:1; url= http://saintmed.dyndns.biz");
			}
			elseif ($row["code"] != "A" && $row["code"] != "BM" && $row["code"] != "ADMN" && $row["code"] != "A2" && $row["code"] != "A3" && $row["sales_code"] != "ACR" && $row["sales_code"] != "AR" && $row["sales_code"] != "CA" && $row["sales_code"] != "II" && $row["sales_code"] != "KMD" && $row["sales_code"] != "KND" && $row["sales_code"] != "KRL" && $row["sales_code"] != "NVJ" && $row["sales_code"] != "RR" && $row["sales_code"] != "SEY" && $row["sales_code"] != "SMARN" && $row["sales_code"] != "SMTWS" && $row["sales_code"] != "TF" && $row["sales_code"] != "TK" && $row["sales_code"] != "TP" && $row["sales_code"] != "TT" && $row["sales_code"] != "WS") {
				# code...
				$message = "คุณไม่มีสิทธิ์ Appove";
				echo "<script type='text/javascript'>alert('$message');</script>";
				
				$stmt = null;
				$stmt2 = null;
				$conn = null;
				
				header("Refresh:1; url= http://saintmed.dyndns.biz");
			}
			
			else {
				$_SESSION["user"] = $row["username"];
			//Pass
				echo $_SESSION["user"];
				$stmt = null;
				$stmt2 = null;
				$conn = null;
				header("location: viewBM_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']." ");
			}
		}
	}


	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
	?>
</body>
</html>