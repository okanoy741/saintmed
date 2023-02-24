<?php
include "../qrGen/head.php";
?>
<?php
try {
	include "../connect.php";  // Using database connection file here

	$item1 = iconv('UTF-8', 'TIS-620',$_POST['qr']);
	$i = 1;
	while ($i <= $item1) {
      /* the printed value would be
                   $i before the increment
                   (post-increment) */

                   $service = "A";
				   $link = "http://qr.saintmed.net/?q=";
                   $year = substr(date("Y"), -2);
                   $query3 = "SELECT MAX(ID) AS last_id FROM qr_gen";
                   $stmt = $conn->query( $query3 );
                   
                   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                   	$maxId = substr("0000000".$row['last_id'] + 1, -7);
                   	$nextId = $service.$maxId;
					$nextIdFull = $link.$service.$maxId;

                   }

                   $query = "INSERT INTO qr_gen (QR,full_qr,create_date) 
                   VALUES ('$nextId','$nextIdFull',date()) ;";
                   $stmt = $conn->query( $query );

                   $i++;
               }

               $message = "เพิ่มข้อมูลงานซ่อมเรียบร้อยแล้ว";
               echo "<script type='text/javascript'>alert('$message');</script>";

               $stmt = null;
               $conn = null;
               header("Refresh:0; url=../qrGen/qrAll.php?");

               
           }
           catch (PDOException $e){
           	echo "Connection failed: ". $e->getMessage();
           }

           ?>
       </body>
       </html>