
<!DOCTYPE html>
<html>
<head>
	<title>Saintmed</title>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" href="saleAdminCss.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src= "//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 
	<script src= "//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script> 
	
</head>
<body class="align">



	<?php

	try {
		include "connect.php";  // Using database connection file here
		
		$query = "SELECT * FROM LOAN2"
		;
		$result = $conn2->query( $query ); // First parameter is just return of "mysqli_connect()" function

		echo "<br><br><br><br>";

		echo "<input class='btn_req' type='submit' ID='create_excel' value='Export to Excel'>";
		echo "<br>";
		echo "<table id='p_info' border='1'>";
		echo "<thead>
		<tr>
		<th>u_brand</th>
		<th>u_type_item</th>
		<th>return_start</th>
		<th>docentry</th>
		<th>comments</th>
		<th>usercomments</th>
		<th>docnum</th>
		<th>linenum</th>
		<th>itemcode</th>
		<th>itemname</th>
		<th>quantity</th>
		<th>serialno</th>
		<th>batch</th>
		<th>slpcode</th>
		<th>docdate</th>
		<th>cardcode</th>
		<th>U_status</th>
		<th>series</th>
		<th>foundnum</th>
		<th>complete</th>
		<th>u_bm</th>
		<th>cardname</th>
		<th>avgprice</th>
		<th>towhscode</th>
		<th>usercomplete</th>
		<th>whsname</th>
		<th>sign_complete</th>
		<th>SN No.</th>
		<th>status</th>
		<th>sale comment</th>
		</tr>
		</thead>";
while ($row = $result->fetch(PDO::FETCH_ASSOC)){ // Important line !!! Check summary get row on array ..
	echo "<tr>";

	foreach ($row as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
        echo "<td>" . iconv('TIS-620', 'UTF-8',$value ). "</td>"; // I just did not use "htmlspecialchars()" function. 
    }
    echo " <td> SN ".iconv('TIS-620', 'UTF-8',$row['serialno'])." </td> ";

    switch ($row['U_status']) {
    	case '01':
		// code...
    	echo " <td> ยืมเพื่อขาย </td> ";
    	break;
    	case '02':
		// code...
    	echo " <td> สำรองระหว่างซ่อม </td> ";
    	break;
    	case '03':
		// code...
    	echo " <td> สาธิต </td> ";
    	break;
    	case '04':
		// code...
    	echo " <td> ออกบูธ </td> ";
    	break;
    	case '05':
		// code...
    	echo " <td> เปิดบิล </td> ";
    	break;
    	case '06':
		// code...
    	echo " <td> อื่นๆ </td> ";
    	break;
    	case '07':
		// code...
    	echo " <td> ซ่อมบำรุง </td> ";
    	break;
    	case '08':
		// code...
    	echo " <td> เคลม </td> ";
    	break;
    	default:
		// code...
    	echo "<td>...</td>";
    	break;
    }


    if (!empty($row['docnum'])) {
	 	// code...
    	$query2 = "select TOP 1 * from comments where table_name = 'alltrans' and table_row = ".$row['docnum']." order by ID DESC";
    	$result2 = $conn2->query( $query2 );
    	while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
			$dateString = $row2['commentsdate']; // Assuming $row2['commentsdate'] is a string
			$dateTime = new DateTime($dateString); // Create a DateTime object from the string
			$dateFormatted = $dateTime->format('d/m/Y'); // Format the DateTime object
    		echo " <td> ".$dateFormatted." ".iconv('TIS-620', 'UTF-8',$row2['table_col_value'])." </td> ";
    	};
    }
    elseif (empty($row['docnum'])) { echo " <td> - </td> "; }
    echo "</tr>";
}

echo "</table>";

$conn2=null;
}

catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}
?>

<script> 
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
								var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
								var yyyy = today.getFullYear();
								var h = String(today.getHours());
								var m = String(today.getMinutes());
								var s = String(today.getSeconds());
								var fn = 'loan '+dd+mm+yyyy+h+m+s+'.xls'
								$(document).ready(function () {
									$('#create_excel').click(function(){
										$("#p_info").table2excel({ 
											filename: fn
										});   
									}); 
								}); 

							</script> 
						</body>
						</html> 