
<?php
session_start();
try {
	include "connect.php";  // Using database connection file here
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

			$query = "UPDATE req_pre SET itemname = '$item4', unitnum = $item5, price = '$item6', binfo = '$item7' WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );
			
			

			
			$stmt = null;
			$conn = null;

			header("Location: edit_prereq.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']."#". $_GET['ID']);
		}
		elseif(empty($_POST['delete']) && !empty($item4) && !empty($item5) && empty($item6) && empty($item7)){
									
			$query = "UPDATE req_pre SET itemname = '$item4', unitnum = $item5 WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );

			

			
			$stmt = null;
			$conn = null;

			header("Location: edit_prereq.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']."#". $_GET['ID']);
		}
		elseif(empty($_POST['delete']) && empty($item4) && !empty($item5) && empty($item6) && empty($item7)){
									
			$query = "UPDATE req_pre SET  unitnum = $item5 WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );

			

			
			$stmt = null;
			$conn = null;

			header("Location: edit_prereq.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']."#". $_GET['ID']);
		}
		elseif(empty($_POST['delete']) && empty($item4) ){
									
			echo "ระบุชื่อสินค้า";
			
			$stmt = null;
			$conn = null;

			header("Location: edit_prereq.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']);
		}		
		elseif(empty($_POST['delete']) && !empty($item4) && !empty($item5) && !empty($item6) && empty($item7)){
									
			$query = "UPDATE req_pre SET itemname = '$item4', unitnum = $item5, price = $item6 WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );

			

			
			$stmt = null;
			$conn = null;

			header("Location: edit_prereq.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']."#". $_GET['ID']);
		}
		elseif(empty($_POST['delete']) && !empty($item4) && !empty($item5) && empty($item6) && !empty($item7)){
			
			$item4 = iconv('UTF-8', 'TIS-620',$_POST['item4']);
			$item5 = $_POST['item5'];
			$item6 = $_POST['item6'];
			
			$query = "UPDATE req_pre SET itemname = '$item4', unitnum = $item5,  binfo = '$item7' WHERE ID = ".$_GET['ID']."";
			$stmt = $conn->query( $query );

			

			
			$stmt = null;
			$conn = null;

			header("Location: edit_prereq.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']."#". $_GET['ID']);
		}
		
		else{
			$stmt = null;
			$conn = null;

			header("Location: edit_prereq.php?ID=". $_GET['PPID']."&PID=". $_GET['PID']);}
		}
	elseif(!empty($_POST['delete'])){
			
			$cheks = implode(",", $_POST['delete']);
			$query = "DELETE FROM req_pre WHERE ID in ($cheks) ";
			$stmt = $conn->query( $query );

		//$query3 = "INSERT INTO edit_log (project_id_fk,edit_log,date1) VALUES (".$_GET['PID'].", 'ลบสินค้าโดย ".$_SESSION["user"]."',date())";
		//$stmt3 = $conn->query( $query3 );

			$stmt = null;
			$conn = null;
			header("Location: edit_prereq.php?ID=".$_GET['PPID']."&PID=".$_GET['PID']." ");
		}
	}
	catch (PDOException $e){
		echo "Connection failed: ". $e->getMessage();
	}
?>