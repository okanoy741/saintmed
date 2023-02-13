<?php
include "../qrGen/head.php";
?>
<?php
try {
	include "../connect.php";  // Using database connection file here

	$item1 = iconv('UTF-8', 'TIS-620',$_POST['qr']);
	
	
               header("Refresh:0; url=../qrGen/qrAll.php?q=".iconv('TIS-620', 'UTF-8',$_POST['qr'])." ");

               
           }
           catch (PDOException $e){
           	echo "Connection failed: ". $e->getMessage();
           }

           ?>
       </body>
       </html>