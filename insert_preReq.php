<?php
require_once "connect.php";  // Using database connection file here
$in1 = iconv('UTF-8', 'TIS-620',$_POST['item1']);
$in2 = iconv('UTF-8', 'TIS-620',$_POST['item2']);
$in3 = iconv('UTF-8', 'TIS-620',$_POST['item3']);
$in4 = iconv('UTF-8', 'TIS-620',$_POST['item4']);
$in5 = iconv('UTF-8', 'TIS-620',$_POST['item5']);

$query = "UPDATE projects_pre SET cl = '$in1', project_desc = '$in2', unitnum = '$in3', unitprice ='$in4', statusReq='10'  WHERE ID = ".$_GET['ID']." ";
$stmt = $conn->query( $query );


header("Refresh:0; url=edit_prereq.php?ID=".$_GET['ID']."&PID=".$_GET['PID'].""); 

/*$query = "INSERT INTO projects_pre (ap_status, project_desc, unitprice, employee_id_fk, waran, unitnum) VALUES (15, '$project_desc', '$unitprice', '$employee_id_fk','$waran', '$unitnum')"
    ;
    $stmt = $conn->query( $query );*/

  ?>