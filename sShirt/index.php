<!DOCTYPE html>
<html>
<head>
	<title>QR CODE</title>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" href="../sShirt/cssforShirt.css">
	<link rel="stylesheet" href="../font/fontawesome/css/all.css" > <!--load all styles -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src= "//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 
	<script src= "//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script> 
</head>
<body class="align">
		<div class="grid">
			<div class="headder">
		<div class="Htext">
			<div class="b-left_H">
				<img height="30" border="0" src="../sShirt/img/SMD_Logo.png">
			</div>
		</div>
	</div>
			<h1>แบบฟอร์มการเลือกเสื้อพนักงานประจำปี 2565</h1>
			<p>คำชี้แจง : พนักงานสามารถเลือกแบบเสื้อแบบใดก็ได้ <br>
				ไม่จำเป็นต้องเป็นเสื้อแบบเดียวกัน <br>
			แต่เมื่อรวมจำนวนเงินแล้วต้องไม่เกิน 1,000 บาท</p>
			<br>
			<hr>
			<div class="box">
				<form action="../sShirt/checkEmp.php?" method="post">
					<p id ="headr"> กรุณากรอกรหัสพนักงาน </p>
					<input class="search" type="text" name="search" placeholder="กรุณากรอกหมาย QR Code" required autofocus>
					<input class="submit" type="submit" value="Submit">
				</form>
			</div>
		</div>
	</body>
