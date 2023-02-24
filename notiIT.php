<?php
	use PHPMailer\PHPMailer\PHPMailer;
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$date = date('d-m-y H:i:s');
	$sToken = "vcbYwHhf49rDYR39sTzJdl3gdCU5k5y2csQUlpGbfj5";
	//$sMessage = " เริ่มการนำเข้ามูลเปิดหน้า http://saintmed.dyndns.biz/datainput.asp $date ";
	$myfile = 'D:\saintmedmirror\data\b2.mdb';
	$fs= filesize($myfile);
	$mb = $fs*0.000001;
	$gb = $mb*0.001;
	//$gb = 1.85;
	//echo $myfile . ': ' . filesize($myfile) . ' bytes';
	$mboutput = " ||| ".number_format($mb,2,'.','')." MB";
	$gboutput =  " ||| ".number_format($gb,2,'.','')." GB";
	
	
	if ($gb>=1.70 && $gb<=1.90)
	{				
					$sMessage = "Warning !!!! ขนาดไฟล์ B2 ณ เวลา  $date \n***\n $mboutput $gboutput \n***\n !!! PLEASE COMPACT !!! \n \n***INTERNAL LINK*** เริ่มการนำเข้ามูลเปิดหน้า http://192.168.0.7/datainput.asp \n ***EXTERNAL LINK***  http://saintmed.dyndns.biz/datainput.asp $date \n ตรวจสอบการทำงานได้ที่ \n http://saintmed.dyndns.biz/admin/dumplog.asp";
					
					$sMessage2 = "Warning !!!! ขนาดไฟล์ B2 ณ เวลา  $date \n***\n $mboutput $gboutput \n***\n !!! PLEASE COMPACT !!!";
					
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
					
					//sendmail
					    


						$name = "NoReply-Saintmed";
						$email = "pornporm@saintmed.com"; //ส่งถึงใคร
						$header = "[BRFORE PROCESS] Alert!!! B2 TO BIG "; // หัวข้อเมล
						$detail = "$sMessage2"; //ข้อความ

						require_once "PHPMailer/PHPMailer.php"; //ไม่ต้องเปลี่ยน
						require_once "PHPMailer/SMTP.php"; //ไม่ต้องเปลี่ยน
						require_once "PHPMailer/Exception.php"; //ไม่ต้องเปลี่ยน

						$mail = new PHPMailer(); //ไม่ต้องเปลี่ยน
						// SMTP Settings
						$mail->CharSet = "utf-8"; //ไม่ต้องเปลี่ยน
						$mail->isSMTP(); //ไม่ต้องเปลี่ยน
						$mail->Host = "smtp.office365.com"; //ไม่ต้องเปลี่ยน
						$mail->SMTPDebug = 3;// Enable verbose debug output
						//$mail->SMTPDebug = SMTP::DEBUG_SERVER;   
						$mail->SMTPAuth = true; //ไม่ต้องเปลี่ยน
						$mail->Username = "noreply@saintmed.com"; // enter your email address ไม่ต้องเปลี่ยน
						$mail->Password = "You@2022"; // enter your password ไม่ต้องเปลี่ยน
						$mail->Port = 587; //ไม่ต้องเปลี่ยน
						$mail->SMTPSecure = "TLS"; //ไม่ต้องเปลี่ยน

						//Email Settings
						$mail->isHTML(true); //ไม่ต้องเปลี่ยน
						$mail->setFrom("noreply@saintmed.com", $name); 
						$mail->addAddress("krit@saintmed.com"); // Send to mail
						$mail->addAddress($email); // Send to mail
						$mail->addAddress("itsaret.n@saintmed.com"); // Send to mail
						$mail->Subject = $header;
						$mail->Body = $detail;



				//ส่วนผลลัพธ์
									if(!$mail->send()) {
								echo 'Message could not be sent.';
								echo 'Mailer Error: ' . $mail->ErrorInfo;
							} else {
								echo 'Message has been sent';
							}
	
					/////////////////////////////////////////////////////////////
						$result_ = json_decode($result, true); 
						echo "message : ". $result_['message'];
						header("Location: http://192.168.0.7/datainput.asp");
					} 
					curl_close( $chOne );   
				
	}
	else if ($gb>=1.90)
	{
					
						/*$fs= filesize($myfile);
						$mb = $fs*0.000001;
						$gb = $mb*0.001; */
						$sMessage = "DATAINPUT NO PROCESS Alert !!!! ขนาดไฟล์ B2 ณ เวลา  $date \n***\n $mboutput $gboutput \n***\n !!! COMPACT NOW !!! ";
						$sMessage2 = "DATAINPUT NO PROCESS Alert !!!! \n ขนาดไฟล์ B2 ณ เวลา  $date \n***\n $mboutput $gboutput \n***\n !!! COMPACT NOW  !!!";
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
						
						//sendmail
							$name = "NoReply-Saintmed";
							$email = "pornporm@saintmed.com"; //ส่งถึงใคร
							$header = "[BRFORE PROCESS] Alert!!! B2 TO BIG "; // หัวข้อเมล
							$detail = "$sMessage2"; //ข้อความ

							require_once "PHPMailer/PHPMailer.php"; //ไม่ต้องเปลี่ยน
							require_once "PHPMailer/SMTP.php"; //ไม่ต้องเปลี่ยน
							require_once "PHPMailer/Exception.php"; //ไม่ต้องเปลี่ยน

							$mail = new PHPMailer(); //ไม่ต้องเปลี่ยน
							// SMTP Settings
							$mail->CharSet = "utf-8"; //ไม่ต้องเปลี่ยน
							$mail->isSMTP(); //ไม่ต้องเปลี่ยน
							$mail->Host = "smtp.office365.com"; //ไม่ต้องเปลี่ยน
							$mail->SMTPDebug = 3;// Enable verbose debug output
							//$mail->SMTPDebug = SMTP::DEBUG_SERVER;   
							$mail->SMTPAuth = true; //ไม่ต้องเปลี่ยน
							$mail->Username = "noreply@saintmed.com"; // enter your email address ไม่ต้องเปลี่ยน
							$mail->Password = "You@2022"; // enter your password ไม่ต้องเปลี่ยน
							$mail->Port = 587; //ไม่ต้องเปลี่ยน
							$mail->SMTPSecure = "TLS"; //ไม่ต้องเปลี่ยน

							//Email Settings
							$mail->isHTML(true); //ไม่ต้องเปลี่ยน
							$mail->setFrom("noreply@saintmed.com", $name); 
							$mail->addAddress("krit@saintmed.com"); // Send to mail
							$mail->addAddress($email); // Send to mail
							$mail->addAddress("itsaret.n@saintmed.com"); // Send to mail
							$mail->Subject = $header;
							$mail->Body = $detail;
					//ส่วนผลลัพธ์
									if(!$mail->send()) {
									echo 'Message could not be sent.';
									echo 'Mailer Error: ' . $mail->ErrorInfo;
								} else {
									echo 'Message has been sent';
								}
					//////////////////////////////////////////////////////////////////////////////////	
							$result_ = json_decode($result, true); 
							echo "message : ". $result_['message'];
							//header("Location: http://192.168.0.7/datainput.asp");
						} 
						curl_close( $chOne );   
