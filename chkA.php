<?PHP session_start(); 
include "head.php";?>
<form action="chk_admin.php?ID=<?php echo $_GET['ID']; ?>&PID=<?php echo $_GET['PID']; ?>" method="post">
	<p id ="headr2"> กรุณายืนยันตัวตนของคุณ </p>
    <input type="text" name="username" placeholder="Enter your username" required>
    <input type="submit" value="Submit">
</form>

