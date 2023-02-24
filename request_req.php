<?php
include "head.php";
?>


<div class="grid1">

  <div class="banner2">
    <img class="logo" src="../img/saintmed_logo.png"><p>PRE-REQ.</p>
    <p><BR></p>
    <h1>กำลัง Develop หน้า PRE REQ.</h1>
  </div> 
  <?php
require_once "connect.php";  // Using database connection file here

$service = "D";
$year = substr(date("Y"), -2);
$query3 = "SELECT MAX(id) AS last_id FROM projects_pre";
$stmt = $conn->query( $query3 );
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  $maxId = substr("00000".$row['last_id'] + 1, -5);
  $nextId = $service.$maxId;
  $showID = $row['last_id'] + 1;

}
// echo $nextId;

$query = "INSERT INTO projects_pre (ap_status, info, employee_id_fk) VALUES ('15', '$nextId', '".$_GET['eid']."') ";
$stmt2 = $conn->query( $query );

$message = "สร้างเลข PRE-REQUISITION สำเร็จ";
echo "<script type='text/javascript'>alert('$message');</script>";
header("Refresh:0; url=prereq.php?ID=".$showID."&PID=".$nextId.""); 

/*$query = "INSERT INTO projects_pre (ap_status, project_desc, unitprice, employee_id_fk, waran, unitnum) VALUES (15, '$project_desc', '$unitprice', '$employee_id_fk','$waran', '$unitnum')"
    ;
    $stmt = $conn->query( $query );*/

    ?>
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
  <script> 
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("item10")[0].setAttribute('min', today); 
  </script> 
</body>
</html> 

