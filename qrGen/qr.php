<?php
include "../qrGen/head.php";
?>

<form action="gen_qr.php?" method="POST">
  <h2>จำนวน QR ต้องต้องการ</h2>
  <input id="qr" name="qr" type="number" required >
  
  <input type="submit" value="Submit">
  

</body>
</html>