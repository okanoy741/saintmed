<?php
include "../qrGen/head.php";
?>
<div class="SV-body">
  <br><br><br><br><br>
  
</form>
   

    <?php

 $conn = new PDO("sqlsrv:Server=192.168.0.6,1433;Database=qrcode","saintmed_it","P@ssw0rd#1");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if(empty($_GET)){
    
    echo "<form action='../qrGen/qrSearch.php' method='POST'>
    <p id ='headr2'>ระบุ QR Code</p>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	&nbsp&nbsp&nbsp&nbsp&nbsp
	<input name='qr' type='text' placeholder='Enter QR Code' required >
	<input type='submit' value='Submit'>
    
</form>";
     

    echo "</table>";
    $stmt = null;
    $conn = null;
  }

  elseif(!empty($_GET)){
    $query = "SELECT * ,FORMAT (qr_gen.create_date, 'dd-MM-yy ') as create_date1
    FROM qr_gen
	WHERE QR = '".$_GET['q']."'
    ";
    $stmt = $conn->query( $query ); 
    echo "<p id ='headr2'>QR Code</p>
	<table class='table_h5'>
    <tr>
    <th>Tracking</th>
    <th>QR</th>
    <th>item code</th>
    <th>item name</th>
    <th>วันที่สร้าง</th>
    </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      echo "<td style= width:3%;><a id='q_link' href=\"https://saintmed.dyndns.biz/?q=".iconv('TIS-620', 'UTF-8',$row['QR'])." \"> ติดตามสินค้า </td>";
      echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row['QR']) ."</td>";
      echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row['item_code']) ."</td>";
      echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row['item_name']) ."</td>";
      echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row['create_date1']) ."</td>";

      echo "</tr>";
    } 
    echo "</table>";
    $stmt = null;
    $conn = null;
	
	
  }
  ?>


</div><br><br><br><br><br>


<div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
</body>
</html> 