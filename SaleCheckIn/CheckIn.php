<?php
include "../SaleCheckIn/head.php";
session_start();

require_once "../SaleCheckIn/conn.php";
date_default_timezone_set("Asia/Bangkok");
$chk_time = date("h:i:sa");
$chk_date = date("Y/m/d");

$item1 = $_POST['item1'];
$item0 = iconv('UTF-8', 'TIS-620',$_POST['item1']);
$item2 = $_POST['item2'];
$item3 = $_POST['item3'];
$item6 = $_POST['item6'];
$item4 = $chk_date." ".$chk_time;
$item5 = $_SESSION['USERNAME'];

$query = "SELECT * FROM all_hospital WHERE AR_NAME = '$item0' " ;
$stmt = $conn2->query( $query );
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$h_id = $row['ID'];
echo $h_id;
if ($h_id = " ") {
	$h_id = 27594;
	echo $h_id;
}
echo $item4;
$stmt = null;

$query2 = "SELECT users.username, employee2.ID AS emp_id, employee2.manager_id_fk, employee2.team3_id_fk FROM users 
LEFT JOIN employee2 on users.sales_code = employee2.abr WHERE users.username = '$item5' " ;
$stmt2 = $conn2->query( $query2 );
while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
	
	$emp_id = $row2['emp_id'];
	$am = $row2['manager_id_fk'];
	$am_team3 = $row2['team3_id_fk'];
}
$stmt2 = null;


if(!empty($item1) && !empty($item2) && !empty($item3)&& !empty($h_id)){
	$query = "INSERT INTO sale_check_in (hospital_id,hospital, department, person, chk_in, username,emp_id,am_id,appove_status,info,am_id_team3) 
	VALUES ('$h_id','$item1', '$item2', '$item3', '$item4','$item5','$emp_id','$am','01','$item6','$am_team3') ";
	$stmt = $conn->query( $query );

	$stmt = null;
	$conn = null;

	switch ($_SESSION["USERNAME"]) {
		case "chalermluck" :
		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: ../SaleCheckIn/indexAM.php?");
		break;
		case "montri" :
		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: ../SaleCheckIn/indexAM.php?");
		break;
		case "san" :
		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: ../SaleCheckIn/indexAM.php?");
		break;
		case "siriluck" :
		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: ../SaleCheckIn/indexAM.php?");
		break;
		case "tanyaporn" :
		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: ../SaleCheckIn/indexAM.php?");
		break;
		case "koragit" :
		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: ../SaleCheckIn/indexAM.php?");
		break;
		case "preecha" :
		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: ../SaleCheckIn/indexAM.php?");
		break;
		case "nisarat_t" :
		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: ../SaleCheckIn/indexAM.php?");
		break;
		case "savinee" :
		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: ../SaleCheckIn/indexAM.php?");
		break;
		case "siriporn" :
		$stmt = null;
		$stmt2 = null;
		$conn = null;
		header("Location: ../SaleCheckIn/indexAM.php?");
		break;
		default : header("Location: ../SaleCheckIn/indexSale.php?");
	}
	
}
?>
<h1 class="h_center1">***หากต้องการแก้ไขวันที่ให้ทำการเขียน Memo และ ให้หัวหน้าเซ็นต์รับทราบก่อนทุกครั้ง****</h1>

</div>

</body>


