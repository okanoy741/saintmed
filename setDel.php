<?php
include "head.php";
?>
<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["user"]) ){
	header("location: chk.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
	exit;
}
?>

<div class="grid1">

	<div class="banner1">
		<img class="logo" src="../img/saintmed_logo.png"><p>REQ.</p>
		<p><BR></p>
	</div> 
	<div class="side_nav">
		</div>

                    <p id ="headr">ลบสินค้าเป็นชุด</p><br>
                   



              <?php
              echo "<form action='destroy.php?ID=".$_GET['ID']."&PID=". $_GET['PID']."' method='POST'>";
  include "connect.php";  // Using database connection file here
  $query = "SELECT req.ID,projects.ID as pid,projects.project_code1,req.unitnum ,alloitm.ItemName,req.itemName as itemName1,alloitm.itemCode, req.unitnum, req.price ,req.description
  FROM ((req 
  INNER JOIN projects ON req.project_id_fk = projects.ID) 
  LEFT JOIN alloitm ON req.ItemCode = alloitm.ItemCode)
  WHERE req.project_id_fk = ".$_GET['ID']." AND req.unitnum IS NOT NULL 
  order by req.ID ASC
  ";
  
  $query2 = "select TOP 1 *,statusReq.sid,statusReq.sinfo,employee2.ID,employee2.name,employee2.lastname
  FROM (((projects LEFT JOIN statusReq 
  ON projects.statusReq = statusReq.sid)
  LEFT JOIN employee2 
  ON projects.employee_id_fk = employee2.id)
  LEFT JOIN contact
  ON projects.client_id_fk = contact.client_id_fk)
  where projects.ID = ".$_GET['ID']."
  ";

  $query3 = "SELECT req.ID,projects.ID as pid,projects.project_code1,req.unitnum ,alloitm.ItemName,req.itemName as itemName1,alloitm.itemCode, req.unitnum, req.price ,req.description
  FROM ((req 
  INNER JOIN projects ON req.project_id_fk = projects.ID) 
  LEFT JOIN alloitm ON req.ItemCode = alloitm.ItemCode)
  WHERE req.project_id_fk = ".$_GET['ID']." AND req.unitnum IS NOT NULL 
  ";
  $stmt3 = $conn->query( $query3 );

  $stmt2 = $conn->query( $query2 );

  $stmt = $conn->query( $query );

  if( $conn->query( $query ) ){
  	if($_GET['ID']){
		
  		while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
  			echo "<h2 id='name-p'> ชื่องบ : ". iconv('TIS-620', 'UTF-8',$row2['name_p']) ."</h2> ";
  			echo "<p> Status REQ. : ". iconv('TIS-620', 'UTF-8',$row2['sinfo']) ." </p>";
  		}
  		echo" </form> ";
  		echo "<table class='table_h' id='p_info'>";
  		echo "<tr>";
		echo "<th></th>";
  		echo "<th>รหัสโครงการ</th>";
  		echo "<th>Code สินค้า</th>";
  		echo "<th>รายการ Requisition </th>";
  		echo "<th>จำนวน</th>";
  		echo "<th>ราคา:หน่วย</th>";
  		echo "</tr>";
  			
  		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo " <form action='update_req3.php?ID=".$row['ID']."&PPID=".$row['pid']."&PID=". $_GET['PID']."' method='POST'>";
			echo " <td style= width:7%;><input  id='itemname-c' type='checkbox' name ='delete[]' value ='".$row['ID']."'></td>";
  			echo "<td style= width:7%;>". $row['project_code1'] ."</td>";
  			echo "<td style= width:16%;>". $row['itemCode'] ."</td>";
  			echo "<td>". iconv('TIS-620', 'UTF-8',$row['ItemName']) ." <br>
  			". iconv('TIS-620', 'UTF-8',$row['itemName1']) ." </td>";

  			echo "<td style= width:5%; >". number_format($row['unitnum']) ."</td>";

  			echo "<td id='itemname2' style= width:10%;>". number_format($row['price']) ."</td>";

		echo "</tr>";
  		}
		echo "</table>";
		echo "<input class='btn-del' type='submit' value='Delete'>";
		echo "</form>";
  			 		
  		
  		


  		$query2 = "SELECT req.project_id_fk,projects.info,FORMAT (edit_log.date1, 'dd-MM-yy hh:mm:ss') as date1,edit_log.edit_log
  		FROM ((req 
  		INNER JOIN projects ON req.project_id_fk = projects.ID)
  		INNER JOIN edit_log ON req.project_id_fk = edit_log.project_id_fk)  
  		WHERE req.project_id_fk = ".$_GET['ID']." 
  		GROUP BY req.project_id_fk,projects.info, edit_log.edit_log, edit_log.date1,edit_log.ID
  		ORDER BY edit_log.ID DESC
  		";
  		$stmt2 = $conn->query( $query2 );
  		echo "<div class='panel-wrapper'>";
  		echo "<a href='#show' class='show btn' id='show'>Show Log</a>";
  		echo "<a href='#hide' class='hide btn' id='hide'>Hide Log</a>";
  		echo "<div class='panel'>";

  		echo "<table class='table_h1'>
  		<tr>
  		<th>Log แก้ไข</th>
  		</tr>";
  		while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
  			echo "<td>". $row2['edit_log'] ." เวลา ". $row2['date1'] ." </td>";
  			echo "</tr>";
  		} echo "</table>";
  		echo "</div>";
  		echo "<div class='fade'></div>";
  		echo "</div>";  
  	} 
  }
  $stmt = null;
  $stmt2 = null;
  $stmt3 = null;
  $conn = null;
  ?>
</div>

</div>

<div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>  

<script> 

	$(document).ready(function () {
		$('#create_excel').click(function(){
			$("#p_info").table2excel({ 
				filename: "p_info.xls" 
			});   
		}); 
	}); 

</script> 
</body>
</html> 

