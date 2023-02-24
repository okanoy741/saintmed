<?php

if (empty($_GET['jobID'])) { 
     $message = "กรุณา! ตรวจสอบรหัสงานซ่อม เนื่องจากไม่พบข้อมูล";
     echo "<script type='text/javascript'>alert('$message');</script>";
     header("Refresh:0; url=../SaintService/service_all.php?");
}
include "../SaintService/head.php";
?>

<div class="SV-body">


     <h1>ค่าก่อน Maintenance</h1>

     <form action='insert_set.php?jobID=<?php echo $_GET['jobID']; ?>' method='POST'>
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
     }
     $stmt = null;
     $conn = null;
     ?>
     Max Pressure<br>
     <input type='text' name='item1' class='service-box2'>CmH2O <br>
     Min Pressure <br>
     <input type='text' name='item2' class='service-box2'>CmH2O <br>
     Set Pressure<br>
     <input type='text' name='item3' class='service-box2'>CmH2O <br>
     Mask <br>
	<select name="item4" class='service-box2'>
                         <option value="Nasal">มี Nasal</option>
                         <option value="Pillows">มี Pillows</option>
                         <option value="Climate Line">มี Full Face</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br>
     Ressponse<br>
     <select name="item5" class='service-box2'>
                         <option value="Standard,">Standard</option>
                         <option value="Soft">Soft</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br>
     Ramp Time<br>
     <select name="item6" class='service-box2'>
                         <option value="off">off</option>
                         <option value="auto">auto</option>
						 <option value="อื่นๆ" selected>อื่นๆ</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> หรือ
					<input type='text' name='item7' class='service-box2' value="-">Min
	 <br>
     EPR<br>
     <select name="item8" class='service-box2'>
                         <option value="off">off</option>
                         <option value="on">on</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select><br>
     EPR ​Type <br>
     <select name="item9" class='service-box2'>
                         <option value="Full time">Full time</option>
                         <option value="Ramp Only">Ramp Only</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select><br>
     EPR.​ Level<br>
     <select name="item10" class='service-box2'>
                         <option value="1">1</option>
                         <option value="2">2</option>
						 <option value="3">3</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select><br>
     Tube<br>
     <select name="item11" class='service-box2'" required>
                         <option value="Standard">มี Standard</option>
                         <option value="Slim LIN">มี Slim LINE</option>
                         <option value="Climate Line">มี Climate Line</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br> 
     Climate​Ctrl<br>
     <select name="item12" class='service-box2'>
                         <option value="auto">auto</option>
                         <option value="Manual">Manual</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select><br>
     Humidity​  level​<br>
     <select name="item13" class='service-box2'>
                         <option value="1">1</option>
                         <option value="2">2</option>
						 <option value="3">3</option>
						 <option value="4">4</option>
						 <option value="5">5</option>
						 <option value="6">6</option>
						 <option value="7">7</option>
						 <option value="8">8</option>
						 <option value="off">off</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select><br>   
     Tube​ Temp​<br>
     <select name="item14" class='service-box2'>
                         <option value="off">off</option>
						 <option value="อื่นๆ" selected>อื่นๆ</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> หรือ
					<input type='text' name='item15' class='service-box2' value="-"> ํC<br>
     AB.Filter<br>       
      <select name="item16" class='service-box2'>
                         <option value="มี">มี</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select><br>   
     Essential<br>     
      <select name="item17" class='service-box2'>
                         <option value="Plus">Plus</option>
						 <option value="on">on</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select><br>      
     Smart​Start<br>
     <select name="item18" class='service-box2'>
                         <option value="off">off</option>
						 <option value="on">on</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select><br>  
     Run.​Hrs.<br>
     <input type='text' name='item19' class='service-box2'> hr.<br>
     <input class='sub-service' type='submit' value='บันทึกค่า Setting'>
     
</form>

</div>


<div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
</body>
</html> 