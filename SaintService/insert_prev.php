<?php
include "../SaintService/head.php";
?>
<?php
session_start();
try {
	include "../connect.php";  // Using database connection file here

	$item1 = iconv('UTF-8', 'TIS-620',$_POST['warranty1']);
	$item2 = iconv('UTF-8', 'TIS-620',$_POST['warranty2']);
	$item3 = iconv('UTF-8', 'TIS-620',$_POST['warranty3']);
	$item4 = iconv('UTF-8', 'TIS-620',$_POST['warranty4']);
	$item5 = iconv('UTF-8', 'TIS-620',$_POST['warranty5']);
	$item6 = iconv('UTF-8', 'TIS-620',$_POST['warranty6']);
	$item7 = iconv('UTF-8', 'TIS-620',$_POST['warranty7']);
	$item8 = iconv('UTF-8', 'TIS-620',$_POST['warranty8']);
	$item9 = iconv('UTF-8', 'TIS-620',$_POST['warranty9']);
	$item10 = iconv('UTF-8', 'TIS-620',$_POST['warranty10']);
	$item11 = iconv('UTF-8', 'TIS-620',$_POST['warranty11']);
	$item12 = iconv('UTF-8', 'TIS-620',$_POST['warranty12']);
	$item13 = iconv('UTF-8', 'TIS-620',$_POST['warranty13']);
	$item14 = iconv('UTF-8', 'TIS-620',$_POST['warranty14']);
	$item15 = iconv('UTF-8', 'TIS-620',$_POST['warranty15']);
	$item16 = iconv('UTF-8', 'TIS-620',$_POST['warranty16']);
	$item17 = iconv('UTF-8', 'TIS-620',$_POST['warranty17']);
	$item18 = iconv('UTF-8', 'TIS-620',$_POST['warranty18']);
	$item19 = iconv('UTF-8', 'TIS-620',$_POST['warranty19']);
	$item20 = iconv('UTF-8', 'TIS-620',$_POST['warranty20']);
	$item21 = iconv('UTF-8', 'TIS-620',$_POST['warranty21']);
	$item22 = iconv('UTF-8', 'TIS-620',$_POST['warranty22']);
	
	$chk1 = iconv('UTF-8', 'TIS-620',$_POST['chk1']);

	$info1 = iconv('UTF-8', 'TIS-620',$_POST['info1']);
	$info2 = iconv('UTF-8', 'TIS-620',$_POST['info2']);
	$info3 = iconv('UTF-8', 'TIS-620',$_POST['info3']);
	$info4 = iconv('UTF-8', 'TIS-620',$_POST['info4']);
	$info5 = iconv('UTF-8', 'TIS-620',$_POST['info5']);
	$info6 = iconv('UTF-8', 'TIS-620',$_POST['info6']);
	$info7 = iconv('UTF-8', 'TIS-620',$_POST['info7']);
	$info8 = iconv('UTF-8', 'TIS-620',$_POST['info8']);
	$info9 = iconv('UTF-8', 'TIS-620',$_POST['info9']);
	$info10 = iconv('UTF-8', 'TIS-620',$_POST['info10']);
	$info11 = iconv('UTF-8', 'TIS-620',$_POST['info11']);
	$info12 = iconv('UTF-8', 'TIS-620',$_POST['info12']);
	$info13 = iconv('UTF-8', 'TIS-620',$_POST['info13']);
	$info14 = iconv('UTF-8', 'TIS-620',$_POST['info14']);
	$info15 = iconv('UTF-8', 'TIS-620',$_POST['info15']);
	$info16 = iconv('UTF-8', 'TIS-620',$_POST['info16']);
	$info17 = iconv('UTF-8', 'TIS-620',$_POST['info17']);
	$info18 = iconv('UTF-8', 'TIS-620',$_POST['info18']);
	$info19 = iconv('UTF-8', 'TIS-620',$_POST['info19']);
	$info20 = iconv('UTF-8', 'TIS-620',$_POST['info20']);
	$info21 = iconv('UTF-8', 'TIS-620',$_POST['info21']);
	$info22 = iconv('UTF-8', 'TIS-620',$_POST['info22']);
	
	if(!empty($item1) ){
		$query = "INSERT INTO service_prev (job_id,chk1,warranty1,warranty2,warranty3,warranty4,warranty5,warranty6,warranty7,warranty8,warranty9,warranty10,warranty11,warranty12,warranty13,warranty14,warranty15,warranty16,warranty17,warranty18,warranty19,warranty20,warranty21,warranty22,info1,info2,info3,info4,info5,info6,info7,info8,info9,info10,info11,info12,info13,info14,info15,info16,info17,info18,info19,info20,info21,info22) 
		VALUES ('".$_GET['jobID']."','$chk1','$item1','$item2','$item3','$item4','$item5','$item6','$item7','$item8','$item9','$item10','$item11','$item12','$item13','$item14','$item15','$item16','$item17','$item18','$item19','$item20','$item21','$item22','$info1','$info2','$info3','$info4','$info5','$info6','$info7','$info8','$info9','$info10','$info11','$info12','$info13','$info14','$info15','$info16','$info17','$info18','$info19','$info20','$info21','$info22') ;";
		$stmt = $conn->query( $query );


		$message = "บันทึกสำเร็จ";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh:0; url=../SaintService/service_all.php?");

	}

	else{
		$message = "กรุณา! ตรวจสอบรหัสงานซ่อม เนื่องจากไม่พบข้อมูล";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh:0; url=../SaintService/service_all.php?");
	}
	
	
}
catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}

?>
</body>
</html>