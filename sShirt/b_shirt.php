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
		<br>
		<div class="b-left">
			ชื่อพนักงาน:<br><br><br>
			แผนก:
		</div>
		<div class="b-right">
			<?php  
			session_start();
			echo $_SESSION["NAME"]; 
			echo $_SESSION["positions"]; ?>
			?>
			<input class='emp' type='text' name='emp' value='$_SESSION["NAME"]?>' disabled ><br><br>
			<input class='emp' type='text' name='role' value='$_SESSION["NAME"]'disabled  >
			
		</div>
		<br><br><br><br><br><br>
		<hr>
		<br>
		<a href="../sShirt/doc/Size_Chart.pdf" target="_blank"><h2>คลิกเพื่อดูตารางเปรียบเทียบขนาดเสื้อ</h2></a>
		<br>
		<form name="frmMain" action="" method="post">
			<table class='table_h' id='p_info'>
				<tr>
					<th style="width: 20%;">ตัวอย่าง</th>
					<th style="width: 29%;">ขนาด-รอบ อก</th>
					<th style="width: 10%;">แบบเสื้อ</th>
					<th style="width: 15%;">ราคา</th>
					<th style="width: 10%;">จำนวน</th>
					<th style="width: 15%;">ราคารวม</th>
				</tr>
				<tbody>
					<tr>
						<td><img height="90" border="0" src="../sShirt/img/s1.jpg"></td>
						<td>
							<select id="s1" name="s11">
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
								<option value="2XL">2XL</option>
							</select><br><br>
							<input class="size" type="text" name="s12" placeholder="ระบุ Size พิเศษ ที่ต้องการ" style="width: 85%;">
						</td>
						<td>
							<select id="s1" name="s13" >
								<option value="M">ช</option>
								<option value="F">ญ</option>
							</select><br><br>
						</td>


						<td><input name="s14" value="235" style="width: 50%;" Onchange="fncSum();" disabled></td>
						<td><input name="s15"  style="width: 50%;"  Onchange="fncSum();" required></td>
						<td><input name="s16" value="" style="width: 50%;" disabled></td>
					</tr>
					<tr>

						<td><img height="90" border="0" src="../sShirt/img/s2.jpg"></td>
						<td>
							<select id="s2" name="s21">
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
								<option value="2XL">2XL</option>
							</select><br><br>
							<input class="size" type="text" name="s22" placeholder="ระบุ Size พิเศษ ที่ต้องการ" style="width: 85%;">
						</td>
						<td>
							<select id="s2" name="s23" >
								<option value="M">ช</option>
								<option value="F">ญ</option>
							</select><br><br>
						</td>
						<td><input name="s24" value="235" style="width: 50%;" Onchange="fncSum2();" disabled></td>
						<td><input name="s25" style="width: 50%;"  Onchange="fncSum2();" required></td>
						<td><input name="s26" value="" style="width: 50%;" disabled></td>
					</tr>

				</tr>  
				<tr>

					<td><img height="90" width="72" border="0" src="../sShirt/img/s3.jpg"></td>
					<td>
						<select id="s3" name="s31">
							<option value="S">S</option>
							<option value="M">M</option>
							<option value="L">L</option>
							<option value="XL">XL</option>
							<option value="2XL">2XL</option>
						</select>
					</td>
					<td>
						<select id="s3" name="s33">
							<option value="M">ช</option>
							<option value="F">ญ</option>
						</select><br><br>
					</td>
					<td><input name="s34" value="350" style="width: 50%;" Onchange="fncSum3();" disabled></td>
					<td><input name="s35" style="width: 50%;"  Onchange="fncSum3();" required></td>
					<td><input name="s36" value="" style="width: 50%;" disabled></td>
				</tr>

			</tr>  
			<tr>
				
				<td><img height="90" border="0" src="../sShirt/img/s4.jpg"></td>
				<td>
					<select id="s4" name="s41">
						<option value="S">S</option>
						<option value="M">M</option>
						<option value="L">L</option>
						<option value="XL">XL</option>
						<option value="2XL">2XL</option>
					</select>
				</td>
				<td>
					<select id="s4" name="s43">
						<option value="M">ช</option>
						<option value="F">ญ</option>
					</select><br><br>
				</td>
				<td><input name="s44" value="150" style="width: 50%;" Onchange="fncSum4();" disabled></td>
				<td><input name="s45" style="width: 50%;"  Onchange="fncSum4();" required></td>
				<td><input name="s46" value="" style="width: 50%;"  disabled></td>
			</tr>

		</tr>  
		<tr>
			
			<td><img height="90"height="100" border="0" src="../sShirt/img/s5.jpg"></td>
			<td>
				<select id="s5" name="s51">
					<option value="S">S</option>
					<option value="M">M</option>
					<option value="L">L</option>
					<option value="XL">XL</option>
					<option value="2XL">2XL</option>
				</select><br><br>
				<input class="size" type="text" name="s52" placeholder="ระบุ Size พิเศษ ที่ต้องการ" style="width: 85%;">
			</td>
			<td>
				<select id="s5" name="s53">
					<option value="M">ช</option>
					<option value="F">ญ</option>
				</select><br><br>
			</td>
			<td><input name="s54" value="205" style="width: 50%;" Onchange="fncSum5();" disabled></td>
			<td><input name="s55" style="width: 50%;"  Onchange="fncSum5();" required></td>
			<td><input name="s56" value="" style="width: 50%;" disabled></td>
		</tr>

	</tr>       
