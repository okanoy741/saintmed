
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TableExport</title>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" >
	
    <link href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/4.0.11/css/tableexport.css" rel="stylesheet">
	
</head>
<body>

	<div class="container">
	
		<h3>TableExport</h3>

		<p>The simple, easy-to-implement library to export HTML tables to xlsx, xls, csv, and txt files.</p>
		
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

					$servername = "localhost";
					$username = "root";
					$password = "";
					$db_name = "demo2";

					// สร้างการเชื่อมต่อฐานข้อมูล
					$conn = mysqli_connect($servername, $username, $password,$db_name);

					//กำหนด charset ให้เป็น utf8 เพื่อรองรับภาษาไทย
					mysqli_set_charset($conn,"utf8");

					// ตรวจสอบการเชื่อมต่อฐานข้อมูล
					if (!$conn) {
						
						//กรณีเชื่อมต่อไม่ได้
						die("Connection failed: " . mysqli_connect_error());
					}
					
					$sql = "SELECT * FROM export_table";

					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
				
						while ($row = mysqli_fetch_assoc($result)) {

							echo "<tr>";
							echo "<td>".$row['id']."</td>";
							echo "<td>" . $row['fullname'] . "</td>";
							echo "<td>" . $row['position'] . "</td>";
							echo "<td>" . $row['department'] . "</td>";
							echo "<td>" . $row['company'] . "</td>";
							echo "</tr>";
						}
					} else {
						echo "<tr><td></td><td></td><td></td><td></td></tr>";
					}

					mysqli_close($conn);
				?>

			</tbody>
		</table>
		
	</div>
	
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