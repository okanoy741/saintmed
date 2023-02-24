<?php
include "../SaintService/head.php";
?>

<div class="SV-body">

     <h1>รับงานซ่อม</h1>
     <form action="insert_job.php?" method="POST">
          <h2>ข้อมูลลูกค้า</h2>
          <br>
          ชื่อ-นามสกุล
          <input type="text" name="item1" class="service-box" required><br>
          โรงพยาบาล <br>
          <input type="text" name="item2" class="service-box2" value=" ">&nbspแผนก&nbsp<input type="text" name="item3" class="service-box2" placeholder="แผนก" value=" "><br>
	ที่อยู่ <br>
          <input type="text" name="item4" class="service-box" required><br>
          โทรศัพท์<br>
          <input type="text" name="item5" class="service-box2" required>&nbspต่อ&nbsp<input type="text" name="item6" class="service-box2" placeholder="เบอร์ภายใน"  value=" "><br>
          มือถือ<br>
          <input type="text" name="item7" class="service-box" value=" "><br>
          <br>
          <h2>ข้อมูลเครื่องส่งซ่อม</h2>
          <br>
          หมายเลขเครื่อง(S/N)<br>
          <input type="text" name="item8" class="service-box" required><br>
          ยี่ห้อ<br>
          <input type="text" name="item9" class="service-box" required><br>
          รุ่น<br>
          <input type="text" name="item10" class="service-box" required><br>
          อาการเสีย<br>
          <input type="text" name="item11" class="service-box" required><br><br>
          อุปกรณ์ประกอบ<br><br>
          กระเป๋า​ (Bag) : <br>
                    <select name="item12" class="service-box2" required>
                         <option value="มี">มี</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br>
          กระปุกน้ำ​(Cham) :<br>
                    <select name="item13" class="service-box2" required>
                         <option value="มี">มี</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br> 
          ท่อลม​ (Tube) :  <br>
                    <select name="item14" class="service-box2" required>
                         <option value="Standard">มี Standard</option>
                         <option value="Slim LIN">มี Slim LINE</option>
                         <option value="Climate Line">มี Climate Line</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br> 
          หน้ากาก(Mask) ​ :  <br> 
                    <select name="item15" class="service-box2" required>
                         <option value="Nasal">มี Nasal</option>
                         <option value="Pillows">มี Pillows</option>
                         <option value="Climate Line">มี Full Face</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br>
          หม้อแปลง(Adaptor)​ :<br>
                    <select name="item16" class="service-box2" required>
                         <option value="มี ">มี</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br>
          สายไฟ​(AC Power cord)​ :<br>
                    <select name="item17" class="service-box2" required>
                         <option value="มี ">มี</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br>
          ตัวกรองฝุ่น​(Filter)​ : <br>
                    <select name="item18" class="service-box2" required>
                         <option value="มี ">มี</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br>
          การ์ดความจำ(SD Card) : <br>
                    <select name="item19" class="service-box2" required>
                         <option value="มี ">มี</option>
                         <option value="ไม่มี" selected>ไม่มี</option>
                    </select> <br><br>
          หมายเหตุ<br>
          <textarea name="item20" class="service-box" value=" "></textarea><br>
          <input class='sub-service' type='submit' value='บันทึกรับงานซ่อม'>

     </form>
</div>

<div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
</body>
</html> 