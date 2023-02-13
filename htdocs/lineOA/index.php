<?php
include "../lineOA/head.php";
?>
<div class="grid1">
	<div class="banner1">

		<form action="../lineOA/insert_lineoa.php?" method="POST" >
			<h1 id ="headr">เลือกหัวข้อ</h1>

			<td id= itemNamet>
				<input  style= width:95%; type="text" name ='item1' list="itemName"class="itemName" placeholder="เลือกหัวข้อ" >
				<datalist id = "itemName">
					<?php
					$conn = new PDO("sqlsrv:Server=192.168.0.4;Database=RUENGDECH_STMED","sa","Sapb1");	
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Using database connection file here
		  $query = "SELECT UID,INTENT FROM SYS03_MS_INTENT order by UID " ;
		  $stmt = $conn->query( $query );

		  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		  	echo "<option value = '$row[UID]'> || $row[INTENT]  </option>n";
		  }
		  $stmt = null;
		  $conn = null;
		  ?>
		</datalist>
	</td>

	<td><input class="btn_d2" type="submit" value="SELECT"></td>
</table> <br><br>
</form>
</div>

<?php
if(!empty($_GET['ITEM'])){

	$conn2 = new PDO("sqlsrv:Server=192.168.0.4;Database=RUENGDECH_STMED","sa","Sapb1");	
	$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Using database connection file here

	$query2 = "SELECT UID,INTENT_UID,KEYWORD_TH,STATUS FROM SYS03_MS_KEYWORD where INTENT_UID = ".$_GET['ITEM']." order by UID DESC " ;
	$stmt2 = $conn2->query( $query2 );

	echo " <form action='../lineOA/insert_lineoa2.php?ITEM=".$_GET['ITEM']."' method='POST'>";
	echo "<table class='table_h' id='p_info'>
	<tr>
	<th style= width:20%; >KEYWORD</th>
	<td style= width:40%;><input  type='text' name ='item1' class='itemName' placeholder='เพิ่ม Keyword' ></td>
	<td style= width:20%;><input class='btn_d2' type='submit' value='เพิ่ม'></td>
	</tr>";
	
	echo "</form>";

	$conn3 = new PDO("sqlsrv:Server=192.168.0.4;Database=RUENGDECH_STMED","sa","Sapb1");	
		  $conn3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Using database connection file here
		  $query3 = "SELECT UID,INTENT FROM SYS03_MS_INTENT where UID = ".$_GET['ITEM']." order by UID " ;
		  $stmt3 = $conn3->query( $query3 );

		  while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
		  	echo "<br>";
		  	echo "<p id ='headr2'>หัวข้อ : $row3[INTENT]</p>";
		  }
		  $stmt3 = null;
		  $conn3 = null;

		  echo "<p id ='headr2'>KEYWORD ทั้งหมด</p>";
		  echo "<table class='table_h' id='p_info'>
		  <tr>

		  <th>INTENT UID</th>
		  <th>KEYWORD</th>
		  <th>STATUS</th>
		  </tr>";

		  while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){

		  	echo "<td style= width:7%;>". $row2['INTENT_UID'] ."</td>";
		  	echo "<td style= width:30%;>". $row2['KEYWORD_TH'] ."</td>";
		  	echo "<td style= width:7%;>". $row2['STATUS'] ."</td>";

		  	echo "</tr>";
		  	


		  }
		  $stmt = null;
		  $stmt2 = null;
		  $conn = null;
		  $conn2 = null;

		  echo "</table>";
		}
		?>
	</div>

	<div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
</body>
</html> 