<?php

if (empty($_GET['jobID'])) { 
     $message = "กรุณา! ตรวจสอบรหัสงานซ่อม เนื่องจากไม่พบข้อมูล";
     echo "<script type='text/javascript'>alert('$message');</script>";
     header("Refresh:0; url=../SaintService/service_all.php?");
}
include "../SaintService/head.php";
?>

<div class="SV-body">


     <h1>ค่าก่อน Maintenance</h1><br>

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
     FROM (service_setting LEFT JOIN service_job 
                        ON service_setting.job_id = service_job.job_id)
     WHERE service_setting.job_id = '".$_GET['jobID']."'
     ";
     $stmt = $conn->query( $query );    
     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          echo "<h2>ข้อมูลลูกค้า</h2>";
          echo " เลขที่งานซ่อม : ". iconv('TIS-620','UTF-8' ,$row['job_id']) ." <br>" ;
          echo " วันที่รับงาน : ". iconv('TIS-620','UTF-8' ,$row['date1']) ." ";
          echo "<br><br>";

     echo "    Max Pressure<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['max']) ." '>CmH2O 
     <br>";
     echo "Min Pressure <br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['min']) ." '>CmH2O 
     <br>";
     echo "Set Pressure<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['sett']) ." '>CmH2O 
     <br>";
     echo "Mask <br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['mask']) ." '> 
     <br>";
     echo "Ressponse<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['res']) ." '> 
     <br>";
     echo "Ramp Time<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['ramp']) ." '> หรือ <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['ramp2']) ." '> Min
     <br>";
     echo "EPR<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['epr']) ." '> 
     <br>";
     echo "EPR Type <br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['epr_t']) ." '> 
     <br>";
     echo "EPR Level<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['epr_l']) ." '> 
     <br>";
     echo "Tube<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['tube']) ." '> 
     <br>";
     echo "Climate Ctrl<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['clim']) ." '> 
     <br>";
     echo "Humidity level<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['humidity']) ." '> 
     <br>";
     echo "Tube  Temp <br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['tube_t']) ." '> หรือ <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['tube_t2']) ." '>  ํC
     <br>";
     echo "AB.Filter<br>       
      <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['ab_filter']) ." '> 
     <br>";
     echo "Essential<br>     
      <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['essen']) ." '> 
     <br>";   
     echo "Smart Start<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['smart']) ." '> 
     <br>";
     echo "Run Hrs.<br>
     <input type='text' name='item1' class='service-box2' value= ' ". iconv('TIS-620','UTF-8' ,$row['Run']) ." '> 
     <br>";
     echo "<input class='sub-service' type='submit' value='BACK'> ";
     }
     $stmt = null;
     $conn = null;
     ?>
</form>

</div>


<div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
</body>
</html> 