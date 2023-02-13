<?php
// PHP program to delete all
// file from a folder
   
// Folder path to be flushed
$folder_path = "uploads/". $_GET["PID"] ."";
   
// List of name of files inside
// specified folder
$files = glob($folder_path.'/*'); 
   
// Deleting all the files in the list
foreach($files as $file) {
   
    if(is_file($file)) 
    
        // Delete the given file
        unlink($file); 
		header("Refresh:1; url= edit_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
}
?>