//loopwhilesentlinenoti
						$round_loop = 1;
						while($gb>=1.90)
						{		
								$sMessage = " เตือนครั้งที่ $round_loop \n DATAINPUT NO PROCESS Alert !!!! ขนาดไฟล์ B2 ณ เวลา  $date \n***\n $mboutput $gboutput \n***\n !!! COMPACT NOW !!! ";
								//$sMessage2 = "$round_loop \n DATAINPUT NO PROCESS Alert !!!! \n ขนาดไฟล์ B2 ณ เวลา  $date \n***\n $mboutput $gboutput \n***\n !!! COMPACT NOW  !!!";
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
								
								/* //sendmail
									$name = "NoReply-Saintmed";
									$email = "pornporm@saintmed.com"; //ส่งถึงใคร
									$header = "[BRFORE PROCESS] Alert!!! B2 TO BIG "; // หัวข้อเมล
									$detail = "$sMessage2"; //ข้อความ

									require_once "PHPMailer/PHPMailer.php"; //ไม่ต้องเปลี่ยน
									require_once "PHPMailer/SMTP.php"; //ไม่ต้องเปลี่ยน
									require_once "PHPMailer/Exception.php"; //ไม่ต้องเปลี่ยน

									$mail = new PHPMailer(); //ไม่ต้องเปลี่ยน
									// SMTP Settings
									$mail->CharSet = "utf-8"; //ไม่ต้องเปลี่ยน
									$mail->isSMTP(); //ไม่ต้องเปลี่ยน
									$mail->Host = "smtp.office365.com"; //ไม่ต้องเปลี่ยน
									$mail->SMTPDebug = 3;// Enable verbose debug output
									//$mail->SMTPDebug = SMTP::DEBUG_SERVER;   
									$mail->SMTPAuth = true; //ไม่ต้องเปลี่ยน
									$mail->Username = "noreply@saintmed.com"; // enter your email address ไม่ต้องเปลี่ยน
									$mail->Password = "You@2022"; // enter your password ไม่ต้องเปลี่ยน
									$mail->Port = 587; //ไม่ต้องเปลี่ยน
									$mail->SMTPSecure = "TLS"; //ไม่ต้องเปลี่ยน

									//Email Settings
									$mail->isHTML(true); //ไม่ต้องเปลี่ยน
									$mail->setFrom("noreply@saintmed.com", $name); 
									$mail->addAddress("krit@saintmed.com"); // Send to mail
									$mail->addAddress($email); // Send to mail
									$mail->addAddress("itsaret.n@saintmed.com"); // Send to mail
									$mail->Subject = $header;
									$mail->Body = $detail;
							//ส่วนผลลัพธ์
											if(!$mail->send()) {
											echo 'Message could not be sent.';
											echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else {
											echo 'Message has been sent';
										} */
							//////////////////////////////////////////////////////////////////////////////////	
									$result_ = json_decode($result, true); 
									echo "message : ". $result_['message'];
									//header("Location: http://192.168.0.7/datainput.asp");
								} 
								curl_close( $chOne );
								$fs= filesize($myfile);
								$mb = $fs*0.000001;
								$gb = $mb*0.001;
								$round_loop++;
								sleep(30);
						}
						
					
	}
	else
	{
							$sMessage = "ขนาดไฟล์ B2 ณ เวลา  $date \n***\n $mboutput $gboutput \n \n***INTERNAL LINK*** เริ่มการนำเข้ามูลเปิดหน้า http://192.168.0.7/datainput.asp \n ***EXTERNAL LINK***  http://saintmed.dyndns.biz/datainput.asp $date \n ตรวจสอบการทำงานได้ที่ \n http://saintmed.dyndns.biz/admin/dumplog.asp";
							
								
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
								echo "message : ". $result_['message'];
								header("Location: http://192.168.0.7/datainput.asp");
							} 
							curl_close( $chOne );   
	}
?>