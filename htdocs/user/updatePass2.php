
<?php
session_start();
try {
	$dbName = "D:/saintmedmirror/data/SM.mdb";
	$conn = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};;Dbq=$dbName; charset=UTF-8");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Using database connection file here

	$item0 = $_GET['uid'];
	$pass = iconv('UTF-8', 'TIS-620',$_POST['passW']);

	/*echo $pass ;
	echo $item0 ;*/
	$query = "UPDATE users SET pswd = '$pass' WHERE username = '$item0'";
	$stmt = $conn->query( $query );

	$stmt = null;
	$conn = null;

	header("Location: ../user/user.php?uname=$item0");
	

}
catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}
?>