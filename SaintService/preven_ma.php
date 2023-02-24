<?php

if (empty($_GET['jobID'])) { 
      $message = "กรุณา! ตรวจสอบรหัสงานซ่อม เนื่องจากไม่พบข้อมูล";
      echo "<script type='text/javascript'>alert('$message');</script>";
      header("Refresh:0; url=../SaintService/service_all.php?");
    }
include "../SaintService/head.php";
?>

<div class="SV-body">

	<h1>Preventive Maintenance & Service</h1>

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
     $stmt = null;
     $conn = null;	
                            echo "</table>"; 
                        
?>
	

	<table class='table_SV'>
		<tr>
			<th>รายละเอียดการตรวจเช็ค</th>
			<th>สถานะ</th>
			<th>หมายเหตุ</th>
		</tr>

		<form action='insert_prev.php?jobID=<?php echo $_GET['jobID']; ?>' method='POST'>
			<tr>
				<td>ตรวจเช็คการทำงานของเครื่อง</td>
				<td><select name="warranty1" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>
				<td><textarea name="info1" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>ตรวจเช็คแรงดันลม / ปริมาตรลม</td>
				<td><select name="warranty2" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info2" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>ตรวจเช็คแบตเตอรี่</td>
				<td><select name="warranty3" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info3" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>ตรวจเช็คปุ่มกด</td>
				<td><select name="warranty4" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info4" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>ตรวจเช็คระบบสัมผัสหน้าจอ</td>
				<td><select name="warranty5" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info5" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>ตรวจเช็คและตั้งค่าวันที่</td>
				<td><select name="warranty6" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info6" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>ตรวจเช็คระบบเสียงเตือน</td>
				<td><select name="warranty7" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info7" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>ทำความสะอาดตัวเครื่อง</td>
				<td><select name="warranty8" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info8" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>อบโอโซนฆ่าเชื้อโรค</td>
				<td><select name="warranty9" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info9" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>โหลดผลการใช้งาน</td>
				<td><select name="warranty10" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info10" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>Motor Run Hours</td>
				<td><select name="warranty11" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info11" class="tArea-sv" > </textarea></td>

			</tr>

			<tr>
				<th>อุปกรณ์ประกอบ</th>
				<th>สถานะ</th>
				<th>หมายเหตุ</th>
			</tr>

			<tr>
				<td>เครื่องทำความชื้น</td>
				<td><select name="warranty12" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info12" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>กระปุกน้ำ</td>
				<td><select name="warranty13" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info13" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>หน้ากาก</td>
				<td><select name="warranty14" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info14" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>ท่อลม<br> 
					&nbsp&nbsp&nbsp<input type="checkbox" class ="chk-sv2" name="chk1" value="Standard"> Standard <br>
					&nbsp&nbsp&nbsp<input type="checkbox" class ="chk-s2" name="chk1" value="Slim Line"> Slim Line <br>
					&nbsp&nbsp&nbsp<input type="checkbox" class ="chk-s2" name="chk1" value="Climate Line"> Climate Line <br>
				</td>
				<td><select name="warranty15" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info15" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>หม้อแปลง</td>
				<td><select name="warranty16" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info16" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>สายไฟ</td>
				<td><select name="warranty17" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info17" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>การ์ดความจำ SD Card</td>
				<td><select name="warranty18" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info18" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>ตัวกรองฝุ่น</td>
				<td><select name="warranty19" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info19" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>แบตเตอรี่</td>
				<td><select name="warranty20" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info20" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>กระเป๋า</td>
				<td><select name="warranty21" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info21" class="tArea-sv" > </textarea></td>

			</tr>
			<tr>
				<td>อื่นๆ</td>
				<td><select name="warranty22" id="warranty-sv" required>
					<option value="ผ่าน">ผ่าน</option>
					<option value="ไม่ผ่าน">ไม่ผ่าน</option>
					<option value="none" selected>none</option>
				</select></td>				
				
				<td><textarea name="info22" class="tArea-sv" > </textarea></td>

			</tr>
			
	</table>
	<input class='sub-service' type='submit' value='บันทึก Preventive & Service'>
	</form>

</div>

<div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
</body>
</html> 