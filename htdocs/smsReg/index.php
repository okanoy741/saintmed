<!-- <html>
<head>
<title>
qr.saintmed.net</title>
<style>
* { font-family: verdana; font-size: 10pt; COLOR: gray; }
b { font-weight: bold; }
table { border: 1px solid gray;}
td { text-align: center; padding: 25;}
</style>
</head>
<body>
<center>
<br><br><br><br>
<table>
<tr><td>This is a placeholder for the subdomain <b>qr.saintmed.net</b></td></tr>
</table>
<br><br>
</center>
</body>
</html> -->



<!DOCTYPE html>
<html>
<head>
<?PHP
$page = $_SERVER['PHP_SELF'];
$sec = "3000";
?>
  <title>Saintmed</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
  <link rel="stylesheet" href="../saleAdminCss.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src= "//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 
  <script src= "//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script> 
</head>
<body class="align">

  <div class="headder">

    <div class="menu" onclick="javascript: this.classList.toggle('active');">
      <i class="line">
        <ul class="nav">
          <li> <a href="http://saintmed.dyndns.biz/">Home </a></li>

        </ul>
      </i><i class="line"></i><i class="line"></i>
    </div>

    <ul class="nav1">
      <li> <a href="http://saintmed.dyndns.biz/"> <img class="logo" src="../img/saintmed_logo_H.png">  </a></li>
      
    </ul>

  </div>
  <div class="SV-body">
    <?PHP
    $conn = new PDO("sqlsrv:Server=192.168.0.4;Database=RUENGDECH_STMED","sa","Sapb1");  
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT count(CUSTOMER_NAME) AS CustomerReg
    FROM SYS03_MS_CUSTOMER
    WHERE (LINEID <> 'NEW')
    ";
    $stmt = $conn->query( $query ); 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      echo "<table class='table_show' ID='all_p'>
      <tr>
      <th style= width:20%;>Register</th>
      <td style= width:40%;><h2>".$row['CustomerReg']."</h2></td>
      </tr>
      </table>";
      
    }
	$conn = NULL;


    ?>
  </div>




  <div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
</body>
</html> 