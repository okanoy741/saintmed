<?php
session_start();

	include "connect.php";  // Using database connection file here
	$query2 = "select *
	FROM employee2
	where ID = ".$_GET['MA']."
	";
	$stmt2 = $conn->query( $query2 );
	while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
		$name = $row['name'];
	}
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$date = date('d-m-y H:i:s');

	/*if ($_GET['MA'] = '23') {
		$sToken = "ZZxaoH0ujlfIMW5h6TROy4eTrLZ0mr4MxkCRpShWCZ0";
	}
	elseif ($_GET['MA'] = '22') {
		$sToken = "EjLI3Ouy3p1Pyv5kLnItZ52wvWOJ0Ii6OpNdaukNbJQ";
	}
	elseif ($_GET['MA'] = '26') {
		$sToken = "QopNJO7qdLoWKmXR9IoLX05NYHDqX0FEN5ZodJXnezS";
	}
	elseif ($_GET['MA'] = '27') {
		$sToken = "GehKFTeiqnPIWx0cVZMmuwxM92inAmjovfkFFPCNSl2";
	}
	elseif ($_GET['MA'] = '72') {
		$sToken = "aJFPOImoSTF6fZDmLc21ZF9ucJQ473IzEBtkSt2ijSG";
	}
	elseif ($_GET['MA'] = '18') {
		$sToken = "1dkPs71N2FEkBjHR37JpZeFEIVFAoSSw4HvCdXP6pF1";
	}
	elseif ($_GET['MA'] = '231') {
		$sToken = "v4Ulv3BiH7VbeDH71pZOIq6ABpYcwE8KJjCK2yOELly";
	}
	elseif ($_GET['MA'] = '256') {
		$sToken = "WMflsRV6G7x3hDfsiElMzTLrrD3uCIkCG4oxjiPjNhv";
	}
	else{
		$sToken = "jJeyMhYyogX0Ll2QViussXLvxwrc1zPQKaDXUvsZDVf";
	}*/
	switch ($_GET['MA']) {
		case "23":
		$sToken = "ZZxaoH0ujlfIMW5h6TROy4eTrLZ0mr4MxkCRpShWCZ0";
		break;
		case "22":
		$sToken = "EjLI3Ouy3p1Pyv5kLnItZ52wvWOJ0Ii6OpNdaukNbJQ";
		break;
		case "26":
		$sToken = "QopNJO7qdLoWKmXR9IoLX05NYHDqX0FEN5ZodJXnezS";
		break;
		case "27":
		$sToken = "GehKFTeiqnPIWx0cVZMmuwxM92inAmjovfkFFPCNSl2";
		break;
		case "72":
		$sToken = "aJFPOImoSTF6fZDmLc21ZF9ucJQ473IzEBtkSt2ijSG";
		break;
		case "18":
		$sToken = "1dkPs71N2FEkBjHR37JpZeFEIVFAoSSw4HvCdXP6pF1";
		break;
		case "231":
		$sToken = "v4Ulv3BiH7VbeDH71pZOIq6ABpYcwE8KJjCK2yOELly";
		break;
		case "256":
		$sToken = "WMflsRV6G7x3hDfsiElMzTLrrD3uCIkCG4oxjiPjNhv";
		break;

		default:
		$sToken = "jJeyMhYyogX0Ll2QViussXLvxwrc1zPQKaDXUvsZDVf";
		break;

	}
	//$sToken = "jJeyMhYyogX0Ll2QViussXLvxwrc1zPQKaDXUvsZDVf";

	$sMessage = " ขอรับการ Appove ตรวจสอบเลขที่โครงการ ".$_GET['PID']." วันที่ $date \n ทีมคุณ ".iconv('TIS-620', 'UTF-8',$name)."  \n saintmed.dyndns.biz:10898/viewAP_req.php?ID=".$_GET['ID']."%26PID=".$_GET['PID']." ";
	echo $sMessage;
	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 

	//Result error 
	if(curl_error($chOne)) 
	{ 
		echo 'error:' . curl_error($chOne); 
	} 
	else { 
		$result_ = json_decode($result, true); 
		echo "status : ".$result_['status']; echo "message : ". $result_['message'];
		header("Location: http://saintmed.dyndns.biz/sales/tender_list_sales.asp?");
	} 
	curl_close( $chOne );   
?>