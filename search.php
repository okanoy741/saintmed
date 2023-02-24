<?php
$page = $_SERVER['PHP_SELF'];
$sec = "1000";
include "sale_admin/head.php";
?>
<div class="grid1">

    <div class="banner1">
        <img class="logo" src="../img/saintmed_logo.png"></img>
    </div>
<p id ="headr2">รายการขออนุมัติเลขโครงการ</p>
<form name="search" action='../sale_admin/search.php?' method="POST">
            
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input name="search" type="text" id="serchBox" placeholder="---Search จากชื่อพนักงาน---"> <br><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href='../sale_admin/chk_projects.php'> clear filter</a> <br>
        </form>
                    <?php
                    
                    if (empty($_GET)) {
                        include "connect.php";  // Using database connection file here
                        $query = "SELECT * , statusReq.sid,employee2.name,employee2.lastname,employee2.id as EID
                                FROM ((projects_pre LEFT JOIN statusReq 
                                ON projects_pre.ap_status = statusReq.sid)
                                LEFT JOIN employee2 
                                ON projects_pre.employee_id_fk = employee2.id)
                                where ap_status <> 16 AND ap_status <> 13 OR ap_status IS NULL
                                  ORDER BY projects_pre.ap_status DESC
                                  ";
                        $stmt = $conn->query( $query );
                            echo "<table class='table_h5' >
                            <tr>
                            <th>ออกรหัสโครงการ</th>
                            <th>มีรหัสโครงการแล้ว</th>
                            <th>โรงพยาบาล</th>
                            <th>ราคาต่อเครื่อง</th>
                            <th>จำนวน</th>
                            <th>ราคารวม VAT</th>
                            <th>ผู้รับผิดชอบ</th>
                            <th>สถานะ</th>
                            <th>Reject</th>
                            </tr>";

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo "<td style= width:7%;><a href=\"../sale_admin/reqNumber.php?ID=".iconv('TIS-620', 'UTF-8',$row['ID'])."&PID=".iconv('TIS-620', 'UTF-8',$row['funnel_id'])."&STA=".iconv('TIS-620', 'UTF-8',$row['sid'])."&PD=".iconv('TIS-620', 'UTF-8',$row['project_desc'])."&CL=".iconv('TIS-620', 'UTF-8',$row['cl'])."&UP=".iconv('TIS-620', 'UTF-8',$row['unitprice'])."&EMP=".iconv('TIS-620', 'UTF-8',$row['employee_id_fk'])."&UN=".iconv('TIS-620', 'UTF-8',$row['unitnum'])."&PV=".iconv('TIS-620', 'UTF-8',$row['pro_value'])."\"> ออกรหัสโครงการ </td>";
                                    echo "<td style= width:7%;><a href=\"../sale_admin/upNumber.php?ID=".iconv('TIS-620', 'UTF-8',$row['ID'])."&PID=".iconv('TIS-620', 'UTF-8',$row['funnel_id'])."&STA=".iconv('TIS-620', 'UTF-8',$row['sid'])." \"> อัพเดทเลขโครงการ </td>";
                                    echo "<td style= width:25%;>"
                                    .iconv('TIS-620', 'UTF-8',$row['cl'])." "."<br>".iconv('TIS-620', 'UTF-8',$row['project_desc']);
                                     "</td>";
                                    echo "<td style= width:8%;>". number_format($row['unitprice']) ."</td>";
                                    echo "<td style= width:8%;>". $row['unitnum'] ."</td>";
                                    echo "<td style= width:8%;>". number_format($row['pro_value']) ."</td>";
                                    echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row['name']) ." ". iconv('TIS-620', 'UTF-8',$row['lastname']) ."</td>";
                                    echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row['sinfo']) ."</td>";
                                    echo "<td style= width:5%;><a href=\"../sale_admin/reject.php?ID=".iconv('TIS-620', 'UTF-8',$row['ID'])."\"> Reject </a></td>";
                                echo "</tr>";
                            } 

                        echo "</table>";
                        
                        echo "<p id ='headr2'>รายการได้รับเลขแล้ว</p>";
                    
                        $query = "SELECT projects_pre.* , statusReq.sid, projects.project_code1 as fid, statusReq.sinfo,employee2.name,employee2.lastname
                                FROM (((projects_pre LEFT JOIN statusReq 
                                ON projects_pre.ap_status = statusReq.sid)
                                LEFT JOIN projects 
                                ON projects_pre.funnel_id = projects.funnel_id)
                                LEFT JOIN employee2 
                                ON projects_pre.employee_id_fk = employee2.id)
                                where ap_status = 16 
                                  ORDER BY projects_pre.ID ASC
                                  ";
                        $stmt = $conn->query( $query );
                        
                        
                            echo "<table class='table_h5' >
                            <tr>
                            <th>รหัสโครงการ</th>
                            <th>โรงพยาบาล</th>
                            <th>ราคาต่อเครื่อง</th>
                            <th>จำนวน</th>
                            <th>ราคารวม VAT</th>
                            <th>ผู้รับผิดชอบ</th>
                            <th>สถานะ</th>
                            </tr>";

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo "<td style= width:7%;>". $row['fid'] ."</td>";
                                    echo "<td style= width:25%;>"
                                    .iconv('TIS-620', 'UTF-8',$row['cl'])." "."<br>".iconv('TIS-620', 'UTF-8',$row['project_desc']);
                                     "</td>";
                                    echo "<td style= width:8%;>". number_format($row['unitprice']) ."</td>";
                                    echo "<td style= width:8%;>". $row['unitnum'] ."</td>";
                                    echo "<td style= width:8%;>". number_format($row['pro_value']) ."</td>";
                                    echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row['name']) ." ". iconv('TIS-620', 'UTF-8',$row['lastname']) ."</td>";
                                    echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row['sinfo']) ."</td>";
                                     echo "</tr>";
                            } 
                        
                        echo "</table>";
                        
                        echo "<p id ='headr2'>รายการการยกเลิกโครงการ</p>";
                    
                        $query = "SELECT projects_pre.* , statusReq.sid, projects.project_code1 as fid, statusReq.sinfo,employee2.name,employee2.lastname
                                FROM (((projects_pre LEFT JOIN statusReq 
                                ON projects_pre.ap_status = statusReq.sid)
                                LEFT JOIN projects 
                                ON projects_pre.funnel_id = projects.funnel_id)
                                LEFT JOIN employee2 
                                ON projects_pre.employee_id_fk = employee2.id)
                                where ap_status = 13 
                                  ORDER BY projects_pre.ID ASC
                                  ";
                        $stmt = $conn->query( $query );
                        
                        
                            echo "<table class='table_h5' >
                            <tr>
                            <th>รหัสโครงการ</th>
                            <th>โรงพยาบาล</th>
                            <th>ราคาต่อเครื่อง</th>
                            <th>จำนวน</th>
                            <th>ราคารวม VAT</th>
                            <th>สถานะ</th>
                            <th>ผู้รับผิดชอบ</th>
                            <th>Reject</th>
                            </tr>";

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo "<td style= width:7%;>". $row['fid'] ."</td>";
                                    echo "<td style= width:25%;>"
                                    .iconv('TIS-620', 'UTF-8',$row['cl'])." "."<br>".iconv('TIS-620', 'UTF-8',$row['project_desc']);
                                     "</td>";
                                    echo "<td style= width:8%;>". number_format($row['unitprice']) ."</td>";
                                    echo "<td style= width:8%;>". $row['unitnum'] ."</td>";
                                    echo "<td style= width:8%;>". number_format($row['pro_value']) ."</td>";
                                    echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row['name']) ." ". iconv('TIS-620', 'UTF-8',$row['lastname']) ."</td>";
                                    echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row['sinfo']) ."</td>";
                                    echo "<td style= width:5%;><a href=\"../sale_admin/return.php?ID=".iconv('TIS-620', 'UTF-8',$row['ID'])."\"> ขอเลขใหม่อีกครั้ง </a></td>";
                                echo "</tr>";
                            } 
                        
                        echo "</table>";
       
        $stmt = null;
        $conn = null;
                     }
                    
                    elseif (!empty($_GET)) {
                                    
                    include "../connect.php";  // Using database connection file here
                        $query = "SELECT *,projects_pre.cl , BplusData.ID as HID, statusReq.sid,employee2.name,employee2.lastname,employee2.id as EID
                                FROM (((projects_pre LEFT JOIN statusReq 
                                ON projects_pre.ap_status = statusReq.sid)
                                LEFT JOIN employee2 
                                ON projects_pre.employee_id_fk = employee2.id)
                                LEFT JOIN BplusData
                                ON projects_pre.cl = BplusData.ADDB_COMPANY)
                                where projects_pre.employee_id_fk = ".$_GET['uname']." AND projects_pre.ap_status <> 16 AND projects_pre.ap_status <> 13
                                ORDER BY projects_pre.ap_status DESC
                                  ";
                        $stmt = $conn->query( $query );
                            echo "<table class='table_h5' >
                            <tr>
                            <th>ออกรหัสโครงการ</th>
                            <th>มีรหัสโครงการแล้ว</th>
                            <th>โรงพยาบาล</th>
                            <th>ราคาต่อเครื่อง</th>
                            <th>จำนวน</th>
                            <th>ราคารวม VAT</th>
                            <th>ผู้รับผิดชอบ</th>
                            <th>สถานะ</th>
                            <th>Reject</th>
                            </tr>";

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo "<td style= width:7%;><a href=\"../sale_admin/reqNumber.php?ID=".iconv('TIS-620', 'UTF-8',$row['ID'])."&PID=".iconv('TIS-620', 'UTF-8',$row['funnel_id'])."&STA=".iconv('TIS-620', 'UTF-8',$row['sid'])."&PD=".iconv('TIS-620', 'UTF-8',$row['project_desc'])."&CL=".iconv('TIS-620', 'UTF-8',$row['cl'])."&UP=".iconv('TIS-620', 'UTF-8',$row['unitprice'])."&EMP=".iconv('TIS-620', 'UTF-8',$row['employee_id_fk'])."&UN=".iconv('TIS-620', 'UTF-8',$row['unitnum'])."&PV=".iconv('TIS-620', 'UTF-8',$row['pro_value'])."\"> ออกรหัสโครงการ </td>";
                                    echo "<td style= width:7%;><a href=\"../sale_admin/upNumber.php?ID=".iconv('TIS-620', 'UTF-8',$row['ID'])."&PID=".iconv('TIS-620', 'UTF-8',$row['funnel_id'])."&STA=".iconv('TIS-620', 'UTF-8',$row['sid'])." \"> อัพเดทเลขโครงการ </td>";
                                    echo "<td style= width:25%;>"
                                    .iconv('TIS-620', 'UTF-8',$row['cl'])." "."<br>".iconv('TIS-620', 'UTF-8',$row['project_desc']);
                                     "</td>";
                                    echo "<td style= width:8%;>". number_format($row['unitprice']) ."</td>";
                                    echo "<td style= width:8%;>". $row['unitnum'] ."</td>";
                                    echo "<td style= width:8%;>". number_format($row['pro_value']) ."</td>";
                                    echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row['name']) ." ". iconv('TIS-620', 'UTF-8',$row['lastname']) ."</td>";
                                    echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row['sinfo']) ."</td>";
                                    echo "<td style= width:5%;><a href=\"../sale_admin/reject.php?ID=".iconv('TIS-620', 'UTF-8',$row['ID'])."\"> Reject </a></td>";
                                echo "</tr>";
                            } 

                        echo "</table>";
        $stmt = null;
        $conn = null;
                    }
                    
                    
                    ?>
                    
                </div>
</div>
     <div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>  
 
</body>
</html> 

