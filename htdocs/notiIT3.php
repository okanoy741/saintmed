<?php
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");
	$myfile = 'D:\saintmedmirror\data\b2.mdb';
	$fs= filesize($myfile);
	$mb = $fs*0.000001;
	$gb = $mb*0.001;
	   // echo $myfile . ': ' . filesize($myfile) . ' bytes';
		//echo " ||| ".number_format($mb,2,'.','')." MB";
		//echo " ||| ".number_format($gb,2,'.','')." GB";
		
		$mboutput = " ||| ".number_format($mb,2,'.','')." MB";
	$gboutput =  " ||| ".number_format($gb,2,'.','')." GB";
	if ($gb>1.9)
	
	echo "$mboutput$gboutput  เกิน";
	
		else
			echo "$mboutput$gboutput ไม่เกิน"

?>