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
	$item5 = iconv('UTF-8', 'TIS-620',$_POST['item5']);
	$item6 = iconv('UTF-8', 'TIS-620',$_POST['item6']);
	$item7 = iconv('UTF-8', 'TIS-620',$_POST['item7']);
	
	$spar1 = iconv('UTF-8', 'TIS-620',$_POST['spar1']);
	$spar2 = iconv('UTF-8', 'TIS-620',$_POST['spar2']);
	$spar3 = iconv('UTF-8', 'TIS-620',$_POST['spar3']);
	$spar4 = iconv('UTF-8', 'TIS-620',$_POST['spar4']);
	$spar5 = iconv('UTF-8', 'TIS-620',$_POST['spar5']);
	$spar6 = iconv('UTF-8', 'TIS-620',$_POST['spar6']);
	$spar7 = iconv('UTF-8', 'TIS-620',$_POST['spar7']);
	$spar8 = iconv('UTF-8', 'TIS-620',$_POST['spar8']);
	$spar9 = iconv('UTF-8', 'TIS-620',$_POST['spar9']);
	$spar10 = iconv('UTF-8', 'TIS-620',$_POST['spar10']);
	$spar11 = iconv('UTF-8', 'TIS-620',$_POST['spar11']);
	$spar12 = iconv('UTF-8', 'TIS-620',$_POST['spar12']);
	$spar13 = iconv('UTF-8', 'TIS-620',$_POST['spar13']);
	$spar14 = iconv('UTF-8', 'TIS-620',$_POST['spar14']);
	$spar15 = iconv('UTF-8', 'TIS-620',$_POST['spar15']);
	$spar16 = iconv('UTF-8', 'TIS-620',$_POST['spar16']);
	
	
	
		$query = "INSERT INTO service_item (job_id,service_type,status_job,info_service, spar1,spar2,spar3,spar4,spar5,spar6,spar7,spar8,spar9,spar10,spar11,spar12,spar13,spar14,spar15,spar16,info_t1,info_t2,info_t3,info_t4) 
		VALUES ('".$_GET['jobID']."','$item1','$item2','$item3','$spar1','$spar2','$spar3','$spar4','$spar5','$spar6','$spar7','$spar8','$spar9','$spar10','$spar11','$spar12','$spar13','$spar14','$spar15','$spar16','$item4','$item5','$item6','$item7') ;";
		$stmt = $conn->query( $query );


		$message = "บันทึกสำเร็จ";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh:0; url=../SaintService/service_all.php?");


	
	
}
catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}

?>
</body>
</html>