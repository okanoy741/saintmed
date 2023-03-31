<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@font-face {
  font-family: 'PK Maehongson';
  src: url('/Asset/font/PK Maehongson-Medium.ttf') format('truetype'),
       url('/Asset/font/PK Maehongson-Medium.otf') format('opentype');
  font-weight: normal;
  font-style: normal;
}
body {
  font-size: 20px;
  font-family: 'PK Maehongson', sans-serif;
}

* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/Asset/img/searchicon.png');
  background-position: 0px 0px;
  background-repeat: no-repeat;
  width: 50%;
	font-family: 'PK Maehongson', sans-serif;
  font-size: 30px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
#myInput2 {
  background-image: url('/Asset/img/searchicon.png');
  background-position: 0px 0px;
  background-repeat: no-repeat;
  width: 50%;
  font-family: 'PK Maehongson', sans-serif;
  font-size: 30px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
#myTable {
  border-collapse: collapse;
  width: 100%;
}

#myTable th {
  background-color: #FCA99A;
  color: #000;
  font-weight: bold;
  padding: 12px;
  text-align: left;
  text-transform: uppercase;
}

#myTable th:first-child {
  border-top-left-radius: 5px;
}

#myTable th:last-child {
  border-top-right-radius: 5px;
}

#myTable tbody tr:hover {
  background-color: #96214E;
  color: #fff;
  transition: all 0.3s ease-in-out;
}

#myTable td {
  background-color: #fce3fc;
  padding: 12px;
}

#myTable tbody tr:nth-child(even) td {
  background-color: #FFF;
}

#myTable tbody tr:nth-child(odd):hover td {
  background-color: #96214E;
  color: #fff;
  transition: all 0.3s ease-in-out;
}
#myTable tbody tr:nth-child(even):hover td {
  background-color: #96214E;
  color: #fff;
  transition: all 0.3s ease-in-out;
}




</style>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width" />
<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
<center>
<h2>รายการทรัพย์สินของฝ่ายธุรการ</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหา เลขทรัพสินย์ หรือ ชื่อทรัพย์สิน.." title="ค้นหา เลขทรัพสินย์ หรือ ชื่อทรัพย์สิน">
<input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="ค้นหา ชื่อผู้ดูแล หรือ แผนก.." title="ค้นหา ชื่อผู้ดูแล">
</center>
<?php
$dbName2 = "D:/saintmedmirror/data/viewer.mdb";
$conn3 = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};;Dbq=$dbName2; charset=UTF-8");
$conn3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
////////////////////////////////////////
$sqlc = "SELECT count(*) as q_asset FROM asset_administration_ia";
$stmtc = $conn3->query($sqlc);
$resultsc = $stmtc->fetchAll(PDO::FETCH_ASSOC);
if (count($resultsc) > 0) {
  // Access the q_asset value from the first row of the result set
  $count = $resultsc[0]['q_asset'];
  
  // Display the count
  echo  "<center>".$count . " รายการ </center>";
} else {
  echo "No assets found.";
}
////////////////////
// Select the columns you want to display
$sql = "SELECT * FROM asset_administration_ia order by itemcode";

// Execute the query and fetch the results
$stmt = $conn3->query($sql);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the table header
echo "<table id = 'myTable'>";
echo "<tr><th >Item Code</th><th>Item Name</th><th>Asset Class</th><th>Department</th><th>Employee</th><th>Active</th><th>Not Active</th><th>Notes</th></tr>";

// Output the table data
foreach ($results as $row) {
    echo "<tr>";
    echo "<td>" . $row['itemcode'] . "</td>";
    echo "<td>" . iconv('Windows-874', 'UTF-8', $row['itemname']) . "</td>";

    echo "<td>" . $row['assetclass'] . "</td>";
    echo "<td>" . iconv('Windows-874', 'UTF-8', $row['dept']) . "</td>";
    echo "<td>" . iconv('Windows-874', 'UTF-8', $row['name']) . "</td>";
	echo "<td>" . $row['active'] . "</td>";
	echo "<td>" . $row['notactive'] . "</td>";
	echo "<td>" . iconv('Windows-874', 'UTF-8', $row['notes']) . "</td>";
	
	echo "</tr>";
}
echo "</table>";

?>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    // Check each cell in the row
    for (j = 0; j < 2; j++) {
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break;
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
}
</script>
<script>
function myFunction2() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    // Check each cell in the row
    for (j = 3; j < 5; j++) {
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break;
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
}
</script>


</body>
</html>
