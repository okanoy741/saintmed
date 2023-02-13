<?php 
session_start();
try {
	include "connect.php";  // Using database connection file here

	$itemset = substr($_POST['itemset1'],0,3);
	
	if(!empty($itemset)){
		$query = "SELECT groupcodeitem.groupcode_id_fk 
		FROM groupcodeitem 
		left join groupcode on  groupcodeitem.groupcode_id_fk = groupcode.id
		where groupcodeitem.groupcode_id_fk = $itemset
		GROUP BY groupcodeitem.groupcode_id_fk ";
		$stmt = $conn2->query( $query );
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo $row['groupcode_id_fk'];
			if(!empty($row['groupcode_id_fk'])){
				$stmt = null;
				$conn2 = null;
				header("Location: viewAP_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']."&ITEM=". $row['groupcode_id_fk']."&");
			}
			else if($row['groupcode_id_fk' == '']){
				$stmt = null;
				$conn2 = null;
				header("Location: viewAP_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']."&");
			}
		}
	}
	else if(empty($itemset)){
		$stmt = null;
		$conn2 = null;
		header("Location: viewAP_req.php?ID=". $_GET['ID']."&PID=". $_GET['PID']."&");
	}
}

catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}
?>
