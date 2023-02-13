<?php
session_start();

try {
	require_once "../connect.php";  // Using database connection file here

	$item0 = $_GET['PID'];
	$item1 = $_GET['STA'];
	$item2 = iconv('UTF-8','TIS-620', $_GET['CL']);
	$item3 = $_GET['UP'];
	$item4 = $_GET['UN'];
	$item5 = $_GET['PV'];
	$item6 = iconv('UTF-8','TIS-620', $_GET['PD']);
	$item7 = $_GET['EMP'];

	/*$sql7 = "SELECT MAX(ID) AS last_id FROM projects_pre";
	$query7 = $conn->query($sql7); 
	while($row7 = $query7->fetch(PDO::FETCH_ASSOC)){
		{
			$maxId = substr("000000".$row7['last_id'] + 1, -6);
			$nextId = $maxId;

		}
	}*/

	$item8 = "PRE".$_GET['ID'];


	$query = "SELECT ap_status,funnel_id FROM projects_pre WHERE ID = ".$_GET['ID']."";
	$stmt = $conn->query( $query );

	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($row["ap_status"] == 16) {

		$message = "รายการนี้มีเลขรหัสโครงการแล้ว ";
		echo "<script type='text/javascript'>alert('$message');</script>";

		$stmt = null;
		$conn = null;	

		header("Refresh:1; url= ../sale_admin/chk_projects.php?");

	}
	elseif(empty($row["ap_status"]) || $row["ap_status"] == 0) {
		//Fail

		$query2 = "INSERT INTO projects (funnel_id, statusReq, project_desc, cl, unitprice, unitnum, pro_value,employee_id_fk,status)  
		VALUES ( '$item0','16','$item6','$item2', $item3, $item4, $item5,$item7,0) ";
		$stmt2 = $conn->query( $query2 );

		$query4 = "UPDATE projects_pre SET ap_status = 16 WHERE ID = ".$_GET['ID']."";
		$stmt4 = $conn->query( $query4 );

		$query3 = "SELECT * FROM projects WHERE funnel_id = '".$row['funnel_id']."' ";
		$stmt3 = $conn->query( $query3 );
		$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

		$stmt = null;
		$stmt2 = null;
		$stmt3 = null;
		$stmt4 = null;
		$stmt5 = null;
		$stmt6 = null;
		$conn = null;	

		header("Refresh:1; url= http://saintmed.dyndns.biz/tenders/tender2.asp?eid=". $row3['ID'] ." ");

	}

	elseif(empty($item0) ) {

		$query2 = "INSERT INTO projects ( req_id,statusReq, project_desc, cl, unitprice, unitnum, employee_id_fk,status)  
		VALUES ( '$item8','16','$item6','$item2', $item3, $item4, $item7,0) ";
		$stmt2 = $conn->query( $query2 );

		$query4 = "UPDATE projects_pre SET ap_status = 16 WHERE ID = ".$_GET['ID']."";
		$stmt4 = $conn->query( $query4 );

		$query3 = "SELECT * FROM projects WHERE req_id = '$item8' ";
		$stmt3 = $conn->query( $query3 );
		$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

		/*echo $item8;*/

		$stmt = null;
		$stmt2 = null;
		$stmt3 = null;
		$stmt4 = null;
		$stmt5 = null;
		$stmt6 = null;
		$conn = null;	

		header("Refresh:1; url= http://saintmed.dyndns.biz/tenders/tender2.asp?eid=". $row3['ID'] ." ");

	}

	else {
		//Fail

		$query2 = "INSERT INTO projects (funnel_id, statusReq, project_desc, cl, unitprice, unitnum, pro_value,employee_id_fk,status)  
		VALUES ( '$item0','10','$item6','$item2', $item3, $item4, $item5,$item7,0) ";
		$stmt2 = $conn->query( $query2 );

		$query4 = "UPDATE projects_pre SET ap_status = 16 WHERE ID = ".$_GET['ID']."";
		$stmt4 = $conn->query( $query4 );

		$query3 = "SELECT * FROM projects WHERE funnel_id = '".$row['funnel_id']."' ";
		$stmt3 = $conn->query( $query3 );
		$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

		$stmt = null;
		$stmt2 = null;
		$stmt3 = null;
		$stmt4 = null;
		$stmt5 = null;
		$stmt6 = null;
		$conn = null;	

		header("Refresh:1; url= http://saintmed.dyndns.biz/tenders/tender2.asp?eid=". $row3['ID'] ." ");

	}

}

catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}
?>