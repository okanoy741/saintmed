<?php
try {
	$conn = new PDO("sqlsrv:Server=192.168.0.4;Database=RUENGDECH_STMED","sa","Sapb1");	
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Using database connection file here


	$item0 = $_GET['ITEM'];
	$item1 = $_POST['item1'];


		header("Location: ../lineOA/index.php?ITEM=".$_POST['item1']);


}
catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}

?>
</body>
</html>