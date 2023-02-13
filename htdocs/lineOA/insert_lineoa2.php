<?php
try {
	$conn = new PDO("sqlsrv:Server=192.168.0.4;Database=RUENGDECH_STMED","sa","Sapb1");	
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Using database connection file here


	$item0 = $_GET['ITEM'];
	$item1 = $_POST['item1'];

	if(!empty($item1)){
		$query = "INSERT INTO SYS03_MS_KEYWORD (INTENT_UID,KEYWORD_TH,STATUS) VALUES ($item0,'$item1','ACTIVE')";
		$stmt = $conn->query( $query );

		
		$stmt = null;
		$conn = null;

		header("Location: ../lineOA/index.php?ITEM=".$_GET['ITEM']);
	}

	else{
		$conn = null;

		header("Location: ../lineOA/index.php?ITEM=".$_GET['ITEM']);
	}


}
catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}

?>
</body>
</html>