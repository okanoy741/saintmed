<?php
require_once "../FDA/connect.php";


$i = 0;
while($i < $_POST['item0'.$i.'']  ){

   $item0 = $_POST['item0'.$i.''];
   $item1 = $_POST['item1'.$i.''];
   $item2 = $_POST['item2'.$i.''];
   $item3 = $_POST['item3'.$i.''];

   $query2 = "UPDATE fda_item SET ItemCode = '$item1', FDA_NO = '$item2', FDA_EXPIRED = '$item3' 
   WHERE id_num = $item0
   ";
   $stmt2 = $conn->query( $query2 );

   $i++;
};
//echo "$item0 $item1 $item2 $item3 ";

header("Refresh:0; url=../FDA/All_FDA.php");
?>