
<?php
session_start();
try {
	include "connect.php";  // Using database connection file here
	
	if 	( !empty($_POST['item7']) && !empty($_POST['item8']) && !empty($_POST['item9']) && !empty($_POST['item10']) && !empty($_POST['item11']) ){
		
		$item7 = iconv('UTF-8', 'TIS-620',$_POST['item7']);
		$item8 = iconv('UTF-8', 'TIS-620',$_POST['item8']);
		$item9 = iconv('UTF-8', 'TIS-620',$_POST['item9']);
		$item10 = date("d-m-Y", strtotime($_POST['item10']. "+1086 years"));
		$item11 = iconv('UTF-8', 'TIS-620',$_POST['item11']);

		if(!empty($item8) && !empty($item7) && !empty($item9) && !empty($item10) && !empty($_POST['item11']) ){
			$query3 = "UPDATE projects SET info = '$item7',name_p = '$item8', location = '$item9', trans_date = '$item10', h_sheet = '$item11' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
		elseif(!empty($item8) && !empty($item7) && empty($item9) && empty($item10) && empty($_POST['item11'])){

			$query3 = "UPDATE projects SET info = '$item7', name_p = '$item8' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			session_destroy();
			$stmt3 = null;
			$conn = null;
			header("Location: view_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
		elseif(!empty($item8) && !empty($item7) && !empty($item9) && empty($item10) && !empty($_POST['item11'])){
			$query3 = "UPDATE projects SET name_p = '$item8', location = '$item9', trans_date = '$item10', h_sheet = '$item11' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
		elseif(!empty($item8) && !empty($item7) && !empty($item9) && empty($item10) && empty($_POST['item11'])){
			$query3 = "UPDATE projects SET name_p = '$item8', location = '$item9', trans_date = '$item10' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
		
	}
	
	elseif( empty($_POST['item7']) && !empty($_POST['item8']) && empty($_POST['item9']) && empty($_POST['item10']) ){
		$item8 = iconv('UTF-8', 'TIS-620',$_POST['item8']);

		if(!empty($item8) && empty($item7) && empty($item9) && empty($item10) ){
			$query3 = "UPDATE projects SET name_p = '$item8' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
	}
	
	elseif( empty($_POST['item7']) && !empty($_POST['item8']) && !empty($_POST['item9']) && empty($_POST['item10']) ){
		$item8 = iconv('UTF-8', 'TIS-620',$_POST['item8']);
		$item9 = iconv('UTF-8', 'TIS-620',$_POST['item9']);
		
		if(!empty($item8) && empty($item7) && !empty($item9) && empty($item10) ){
			$query3 = "UPDATE projects SET name_p = '$item8', location = '$item9' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
		elseif(!empty($item8) && empty($item7) && !empty($item9) && !empty($item10) ){
			$query3 = "UPDATE projects SET name_p = '$item8', location = '$item9', trans_date = '$item10' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
	}


	elseif( empty($_POST['item7']) && !empty($_POST['item8']) && !empty($_POST['item9']) && !empty($_POST['item10']) && empty($_POST['item11']) ){
		$item8 = iconv('UTF-8', 'TIS-620',$_POST['item8']);
		$item9 = iconv('UTF-8', 'TIS-620',$_POST['item9']);
		$item10 = date("d-m-Y", strtotime($_POST['item10']. "+1086 years"));

		if(!empty($item8) && empty($item7) && empty($item9) && empty($item10) ){
			$query3 = "UPDATE projects SET name_p = '$item8', location = '$item9' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}


		elseif(!empty($item8) && empty($item7) && empty($item9) && empty($item10)){
			$query3 = "UPDATE projects SET name_p = '$item8' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
		elseif(!empty($item8) && empty($item7) && !empty($item9) && empty($item10) ){
			$query3 = "UPDATE projects SET name_p = '$item8', location = '$item9' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
		elseif(!empty($item8) && empty($item7) && !empty($item9) && !empty($item10) ){
			$query3 = "UPDATE projects SET name_p = '$item8', location = '$item9', trans_date = '$item10' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}

	}
	
	elseif( !empty($_POST['item7']) && empty($_POST['item8']) && empty($_POST['item9']) && empty($_POST['item10']) && !empty($_POST['item11']) ){
		$item7 = iconv('UTF-8', 'TIS-620',$_POST['item7']);
		$item11 = iconv('UTF-8', 'TIS-620',$_POST['item11']);

		if(!empty($item7) && empty($item8) && empty($item9) && empty($item10) && !empty($_POST['item11'])){

			$query3 = "UPDATE projects SET info = '$item7', h_sheet = '$item11' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			session_destroy();
			$stmt3 = null;
			$conn = null;
			header("Location: view_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
	}		
	
	elseif( !empty($_POST['item7']) && empty($_POST['item8']) && empty($_POST['item9']) && empty($_POST['item10']) && empty($_POST['item11']) ){
		$item7 = iconv('UTF-8', 'TIS-620',$_POST['item7']);

		if(!empty($item7) && empty($item8) && empty($item9) && empty($item10) ){

			$query3 = "UPDATE projects SET info = '$item7' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			session_destroy();
			$stmt3 = null;
			$conn = null;
			header("Location: view_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
	}
	elseif( empty($_POST['item7']) && empty($_POST['item8']) && empty($_POST['item9']) && empty($_POST['item10']) && empty($_POST['item11']) ){
		
			session_destroy();
			$stmt3 = null;
			$conn = null;
			header("Location: view_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
	}
	
	elseif(empty($item7) && !empty($_POST['item11'])){
		$item11 = iconv('UTF-8', 'TIS-620',$_POST['item11']);
			$query3 = "UPDATE projects SET h_sheet = '$item11' WHERE ID = ".$_GET['ID']."";
			$stmt3 = $conn->query( $query3 );

			$stmt3 = null;
			$conn = null;
			header("Location: view_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
		}
		
	else{
			$conn = null;
	header("Location: edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");}
}
	
	
catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}
?>
