<?php
include "head.php";
?>
<div class="grid1">

  <p id ="headr2">รายการงานซ่อม</p>

  <?php
                        include "../connect.php";  // Using database connection file here
                        $query = "SELECT * 
                        FROM service_job
                        ORDER BY job_id ASC
                        ";
                        $stmt = $conn->query( $query );
                            echo "<table class='table_h' >
                            <tr>
                            <th>รหัสงานซ่อม</th>
                            <th>วันที่รับงาน</th>
                            <th>ยี่ห้อ</th>
                            <th>หมายเลขเครื่อง(S/N)</th>
                            <th>ผู้ส่งซ่อม</th>
                            <th>ผู้รับผิดชอบ</th>
							<th>ค่าเดิม setting</th>
                            <th>Preventive Maintenance & Service</th>
                            <th>Preview</th>
                            </tr>";

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                              echo "<td style= width:7%;>". $row['job_id'] ."</td>";
                              echo "<td style= width:8.5%;>". date("d-m-Y", strtotime($row['re_date'])) ."</td>";
                              echo "<td style= width:8.5%;>". iconv('TIS-620','UTF-8' ,$row['brand']) ."</td>";
                              echo "<td style= width:8.5%;>". iconv('TIS-620','UTF-8' ,$row['SN']) ."</td>";
                              echo "<td style= width:8.5%;>". iconv('TIS-620','UTF-8' ,$row['name']) ."</td>";
                              echo "<td style= width:8.5%;>". iconv('TIS-620','UTF-8' ,$row['name']) ."</td>";
							   echo "<td style= width:4%;><a href=\"serviceDef.php?jobID=".$row['job_id']."\"> Setting </td>";
                              echo "<td style= width:4%;><a href=\"preven_ma.php?jobID=".$row['job_id']."\"> Check </td>";
                              echo "<td style= width:4%;><a href=\"preview_job.php?jobID=".$row['job_id']."\"> Preview </td>";
                              echo "</tr>";
                            }  echo "</table>";      
			$stmt = null;
			$conn = null;
                          ?>
</div>
                          <div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>  

                        </body>
                        </html> 

