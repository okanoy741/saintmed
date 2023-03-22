<?php
include "connect.php";

$alloitmQuery = "SELECT * FROM alloitm";
$oitmFdaQuery = "SELECT FDA_NO, FDA_EXPIRED, expiration_status FROM OITM_FDA_VIEW WHERE ItemCode = ?";

$allCount = $haveCount = $dontHaveCount = $errorCount = 0;

// Execute query to get all alloitm records
$alloitmStmt = $conn2->prepare($alloitmQuery);
$alloitmStmt->execute();

// Start table
echo "<table>";
echo "<tr><th>Item Code</th><th>Item Name</th><th>FDA Expired</th><th>Expiration Status</th></tr>";

// Loop through alloitm records and check for corresponding oitm_fda_view records
while ($row = $alloitmStmt->fetch(PDO::FETCH_ASSOC)) {
$allCount++;
$itemcode = iconv('Windows-874', 'UTF-8', $row['itemcode']);
$itemname = iconv('Windows-874', 'UTF-8', $row['itemname']);
// Prepare and execute query to get oitm_fda_view record for this alloitm record
$oitmFdaStmt = $conn3->prepare($oitmFdaQuery);
$oitmFdaStmt->execute([$itemcode]);
$row2 = $oitmFdaStmt->fetch(PDO::FETCH_ASSOC);

// Output result row
echo "<tr><td>{$itemcode}</td><td>{$itemname}</td>";
if ($row2) {
    $haveCount++;
    echo "<td>{$row2['FDA_EXPIRED']}</td><td>{$row2['expiration_status']}</td>";
} else {
    $dontHaveCount++;
    echo "<td colspan='2'>ไม่มี อย.</td>";
}
echo "</tr>";

// Clean up
$oitmFdaStmt = null;
}

// End table
echo "</table>";

// Output summary of results
echo "<p>ALL {$allCount} รายการ<br>มีอย. {$haveCount} รายการ<br>ไม่มีอย. {$dontHaveCount} รายการ</p>";

// Close database connections
$conn2 = null;
$conn3 = null;
?>
