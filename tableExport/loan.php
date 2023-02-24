
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TableExport</title>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" >
	
    <link href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/4.0.11/css/tableexport.css" rel="stylesheet">
	
</head>
<body>


	
		<h3>TableExport</h3>

		<p>The simple, easy-to-implement library to export HTML tables to xlsx, xls, csv, and txt files.</p>
		
	<table class='table' id='export-data' border='1'>
<?php
try {
		include "connect.php";  // Using database connection file here
		
		$query = "SELECT * FROM LOAN"
		;
		$result = $conn2->query( $query ); // First parameter is just return of "mysqli_connect()" function
		//echo "<br><br><br><br>";

		//echo "<input class='btn_req' type='submit' ID='create_excel' value='Export to Excel'>";
		//echo "<br>";
		

while ($row = $result->fetch(PDO::FETCH_ASSOC)){ // Important line !!! Check summary get row on array ..
	echo "<tr>";
    foreach ($row as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
        echo "<td>" . iconv('TIS-620', 'UTF-8',$value ). "</td>"; // I just did not use "htmlspecialchars()" function. 
    }
    echo "</tr>";
}
$conn2=null;


}

catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}
?></table>

		
	
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