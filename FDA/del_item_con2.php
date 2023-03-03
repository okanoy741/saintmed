<?php
require_once "../FDA/connect.php";

$item0 = $_GET['item'];

$query2 = "DELETE FROM fda_item WHERE id_num = $item0
";
$stmt2 = $conn->query( $query2 );

header("Refresh:0; url=../FDA/update_set_item.php?item=".$_GET['fda']."");
?>