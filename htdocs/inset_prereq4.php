<?php
include "head.php";
?>
<?php
session_start();
try {
	include "connect.php";  // Using database connection file here

	$item0 = $_GET['ID'];
	$itemset = $_GET['ITEM'];
	$num = $_GET['NUM'];
	
	if(!empty($itemset)){
		$query3 = "SELECT groupcodeitem.groupcode_id_fk, groupcodeitem.itemcode,groupcode.groupname FROM groupcodeitem 
		left join groupcode on  groupcodeitem.groupcode_id_fk = groupcode.id
		where groupcodeitem.groupcode_id_fk = $itemset ";
		$stmt3 = $conn2->query( $query3 );
		while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)){
			$query4 = "INSERT INTO req_pre (project_id_fk, ItemCode, unitnum, price) 
			VALUES ('$item0', '$row[itemcode]', '$num', '0') ";
			$stmt4 = $conn->query( $query4 );
		}
		$stmt3 = null;
		$stmt4 = null;

		$conn = null;

		header("Location: edit_prereq.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
	}

	else{
		$conn = null;
		
		header("Location: edit_prereq.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
	}
	
	
}
	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}

?>
</body>
</html>