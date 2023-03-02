<?php
require_once "../FDA/connect.php";

$item0 = $_POST['item0'];
$item1 = $_POST['item1'];
$item2 = $_POST['item2'];
$item3 = $_POST['item3'];

$query2 = "UPDATE fda_item SET ItemCode = '$item1', FDA_NO = '$item2', FDA_EXPIRED = '$item3' 
WHERE id_num = $item0
";
$stmt2 = $conn->query( $query2 );

echo "$item0 $item1  $item2 $item3 ";

header("Refresh:0; url=../FDA/All_FDA.php");
?>