<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
	require_once('class.phpmailer.php');
	require_once('class.smtp.php');
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->SMTPSecure = "tls"; // sets the prefix to the servier
	$mail->Host = "smtp.office365.com"; // sets GMAIL as the SMTP server
	$mail->Port = 587; // set the SMTP port for the GMAIL server
	$mail->Username = "noreply@saintmed.com"; // GMAIL username
	$mail->Password = "You@2022"; // GMAIL password
	$mail->From = "noreply@saintmed.com"; // "name@yourdomain.com";
	//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
	$mail->FromName = "IT TEAM PHP TEST";  // set from Name
	$mail->Subject = "Test sending mail."; 
	$mail->Body = "My Body & <b>My Description</b>";

	$mail->AddAddress("it@saintmed.com", "IT TEAM"); // to Address

	//$mail->AddAttachment("thaicreate/myfile.zip");
	//$mail->AddAttachment("thaicreate/myfile2.zip");

	$mail->AddCC("krit@saintmed.com", "Mr.KRIT"); //CC
	//$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

	$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

	$mail->Send(); 
?>
</body>
</html>