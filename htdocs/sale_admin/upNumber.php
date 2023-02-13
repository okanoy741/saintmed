<?php
$page = $_SERVER['PHP_SELF'];
$sec = "1000";
include "../sale_admin/head.php";
?>

<form action="upproject.php?ID=<?php echo $_GET['ID']; ?>&PID=<?php echo $_GET['PID']; ?>" method="post">
	<p id ="headr2"> แจ้งเลขโครงการของคุณ </p>
    <input type="text" name="proID" placeholder="เพิ่มเลขโครงการ" required>
    <input type="submit" value="update">
</form>

