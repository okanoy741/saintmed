<?php
include "../SaintService/head.php";
?>
<?php
session_start();
try {
	include "../connect.php";  // Using database connection file here
	$item0 = $_GET['jobID'];
	$item1 = iconv('UTF-8', 'TIS-620',$_POST['item1']);
	$item2 = iconv('UTF-8', 'TIS-620',$_POST['item2']);
	$item3 = iconv('UTF-8', 'TIS-620',$_POST['item3']);
	$item4 = iconv('UTF-8', 'TIS-620',$_POST['item4']);
	$item5 = iconv('UTF-8', 'TIS-620',$_POST['item5']);
	$item6 = iconv('UTF-8', 'TIS-620',$_POST['item6']);
	$item7 = iconv('UTF-8', 'TIS-620',$_POST['item7']);
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
	
	
		$query = "INSERT INTO service_setting (job_id,max ,min, sett, mask, res, ramp,ramp2,EPR, EPR_T, EPR_L, tube, clim, humidity, tube_t,tube_t2, ab_filter, essen, smart, Run) 
          VALUES ('$item0','$item1', '$item2', '$item3', '$item4','$item5','$item6','$item7','$item8','$item9','$item10','$item11','$item12','$item13','$item14','$item15','$item16','$item17','$item18','$item19') ;";
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