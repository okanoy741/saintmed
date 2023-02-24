<?php

if (empty($_GET['jobID'])) { 
	$message = "กรุณา! ตรวจสอบรหัสงานซ่อม เนื่องจากไม่พบข้อมูล";
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("Refresh:0; url=../SaintService/service_all.php?");
}
include "../SaintService/head.php";
?>
<div class="SV-body">
	<h1>Preventive Maintenance(Result)</h1>
	
	<?php
	include "../connect.php";  // Using database connection file here
	$query = "SELECT * 
	FROM service_job
	WHERE job_id = '".$_GET['jobID']."'
	";
	$stmt = $conn->query( $query );
	echo "<table class='table_h' >
	<tr>
	<th>รหัสงานซ่อม</th>
	<th>วันที่รับงาน</th>
	<th>ยี่ห้อ</th>
	<th>หมายเลขเครื่อง(S/N)</th>
	<th>ผู้ส่งซ่อม</th>
	<th>ผู้รับผิดชอบ</th>
	</tr>";

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		echo "<td style= width:7%;>". $row['job_id'] ."</td>";
		echo "<td style= width:8.5%;>". date("d-m-Y", strtotime($row['re_date'])) ."</td>";
		echo "<td style= width:8.5%;>". iconv('TIS-620','UTF-8' ,$row['brand']) ."</td>";
		echo "<td style= width:8.5%;>". iconv('TIS-620','UTF-8' ,$row['SN']) ."</td>";
		echo "<td style= width:8.5%;>". iconv('TIS-620','UTF-8' ,$row['name']) ."</td>";
		echo "<td style= width:8.5%;>". iconv('TIS-620','UTF-8' ,$row['name']) ."</td>";
		echo "</tr>";
	} 

	echo "</table>"; 

	?>
	<form action='preview_job.php?jobID=<?php echo $_GET['jobID']; ?>' method='POST'>
		<?php
	include "../connect.php";  // Using database connection file here
	$query2 = "SELECT * 
	FROM service_prev
	WHERE job_id = '".$_GET['jobID']."'
	";
	$stmt2 = $conn->query( $query2 );

	echo "<table class='table_SV'>";
	echo "<tr>";
	echo "<th>รายละเอียดการตรวจเช็ค</th>";
	echo "<th>สถานะ</th>";
	echo "<th>หมายเหตุ</th>";
	echo "</tr>";

	while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
		

		echo "<tr>";
		echo "<td>ตรวจเช็คการทำงานของเครื่อง</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty1']) ."' warranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info1']) ."' class='tArea-sv' disabled > </td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>ตรวจเช็คแรงดันลม / ปริมาตรลม</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty2']) ."' warranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info2']) ."' class='tArea-sv' disabled > </td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>ตรวจเช็คแบตเตอรี่</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty3']) ."' warranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info3']) ."' class='tArea-sv' disabled > </td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>ตรวจเช็คปุ่มกด</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty4']) ."' warranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info4']) ."' class='tArea-sv' disabled > </td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>ตรวจเช็คระบบสัมผัสหน้าจอ</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty5']) ."' warranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info5']) ."' class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>ตรวจเช็คและตั้งค่าวันที่</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty6']) ."' warranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info6']) ."' class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>ตรวจเช็คระบบเสียงเตือน</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty7']) ."' warranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info7']) ."' class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>ทำความสะอาดตัวเครื่อง</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty8']) ."' warranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info8']) ."' class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>อบโอโซนฆ่าเชื้อโรค</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty9']) ."' warranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info9']) ."' class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>โหลดผลการใช้งาน</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty10']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info10']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>Motor Run Hours</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty11']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info11']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";


		echo "<tr>";
		echo "<th>อุปกรณ์ประกอบ</th>";
		echo "<th>สถานะ</th>";
		echo "<th>หมายเหตุ</th>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>เครื่องทำความชื้น</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty12']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info12']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>กระปุกน้ำ</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty13']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info13']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>หน้ากาก</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty14']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info14']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>ท่อลม<br>"; 
		echo "<input type='text' class ='chk-sv2' value='". iconv('TIS-620','UTF-8' ,$row2['chk1'] ) ."' disabled>";
		echo "</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty15']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info15']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>หม้อแปลง</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty16']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info16']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>สายไฟ</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty17']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info17']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>การ์ดความจำ SD Card</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty18']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info18']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>ตัวกรองฝุ่น</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty19']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info19']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>แบตเตอรี่</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty20']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info20']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>กระเป๋า</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty21']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info21']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>อื่นๆ</td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['warranty22']) ."' ywarranty-sv' disabled></td>";
		echo "<td><input type='text' value='". iconv('TIS-620','UTF-8' ,$row2['info22']) ."'  class='tArea-sv' disabled > </td>";
		echo "</tr>";


	}
	?>
</table>
<input class='sub-service' type='submit' value='BACK'>
</form>

</div>


<div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
</body>
</html> 