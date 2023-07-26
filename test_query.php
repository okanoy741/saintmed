<?php
require_once "connect.php";  // Using database connection file here
$query = "SELECT project_id_fk, MIN(date1) AS oldest_date, RowNum
FROM (
    SELECT project_id_fk, date1,
        (SELECT COUNT(*) FROM req_date_temp AS subquery
         WHERE subquery.project_id_fk = req_date_temp.project_id_fk
         AND subquery.date1 <= req_date_temp.date1) AS RowNum
    FROM req_date_temp
) AS subquery
WHERE RowNum = 1
GROUP BY project_id_fk, RowNum;
";

$result = $conn->query( $query);
while ($row = $result->fetch(PDO::FETCH_ASSOC)){
    echo "<table class='table_show' ID='all_p'>
                              <tr>
                              <th>รหัสโครงการ</th>
                              <td><h2>".$row['project_id_fk'] ."</h2></td>
                              </tr><tr>
                              <th>วันที่เริ่ม</th>
                              <td> ". $row['date1'] ."</td>
                              </tr>
                              <tr>
                              <th>RowNum</th>
                              <td>". $row['RowNum'] ."</td>
                              </tr>

";
}
?>