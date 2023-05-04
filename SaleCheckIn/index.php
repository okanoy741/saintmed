<?php
include "../SaleCheckIn/head.php";
session_start();

?>
<div class="grid1">
	<div class="banner2">
		<img class="logo" src="../img/saintmed_logo.png"><p class="h_center2">รายงานการเข้าโรงพยาบาล</p>
		<p><BR></p>
	</div> <BR><BR>

	<form action="../SaleCheckIn/CheckIn.php" method="POST">
		<?php
		require_once "../SaleCheckIn/conn.php";

		if (!empty($_GET['USERS'])) {
            // code...
      $sql = $conn2->query("SELECT * FROM users WHERE username = '".$_GET['USERS']."' ");
      while ($row = $sql->fetch()) {
        $username = $row['username'];
        $sales_code = $row['sales_code'];
        $code = $row['code'];
      }
    }
    elseif (empty($_GET['USERS'])) {
            // code...
      $sql = $conn2->query("SELECT * FROM users WHERE username = '".$_SESSION["USERNAME"]."' ");
      while ($row = $sql->fetch()) {
        $username = $row['username'];
        $sales_code = $row['sales_code'];
        $code = $row['code'];
      }
      if (empty($_SESSION['USERNAME']) && empty($_GET['USERS'])) { 
       header("Location: ../SaleCheckIn/logininput.php?");
     }
   }
   $_SESSION["USERNAME"] = $username;
   $_SESSION["sales_code"] = $sales_code;
   switch ($_SESSION["USERNAME"]) {
    case "chalermluck" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "montri" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "san" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "siriluck" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "tanyaporn" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "koragit" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "preecha" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "nisarat_t" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "savinee" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "siriporn" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "thitirat" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
    case "netiwat" :
    $stmt = null;
    $stmt2 = null;
    $conn = null;
    header("Location: ../SaleCheckIn/indexAM.php?");
    break;
  }

/*if (empty($_SESSION['USERNAME']) ) { 
     header("Location: ../SaleCheckIn/logininput.php?");
   }*/
   date_default_timezone_set("Asia/Bangkok");
   $chk_time = date("h:i:sa");
   $chk_date = date("d/m/Y");
   echo " 
   <h2 class='h_center'><input  style= width:95%; type='text' name ='item1' list='itemName'class='itemName' placeholder='โรงพยาบาล' required>
   <datalist id = 'itemName'>
   <option type='text'>เข้าพบโรงพยาบาล/ลูกค้าใหม่</option>n";

        // Using database connection file here
   $query = "SELECT * FROM all_hospital " ;
   $stmt = $conn2->query( $query );

   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     echo iconv('TIS-620', 'UTF-8',"<option value = '$row[AR_NAME]'> || $row[ADDB_COMPANY]  </option>n)");
   }
   $stmt = null;

   echo " </datalist><BR><BR></h2>

   <h2 class='h_center'><input  style= width:95%; type='text' name ='item2' 'class='itemName' placeholder='แผนกที่เข้าพบ' required><BR><BR></h2>
   <h2 class='h_center'><input  style= width:95%; type='text' name ='item3' 'class='itemName' placeholder='บุคคลที่เข้าพบ' required><BR><BR></h2>
   <h2 class='h_center'><textarea  style= width:95%; name ='item6' 'class='itemName' placeholder='   รายละเอียดการเข้าพบ' maxlength='255' required></textarea> <BR><BR></h2>

   <h2 class='h_center'><input  style= width:50%; type='submit' name ='item5' 'class='itemName' value = 'บันทึก' ></h2>
   ";
   ?>
 </form>
 <br>
 <div class="name-wrap_report">
  <a class="btn_req2" href=../SaleCheckIn/indexSale.php?>ตรวจสอบรายงาน</a>
</div>
<BR>
<h1 class="h_center1">***หากต้องการแก้ไขวันที่ให้ทำการเขียน Memo และ ให้หัวหน้าเซ็นต์รับทราบก่อนทุกครั้ง****</h1>
<BR>
</div>

</body>


