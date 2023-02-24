
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TableExport</title>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" >
	
    <link href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/4.0.11/css/tableexport.css" rel="stylesheet">
	
</head>
<body>

	
	
		
		<table class="table" id="export-data">
			<thead>
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

				</tr>
			</thead>
			<tbody>
				<?php

					$dbName = "D:/saintmedmirror/data/b2.mdb";
					$conn = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};;Dbq=$dbName; charset=UTF-8");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					// ตรวจสอบการเชื่อมต่อฐานข้อมูล
					if (!$conn) {
						
						//กรณีเชื่อมต่อไม่ได้
						die("Connection failed: " . mysqli_connect_error());
					}
					
					$query = "SELECT * FROM LOAN";
					$result = $conn->query( $query );

					//if (odbc_num_fields($result) > 0) {
				
						while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

							echo "<tr>";
								foreach ($row as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
										echo "<td>" . iconv('TIS-620', 'UTF-8',$value ). "</td>"; // I just did not use "htmlspecialchars()" function. 
										}
							echo "</tr>";
						}
					//} else {
						//echo "<tr><td></td><td></td><td></td><td></td></tr>";
					//}

					//odbc_close($conn);
				?>

			</tbody>
		</table>
		

	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.11.10/xlsx.core.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/blob-polyfill/1.0.20150320/Blob.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/4.0.11/js/tableexport.min.js"></script>

	<script>
	
		TableExport(document.getElementsByTagName("table"), {
			headers: true,                              // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
			footers: true,                              // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
			formats: ['xlsx', 'csv', 'txt'],             // (String[]), filetype(s) for the export, (default: ['xls', 'csv', 'txt'])
			filename: 'id',                             // (id, String), filename for the downloaded file, (default: 'id')
			bootstrap: true,                           // (Boolean), style buttons using bootstrap, (default: true)
			exportButtons: true,                        // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
			position: 'top',                         // (top, bottom), position of the caption element relative to table, (default: 'bottom')
			ignoreRows: null,                           // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
			ignoreCols: null,                           // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
			trimWhitespace: true                        // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
		});

	</script>

</body>
</html>