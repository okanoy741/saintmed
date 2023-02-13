<?php
include "../SaintService/head.php";
?>
<?php
session_start();
try {
	include "../connect.php";  // Using database connection file here

	$item1 = iconv('UTF-8', 'TIS-620',$_POST['item1']);
	$item2 = iconv('UTF-8', 'TIS-620',$_POST['item2']);
	$item3 = iconv('UTF-8', 'TIS-620',$_POST['item3']);
	$item4 = iconv('UTF-8', 'TIS-620',$_POST['item4']);
	$item5 = $_POST['item5'];
	$item6 = $_POST['item6'];
	$item7 = $_POST['item7'];
	$item8 = iconv('UTF-8', 'TIS-620',$_POST['item8']);
	$item9 = iconv('UTF-8', 'TIS-620',$_POST['item9']);
	$item10 = iconv('UTF-8', 'TIS-620',$_POST['item10']);
	$item11 = iconv('UTF-8', 'TIS-620',$_POST['item11']);
	$item12 = iconv('UTF-8', 'TIS-620',$_POST['item12']);
	$item13 = iconv('UTF-8', 'TIS-620',$_POST['item13']);
	$item14 = iconv('UTF-8', 'TIS-620',$_POST['item14']);
	$item15 = iconv('UTF-8', 'TIS-620',$_POST['item15']);
	$item16 = iconv('UTF-8', 'TIS-620',$_POST['item16']);
	$item17 = iconv('UTF-8', 'TIS-620',$_POST['item17']);
	$item18 = iconv('UTF-8', 'TIS-620',$_POST['item18']);
	$item19 = iconv('UTF-8', 'TIS-620',$_POST['item19']);
	$item20 = iconv('UTF-8', 'TIS-620',$_POST['item20']);

	$service = "S";
	$year = substr(date("Y"), -2);
	$query3 = "SELECT MAX(id) AS last_id FROM service_job";
	$stmt = $conn->query( $query3 );
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$maxId = substr("00000".$row['last_id'] + 1, -5);
		$nextId = $service.$year.$maxId;

	}
	
	
		$query = "INSERT INTO service_job (job_id,re_date ,name, h_name, department, addr, tel,subTel, mtel, SN, brand, seires, job, item1, item2, item3, item4, item5, item6, item7, item8, info) 
		VALUES ('$nextId',date(),'$item1', '$item2', '$item3', '$item4','$item5','$item6','$item7','$item8','$item9','$item10','$item11','$item12','$item13','$item14','$item15','$item16','$item17','$item18','$item19','$item20') ;";
		$stmt = $conn->query( $query );

		$message = "เพิ่มข้อมูลงานซ่อมเรียบร้อยแล้ว";
		echo "<script type='text/javascript'>alert('$message');</script>";
		
		$stmt = null;
		$conn = null;
		header("Refresh:0; url=../SaintService/service_all.php?");
	
	
}
catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}

?>
</body>
</html>