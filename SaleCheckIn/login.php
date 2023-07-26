<?php
session_start();
//-------connect--------
try {
  require_once "../SaleCheckIn/conn.php";

//-------query--------
  if (!empty($_POST['user']) && !empty($_POST['password'])) {
    $sql = $conn2->query("SELECT * FROM users WHERE username = '".$_POST['user']."' AND pswd = '".$_POST['password']."' ");
    while ($row = $sql->fetch()) {
      $username = $row['username'];
      $sales_code = $row['sales_code'];
      $code = $row['code'];
    }
    $_SESSION["USERNAME"] = $username;
    $_SESSION["sales_code"] = $sales_code;
    echo $_SESSION["USERNAME"];
    $conn2=null;

    switch ($username) {
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
      case "tanet" :
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
      default : header("Location: ../SaleCheckIn/index.php?");
    }
  }

  else if (empty($_POST['user']) || empty($_POST['password'])) {
    $message = "ไม่พบข้อมูล Username หรือ Password";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $conn2=null;
    //header("location:../emp.php?");
    header("Location: ../SaleCheckIn/logininput.php?");
  }



}

catch (PDOException $e)
{
  echo "Connection failed: ". $e->getMessage();
}
?>

