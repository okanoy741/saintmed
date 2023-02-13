<?php
try {
//$conn = new PDO("sqlsrv:Server=192.168.0.6,1433;Database=qrcode","saintmed_it","P@ssw0rd#1");
$conn = new PDO("sqlsrv:Server=saintmed.dyndns.biz,10143;Database=qr_mapping","saintmed_it","P@ssw0rd#1");
//$conn = new PDO("sqlsrv:Server=192.168.0.4;Database=RUENGDECH_STMED","sa","Sapb1");  
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "Connected";
}

catch (PDOException $e)
{
echo "Connection failed: ". $e->getMessage();
}
?>


<?php
session_start();
//-------connect--------
try {
//$conn = new PDO("sqlsrv:Server=192.168.0.6,1433;Database=qrcode","saintmed_it","P@ssw0rd#1");
  $conn = new PDO("sqlsrv:Server=saintmed.dyndns.biz,10143;Database=qr_mapping","saintmed_it","P@ssw0rd#1");
//$conn = new PDO("sqlsrv:Server=192.168.0.4;Database=RUENGDECH_STMED","sa","Sapb1");  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//-------query--------
  if ( !empty($_POST['search'])) ) {
    $sql = $conn->query("SELECT * FROM employee2 WHERE uid = '".$_POST['search']."' ");
    while ($row = $sql->fetch()) {
      $name = $row['name'].$row['lastname'];
      $positions = $row['positions'];
    }
    $_SESSION["NAME"] = $name;
    $_SESSION["positions"] = $positions;

    $conn=null;

      header("location:../sShirt/b_shirt.php?");
    }

  }

  else if (empty($_POST['NAME']) ) {
    $message = "ไม่พบข้อมูลพนักงาน";
    echo "<script type='text/javascript'>alert('$message');</script>";
    $conn=null;
    //header("location:../emp.php?");
    header("Refresh:1; url= ../emp.php?q=".$_GET['q']."");
  }



}

catch (PDOException $e)
{
  echo "Connection failed: ". $e->getMessage();
}
?>

