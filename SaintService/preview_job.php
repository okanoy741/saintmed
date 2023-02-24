<?php

if (empty($_GET['jobID'])) { 
	$message = "กรุณา! ตรวจสอบรหัสงานซ่อม เนื่องจากไม่พบข้อมูล";
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("Refresh:0; url=../SaintService/service_all.php?");
}
include "../SaintService/head.php";
?>

<div class="SV-body">


	<h1>รับงานซ่อม</h1><br>

	<form class ='form1' action='preview_prev.php?jobID=<?php echo $_GET['jobID']; ?>' method='POST'>
		<input class='sub-service2' type='submit' value='Result PM'>
	</form>
	<form class ='form2' action='preview_set.php?jobID=<?php echo $_GET['jobID']; ?>' method='POST'>
          <input class='sub-service2' type='submit' value='ค่าก่อน Maintenance'>
     </form><br><br>
	<form action="service_all.php?">
		<?php
	include "../connect.php";  // Using database connection file here
	$query = "SELECT * ,FORMAT (service_job.re_date, 'dd/MM/yy ') as date1
	FROM service_job
	WHERE job_id = '".$_GET['jobID']."'
	";
	$stmt = $conn->query( $query );	
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		echo "<h2>ข้อมูลลูกค้า</h2>";
		echo " เลขที่งานซ่อม : ". iconv('TIS-620','UTF-8' ,$row['job_id']) ." <br>" ;
		echo " วันที่รับงาน : ". iconv('TIS-620','UTF-8' ,$row['date1']) ." ";
		echo "<br><br>";
		echo "ชื่อ-นามสกุล";
		echo "<input type='text' name='item1' class='service-box' value='". iconv('TIS-620','UTF-8' ,$row['name']) ."' disabled> <br>";
		echo "โรงพยาบาล <br>";
		echo "<input type='text' name='item2' class='service-box2' value='". iconv('TIS-620','UTF-8' ,$row['h_name']) ."' disabled>&nbspแผนก&nbsp<input type='text' name='item3' class='service-box2' placeholder='แผนก' value='". iconv('TIS-620','UTF-8' ,$row['department']) ."' disabled><br>";
		echo "ที่อยู่<br>";
		echo "<input type='text' name='item4' class='service-box' value='". iconv('TIS-620','UTF-8' ,$row['addr']) ."' disabled><br>";
		echo "โทรศัพท์<br>";
		echo "<input type='text' name='item5' class='service-box2' value='". iconv('TIS-620','UTF-8' ,$row['tel']) ."' disabled>&nbspต่อ&nbsp<input type='text' name='item6' class='service-box2' placeholder='เบอร์ภายใน'  value='". iconv('TIS-620','UTF-8' ,$row['subTel']) ."' disabled><br>";
		echo "มือถือ<br>";
		echo "<input type='text' name='item7' class='service-box' value='". iconv('TIS-620','UTF-8' ,$row['mtel']) ."' disabled><br>";
		echo "<br><h2>ข้อมูลเครื่องส่งซ่อม</h2><br>";
		echo "หมายเลขเครื่อง(S/N)<br>";
		echo "<input type='text' name='item8' class='service-box' value='". iconv('TIS-620','UTF-8' ,$row['SN']) ."' disabled><br>";
		echo "ยี่ห้อ<br>";
		echo "<input type='text' name='item9' class='service-box' value='". iconv('TIS-620','UTF-8' ,$row['brand']) ."' disabled><br>";
		echo "รุ่น<br>";
		echo "<input type='text' name='item10' class='service-box' value='". iconv('TIS-620','UTF-8' ,$row['seires']) ."' disabled><br>";
		echo "อาการเสีย<br>";
		echo "<input type='text' name='item11' class='service-box' value='". iconv('TIS-620','UTF-8' ,$row['job']) ."' disabled><br>";
		echo "อุปกรณ์ประกอบ<br><br>";
		echo " กระเป๋า​ (Bag) :<br>";
		echo "<input type='text' name='item12' class='service-box3' value='". iconv('TIS-620','UTF-8' ,$row['item1']) ."' disabled><br>	";	
		echo " กระปุกน้ำ​(Cham) :<br>";
		echo "<input type='text' name='item13' class='service-box3' value='". iconv('TIS-620','UTF-8' ,$row['item2']) ."' disabled><br>";	
		echo " ท่อลม​ (Tube) :<br>";		
		echo "<input type='text' name='item14' class='service-box3' value='". iconv('TIS-620','UTF-8' ,$row['item3']) ."' disabled><br>";		
		echo " หน้ากาก(Mask) ​ :<br>";
		echo "<input type='text' name='item15' class='service-box3' value='". iconv('TIS-620','UTF-8' ,$row['item4']) ."' disabled><br>";		
		echo " หม้อแปลง(Adaptor)​ :<br>";
		echo "<input type='text' name='item16' class='service-box3' value='". iconv('TIS-620','UTF-8' ,$row['item5']) ."' disabled><br>";
		echo " สายไฟ​(AC Power cord)​ :<br>";
		echo "<input type='text' name='item17' class='service-box3' value='". iconv('TIS-620','UTF-8' ,$row['item6']) ."' disabled><br>";
		echo " ตัวกรองฝุ่น​(Filter)​ :<br>";
		echo "<input type='text' name='item18' class='service-box3' value='". iconv('TIS-620','UTF-8' ,$row['item7']) ."' disabled><br>";
		echo " การ์ดความจำ(SD Card) :<br>";
		echo "<input type='text' name='item19' class='service-box3' value='". iconv('TIS-620','UTF-8' ,$row['item8']) ."' disabled><br>";
		echo "หมายเหตุ<br>";
		echo "<textarea name='item20' class='service-box' value='". iconv('TIS-620','UTF-8' ,$row['info']) ."' disabled></textarea><br>";
		echo "<input class='sub-service' type='submit' value='BACK'>";
	}
	$stmt = null;
	$conn = null;
	?>
</form>

</div>


<div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
</body>
</html> 