</tbody>


</table>
<br><br>
<div class="sumall">
	ราคารวมทั้งหมด <input name="total" style="width: 25%;" value="" > บาท
</div>
<br><br>
<input type="submit" class="btn_yes" name="submit">
<a href="../sShirt/b_shirt.php#"><input type="botton" class="btn_no" value="ล้างข้อมูล"></a>

</form>

</div>

<script language="JavaScript">
	function fncSum()
	{
		if(isNaN(document.frmMain.s15.value) || document.frmMain.s15.value == "")
		{
			alert('กรุณาใส่ ตัวเลขเท่านั้น !!');
			document.frmMain.s15.focus();
			return;
		}

		document.frmMain.s16.value = parseFloat(document.frmMain.s14.value) * parseFloat(document.frmMain.s15.value);

		document.frmMain.total.value = parseFloat(document.frmMain.s16.value) + parseFloat(document.frmMain.s26.value) + parseFloat(document.frmMain.s36.value) + parseFloat(document.frmMain.s46.value) + parseFloat(document.frmMain.s56.value);
	}
</script>

<script language="JavaScript">
	function fncSum2()
	{
		if(isNaN(document.frmMain.s25.value) || document.frmMain.s25.value == "")
		{
			alert('กรุณาใส่ ตัวเลขเท่านั้น !!');
			document.frmMain.s25.focus();
			return;
		}

		document.frmMain.s26.value = parseFloat(document.frmMain.s24.value) * parseFloat(document.frmMain.s25.value);

		document.frmMain.total.value = parseFloat(document.frmMain.s16.value) + parseFloat(document.frmMain.s26.value) + parseFloat(document.frmMain.s36.value) + parseFloat(document.frmMain.s46.value) + parseFloat(document.frmMain.s56.value);
	}
</script>

<script language="JavaScript">
	function fncSum3()
	{
		if(isNaN(document.frmMain.s35.value) || document.frmMain.s35.value == "")
		{
			alert('กรุณาใส่ ตัวเลขเท่านั้น !!');
			document.frmMain.s35.focus();
			return;
		}

		document.frmMain.s36.value = parseFloat(document.frmMain.s34.value) * parseFloat(document.frmMain.s35.value);

		document.frmMain.total.value = parseFloat(document.frmMain.s16.value) + parseFloat(document.frmMain.s26.value) + parseFloat(document.frmMain.s36.value) + parseFloat(document.frmMain.s46.value) + parseFloat(document.frmMain.s56.value);
	}
</script>

<script language="JavaScript">
	function fncSum4()
	{
		if(isNaN(document.frmMain.s45.value) || document.frmMain.s45.value == "")
		{
			alert('กรุณาใส่ ตัวเลขเท่านั้น !!');
			document.frmMain.s45.focus();
			return;
		}

		document.frmMain.s46.value = parseFloat(document.frmMain.s44.value) * parseFloat(document.frmMain.s45.value);

		document.frmMain.total.value = parseFloat(document.frmMain.s16.value) + parseFloat(document.frmMain.s26.value) + parseFloat(document.frmMain.s36.value) + parseFloat(document.frmMain.s46.value) + parseFloat(document.frmMain.s56.value);
	}
</script>

<script language="JavaScript">
	function fncSum5()
	{
		if(isNaN(document.frmMain.s55.value) || document.frmMain.s55.value == "")
		{
			alert('กรุณาใส่ ตัวเลขเท่านั้น !!');
			document.frmMain.s55.focus();
			return;
		}

		document.frmMain.s56.value = parseFloat(document.frmMain.s54.value) * parseFloat(document.frmMain.s55.value);
		document.frmMain.total.value = parseFloat(document.frmMain.s16.value) + parseFloat(document.frmMain.s26.value) + parseFloat(document.frmMain.s36.value) + parseFloat(document.frmMain.s46.value) + parseFloat(document.frmMain.s56.value);
	}
</script>
</body>
