<?php
require_once "../FDA/connect.php";


$i = 1;
while($i < $_POST['item1'.$i.'']  ){

   $item1 = $_POST['item1'.$i.''];
   $item2 = $_POST['item2'.$i.''];
   $item3 = $_POST['item3'.$i.''];
   $item4 = $_POST['item4'.$i.''];

   $query2 = "INSERT INTO fda_item (FDA_NO, FDA_CAT_NO, FDA_ITEMNAME, FDA_EXPIRED, FDA_STATUS)
   VALUES ('$item1', '$item2', '$item3', '$item4', 'HAVE      ');
   ";
   $stmt2 = $conn->query( $query2 );

   $i++;
};

header("Refresh:0; url=../FDA/All_FDA.php");
?>