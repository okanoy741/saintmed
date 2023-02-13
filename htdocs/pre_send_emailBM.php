<?php
include "head.php";
?>
<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["user"]) ){
  header("location: chkA.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
  exit;
}
?>
<div class="grid1">

  <div class="banner1">
    <img class="logo" src="../img/saintmed_logo.png"><p>REQ.</p>
    <p><BR></p>
  </div> 
  
  <?php
    require_once "connect.php";  // Using database connection file here
    $NOheadder = $_GET['ID'];
    $PID =$_GET['PID'];
    $DTLmail = "http://saintmed.dyndns.biz:10898/viewBM_req.php?ID=$NOheadder&PID=$PID ";
    $script = "<script> window.location = 'destroya.php';</script>";
    if (empty($_GET)) { 
      header("Location: http://saintmed.dyndns.biz/sales/tender_list_am.asp?"); 
    }


    $query2 = "SELECT  req.project_id_fk,alloitm.u_bm,employee2.emloffice
    FROM (((req INNER JOIN projects 
      ON req.project_id_fk = projects.ID )
    LEFT JOIN alloitm 
    ON req.ItemCode = alloitm.ItemCode)
    LEFT JOIN employee2 
    ON alloitm.u_bm = employee2.abr)
    WHERE req.project_id_fk = ".$_GET['ID']." AND req.unitnum IS NOT NULL 
    group by alloitm.u_bm,req.project_id_fk,employee2.emloffice
    order by alloitm.u_bm DESC
    ";
    $stmt2 = $conn->query( $query2 ); 
    use PHPMailer\PHPMailer\PHPMailer;
    $name = "NoReply-Saintmed";
        //$email = "krit@saintmed.com"; //ส่งถึงใคร
        $header = "ตรวจสอบ REQ. เลขที่ $NOheadder"; // หัวข้อเมล
        $detail = "รบกวนตรวจอสอบรายการสินค้าใน REQ. เลขที่ $NOheadder <br><br> $DTLmail"; //ข้อความ

        require_once "PHPMailer/PHPMailer.php"; //ไม่ต้องเปลี่ยน
        require_once "PHPMailer/SMTP.php"; //ไม่ต้องเปลี่ยน
        require_once "PHPMailer/Exception.php"; //ไม่ต้องเปลี่ยน

        $mail = new PHPMailer(); //ไม่ต้องเปลี่ยน
        // SMTP Settings
    $mail->CharSet = "utf-8"; //ไม่ต้องเปลี่ยน
        $mail->isSMTP(); //ไม่ต้องเปลี่ยน
        $mail->Host = "smtp.office365.com"; //ไม่ต้องเปลี่ยน
    $mail->SMTPDebug = 3;// Enable verbose debug output
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;   
        $mail->SMTPAuth = true; //ไม่ต้องเปลี่ยน
        $mail->Username = "noreply@saintmed.com"; // enter your email address ไม่ต้องเปลี่ยน
        $mail->Password = "You@2022"; // enter your password ไม่ต้องเปลี่ยน
        $mail->Port = 587; //ไม่ต้องเปลี่ยน
        $mail->SMTPSecure = "TLS"; //ไม่ต้องเปลี่ยน

        //Email Settings
        $mail->isHTML(true); //ไม่ต้องเปลี่ยน
        $mail->setFrom("noreply@saintmed.com", $name); 
        //$mail->addAddress($email); // Send to mail
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
          $BMmail = $row2['emloffice'];
    $mail->addAddress("$BMmail"); // Send to mail
  }
  $mail->Subject = $header;
  $mail->Body = $detail;

    //ส่วนผลลัพธ์
  if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  }
  else {
    echo 'Message has been sent';
  }
  echo $script;
  //header("Location: http://saintmed.dyndns.biz/sales/tender_list_am.asp?");
  
     /* echo "<tr>";
     
      echo "<td id='no' style= width:10%; >". $row2['u_bm'] ." </td>";
       echo "<td id='no' style= width:10%; >". $row2['emloffice'] ." </td>";

       echo "</tr>";*/
       ?>       




     </div>
   </div>
   <div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
   <script> 

     $(document).ready(function () {
      $('#create_excel').click(function(){
        $("#p_info").table2excel({ 
          filename: "p_info.xls" 
        });   
      }); 
    }); 

  </script> 
</body>
</html> 

