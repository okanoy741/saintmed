<?php
if(!is_dir("uploads/")) {
	mkdir("uploads/");

	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
	if (file_exists($target_file)) {
		$uploadOk = 0;
	}

// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
		$message = "ขนาดไฟล์ใหม่เกิน 5 MB.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$uploadOk = 0;
	}

/*// Allow certain file formats
	if($imageFileType != "pdf" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "png"  && $imageFileType != "jpeg" && $imageFileType != "jpg" && $imageFileType != "docx" && $imageFileType != "doc") {
		$message = "upload ได้เฉพาะไฟล์ .pdf, .xls, .xlsx, .png, .jpeg, .jpg, .docx, .doc เท่านั้น";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$uploadOk = 0;
	}*/

// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		header("Refresh:1; url= csvImport.php ");
	}
// if everything is ok, try to upload file
	else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
			header("Location: csvImport.php ");
		} else {
			echo "Sorry, there was an error uploading your file.";
			header("Location: csvImport.php ");
		}
	}
}else{

	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
	if (file_exists($target_file)) {
		$uploadOk = 0;
	}

// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
		$message = "ขนาดไฟล์ใหม่เกิน 5 MB.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$uploadOk = 0;
	}

/*// Allow certain file formats
	if($imageFileType != "pdf" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "png"  && $imageFileType != "jpeg" && $imageFileType != "jpg" && $imageFileType != "docx" && $imageFileType != "doc") {
		$message = "upload ได้เฉพาะไฟล์ .pdf, .xls, .xlsx, .png, .jpeg, .jpg, .docx, .doc เท่านั้น";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$uploadOk = 0;
	}*/

// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		header("Refresh:1; url= csvImport.php ");
	}
// if everything is ok, try to upload file
	else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
			header("Location: csvImport.php ");
		} else {
			echo "Sorry, there was an error uploading your file.";
			header("Location: csvImport.php ");
		}
	}
}
?>