<?php  
include "../SaleCheckIn/head.php";
?>
<!-- <body class="align">
  <div class="headder">

    <div class="Htext">
      <div class="b-left_H">
        <img height="25" border="0" src="../images/SAINTMED-W.png">
      </div>
    </div>
  </div> -->

<div class="grid">

<br><br><br><br>
  <div class="box-show">
    <div class="container1">
      <div class="Stext">
        <p id ="headr3"> เข้าสู่ระบบสำหรับเจ้าหน้าที่ </p>
      </div>
      <form action="../SaleCheckIn/login.php?" method="POST">
        <p class="h_center1"><i class="fas fa-user"></i></p> <input class="t-input" type="text" name="user" placeholder=" Username"><br>
        <p class="h_center1"><i class="fas fa-key"></i></p> <input class="t-input" type="password" name="password" placeholder=" Password"><br><br>
        <div class="h_center1"><input class="submit-login" type="submit" name="login" value="เข้าสู่ระบบ">
      </form>
    </div>
  </div>


</div>

</body>

