<?php

if (empty($_GET['jobID'])) { 
      $message = "กรุณา! ตรวจสอบรหัสงานซ่อม เนื่องจากไม่พบข้อมูล";
      echo "<script type='text/javascript'>alert('$message');</script>";
      header("Refresh:0; url=../SaintService/service_all.php?");
    }
include "../SaintService/head.php";
?>

<div class="SV-body">

	<h1>ข้อมูลการ Service</h1><br>
	
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
	<table class='table_SV'>
		
		<form action='insert_info.php?jobID=<?php echo $_GET['jobID']; ?>' method='POST'>
			<tr>
				<th>ประเภทงานซ่อม</th><br>
				<td><select name="item1" id="warranty-sv">
					<option value="none" >--ประเภทงานซ่อม--</option>
					<option value="ในระยะประกัน">ในระยะประกัน</option>
					<option value="ในสัญญาบริการ">ในสัญญาบริการ</option>
					<option value="นอกระยะประกัน">นอกระยะประกัน</option>
					<option value="ติดตั้ง/ตรวจสอบ">ติดตั้ง/ตรวจสอบ</option>
					<option value="ทำการซ่อม">ทำการซ่อม</option>
				</select>
			</td>
		</tr>

		<tr>
			<th>สถานะงานซ่อม</th>
			<td><select name="item2" id="warranty-sv">
				<option value="none" >--สถานะงานซ่อม--</option>
				<option value="นำเครื่องกลับจากบริษัทซ่อม">นำเครื่องกลับจากบริษัทซ่อม</option>
				<option value="ซ่อม ณ สถานที่ลูกค้า">ในสัญญาบริการ</option>
				<option value="รออะไหล่">รออะไหล่</option>
				<option value="รออนุมัติ">รออนุมัติ</option>
				<option value="อ้างอิงงานซ่อม/บริการ">อ้างอิงงานซ่อม/บริการ</option>
				<option value="ซ่อมแล้วใช้งานปกติ">ซ่อมแล้วใช้งานปกติ</option>
			</select>
		</td>
	</tr>

	<tr>
		<th>รายละเอียดการปฏิบัติงาน</th>
		<td><textarea name="item3" class="tArea-sv" value=' '></textarea></td>
	</tr>


</table>
<table class="head-sv">
	<tr>
		<th class="head-sv">อะไหล่ในการปฏิบัติงาน</th>
	</tr>
</table>
<table>
	<tr>
		<th>รหัสสินค้า</th>
		<th>รายละเอียด</th>
		<th>จำนวน</th>
		<th>ราคา</th>
		<th>หมายเหตุ</th>
	</tr>
	<tr>
		<td><input type="text" class ="chk-sv" name="spar1" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar2" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar3" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar4" value=" " ></td>
		<td><textarea name="item4" class="tArea-sv" value=" " ></textarea></td>
	</tr>
	<tr>
		<td><input type="text" class ="chk-sv" name="spar5" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar6" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar7" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar8" value=" " ></td>
		<td><textarea name="item5" class="tArea-sv" value=" " ></textarea></td>
	</tr>
	<tr>
		<td><input type="text" class ="chk-sv" name="spar9" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar10" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar11" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar12" value=" " ></td>
		<td><textarea name="item6" class="tArea-sv" value=" " ></textarea></td>
	</tr>
	<tr>
		<td><input type="text" class ="chk-sv" name="spar13" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar14" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar15" value=" " ></td>
		<td><input type="text" class ="chk-sv" name="spar16" value=" " ></td>
		<td><textarea name="item7" class="tArea-sv" value=" " ></textarea></td>
	</tr>
</table>


<input class='sub-service' type='submit' value='บันทึกใบงานซ่อม'>
</form>





</div>

<div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
</body>
</html> 