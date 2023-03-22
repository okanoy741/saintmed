<?php
include "connect.php";
$sql = "SELECT * FROM alloitm";
$loopall = 0;
$loophave = 0;
$loopdonthave = 0;
$loopdont = 0 ;
// Execute query
$stmt = $conn2->query($sql);
// Fetch results as associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Output results
foreach ($results as $row) {
	$loopall++;
    $itemcode = iconv('Windows-874', 'UTF-8', $row['itemcode']);
    $itemname = iconv('Windows-874', 'UTF-8', $row['itemname']);
    $sqlserv = "SELECT FDA_NO, FDA_EXPIRED, expiration_status FROM OITM_FDA_VIEW WHERE ItemCode = '$itemcode'" ;
    $stmt2 = $conn3->query($sqlserv);
	echo $itemcode . " ::::::: " . $itemname . " ::::::: ";
	$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	if(!empty($row2))
		{
		$loophave++;
         echo $row2['FDA_EXPIRED'] . " ::::::: " . $row2['expiration_status'] . "<br>";
		}  
	elseif(empty($row2))
		{
			$loopdonthave++;
			echo " ไม่มี อย."."<br>";
		}
	else
		{
			$loopdont++;
			echo "WTF!!!!";
		}
}
echo "////////////////// <br> ALL ".$loopall." รายการ <br> มีอย. ". $loophave ." รายการ  <br> ไม่มีอย. ".$loopdonthave." รายการ <br> WTF".$loopdont." รายการ <br> ";
$conn2 = null;
$conn3 = null;
?>
