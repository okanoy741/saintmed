
<?php
session_start();
try {
	require_once "connect.php";  // Using database connection file here
	$item0 = $_GET['ID'];
	if(empty($_POST['delete'])){

		$item4 = iconv('UTF-8', 'TIS-620',$_POST['item4']);
		$item5 = $_POST['item5'];
		$item6 = $_POST['item6'];
		$item7 = iconv('UTF-8', 'TIS-620',$_POST['item7']);
		
		echo $item4 ;
		echo $item5 ;
		echo $item6 ;
		echo $item7 ;

		if(empty($_POST['delete']) && !empty($item4) && !empty($item5) && !empty($item6) && !empty($item7)){

			$query = "UPDATE req SET itemname = '$item4', unitnum = $item5, price = '$item6', binfo = '$item7' WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );
			
			$query2 = "INSERT INTO edit_log (project_id_fk,edit_log,date1) VALUES (".$_GET['PPID'].", 'แก้ไขข้อมูลโดย ".$_SESSION["user"]."',date())";
			$stmt2 = $conn->query( $query2 );
			
			$stmt = null;
			$stmt2 = null;
			$conn = null;

			header("Location: edit_req.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']."#". $_GET['ID']);
		}
		elseif(empty($_POST['delete']) && !empty($item4) && !empty($item5) && empty($item6) && empty($item7)){
									
			$query = "UPDATE req SET itemname = '$item4', unitnum = $item5 WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );

			$query2 = "INSERT INTO edit_log (project_id_fk,edit_log,date1) VALUES (".$_GET['PPID'].", 'แก้ไขข้อมูลโดย ".$_SESSION["user"]."',date())";
			$stmt2 = $conn->query( $query2 );
			
			$stmt = null;
			$stmt2 = null;
			$conn = null;

			header("Location: edit_req.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']."#". $_GET['ID']);
		}
		elseif(empty($_POST['delete']) && empty($item4) && !empty($item5) && empty($item6) && empty($item7)){
									
			$query = "UPDATE req SET  unitnum = $item5 WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );

			$query2 = "INSERT INTO edit_log (project_id_fk,edit_log,date1) VALUES (".$_GET['PPID'].", 'แก้ไขข้อมูลโดย ".$_SESSION["user"]."',date())";
			$stmt2 = $conn->query( $query2 );
			
			$stmt = null;
			$stmt2 = null;
			$conn = null;

			header("Location: edit_req.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']."#". $_GET['ID']);
		}
		elseif(empty($_POST['delete']) && empty($item4) ){
									
			echo "ระบุชื่อสินค้า";
			
			$stmt = null;
			$stmt2 = null;
			$conn = null;

			header("Location: edit_req.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']);
		}		
		elseif(empty($_POST['delete']) && !empty($item4) && !empty($item5) && !empty($item6) && empty($item7)){
									
			$query = "UPDATE req SET itemname = '$item4', unitnum = $item5, price = $item6 WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );

			$query2 = "INSERT INTO edit_log (project_id_fk,edit_log,date1) VALUES (".$_GET['PPID'].", 'แก้ไขข้อมูลโดย ".$_SESSION["user"]."',date())";
			$stmt2 = $conn->query( $query2 );
			
			$stmt = null;
			$stmt2 = null;
			$conn = null;

			header("Location: edit_req.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']."#". $_GET['ID']);
		}
		elseif(empty($_POST['delete']) && !empty($item4) && !empty($item5) && empty($item6) && !empty($item7)){
			
			$item4 = iconv('UTF-8', 'TIS-620',$_POST['item4']);
			$item5 = $_POST['item5'];
			$item6 = $_POST['item6'];
			
			$query = "UPDATE req SET itemname = '$item4', unitnum = $item5,  binfo = '$item7' WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );

			$query2 = "INSERT INTO edit_log (project_id_fk,edit_log,date1) VALUES (".$_GET['PPID'].", 'แก้ไขข้อมูลโดย ".$_SESSION["user"]."',date())";
			$stmt2 = $conn->query( $query2 );
			
			$stmt = null;
			$stmt2 = null;
			$conn = null;

			header("Location: edit_req.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']."#". $_GET['ID']);
		}
		
		else{
			$stmt = null;
			$stmt2 = null;
			$conn = null;

			header("Location: edit_req.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']);}
		}
	elseif(!empty($_POST['delete'])){
			
			$cheks = implode(",", $_POST['delete']);
			$query = "DELETE FROM req WHERE ID in ($cheks) ";
			$stmt = $conn->query( $query );

		//$query3 = "INSERT INTO edit_log (project_id_fk,edit_log,date1) VALUES (".$_GET['PID'].", 'ลบสินค้าโดย ".$_SESSION["user"]."',date())";
		//$stmt3 = $conn->query( $query3 );

			$stmt = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['PPID']."&PID=".$_GET['PID']." ");
		}
	}
	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>