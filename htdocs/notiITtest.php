<?php
	/*session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$date = date('d-m-y H:i:s');
	$sToken = "vcbYwHhf49rDYR39sTzJdl3gdCU5k5y2csQUlpGbfj5";
	$sMessage = " เริ่มการนำเข้ามูลเปิดหน้า http://saintmed.dyndns.biz/datainput.asp $date ";

	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); */

	//Result error 
	//if(curl_error($chOne)) 
	//{ 
		//echo 'error:' . curl_error($chOne); 
	//} 
	//else { 
		//$result_ = json_decode($result, true); 
		//echo "message : ". $result_['message'];
		header("Location: http://192.168.0.17/datainput1.asp");
	//} 
	//curl_close( $chOne );   
?>