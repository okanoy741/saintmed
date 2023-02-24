<?php
    use PHPMailer\PHPMailer\PHPMailer;


        $name = "NoReply-Saintmed";
        //$email = "krit@saintmed.com"; //ส่งถึงใคร
        $header = "test send email via php"; // หัวข้อเมล
        $detail = "สวัสดีครับ ขอยาดเทสส่งเมลลลลลล"; //ข้อความ

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
        //$mail->addAddress($email); // Send to mail
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
    
?>