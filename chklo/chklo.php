<?php
  $lat = $_GET['lat'];
	$long = $_GET['long'];

	// บันทึกข้อมูล lat long ลงไฟล์ข้อความ

	echo "Lat: $lat, Long: $long";
  echo "<br><a href='https://maps.google.com/?q=$lat,$long'  target='_blank'>Google Maps</a>";
?>
