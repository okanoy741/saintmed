
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TableExport</title>
	
    <link href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/4.0.11/css/tableexport.css" rel="stylesheet">
	
	<style>
		body {
		  margin-right: auto;
		  margin-left: auto;
		  padding-left: 15px;
		  padding-right: 15px;
		}
		table,
		th,
		td {
		  border: 1px solid black;
		}
		table {
		  width: 50%;
		}
	</style>
	
</head>
<body>

	<h3>TableExport</h3>

	<p>The simple, easy-to-implement library to export HTML tables to xlsx, xls, csv, and txt files.</p>
	
    <table id="export-data">
        <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Age</th>
            <th>Salary</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Thor Walton</td>
            <td>Regional Director</td>
            <td>45</td>
            <td>$98,540</td>
        </tr>
        <tr>
            <td>Travis Clarke</td>
            <td>Software Engineer</td>
            <td>30</td>
            <td>$275,000</td>
        </tr>
        <tr>
            <td>Suki Burks</td>
            <td>Office Manager</td>
            <td>22</td>
            <td>$67,670</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td class="disabled"></td>
            <td class="disabled"></td>
            <td class="disabled"></td>
            <th>$441,210</th>
        </tr>
        </tfoot>
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
			bootstrap: false,                           // (Boolean), style buttons using bootstrap, (default: true)
			exportButtons: true,                        // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
			position: 'bottom',                         // (top, bottom), position of the caption element relative to table, (default: 'bottom')
			ignoreRows: null,                           // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
			ignoreCols: null,                           // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
			trimWhitespace: true                        // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
		});

	</script>

</body>
</html>