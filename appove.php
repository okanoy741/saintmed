<?php
include "head.php";
?>

<div class="grid1">

    <div class="banner1">
        <img class="logo" src="../img/saintmed_logo.png"></img>
    </div>
<p id ="headr2"> Requisition รอการ Appove </p>
                    <?php
                        include "connect.php";  // Using database connection file here
                        $query = "SELECT contact.company_Name,projects.project_code1, projects.ID, projects.project_desc, projects.qt_date, projects.tender_date, projects.flag_date, projects.result_date, projects.sign_date, projects.tender_code, projects.announ_code, projects.budget, projects.pro_value , projects.client_id_fk, projects.pcode, projects.date_created, projects.org_id_fk, projects.employee_id_fk, projects.waran, projects.onsite_within, projects.notes, projects.delidate, projects.spt_note, projects.delitime, projects.status, projects.modified_by, projects.modifiedDate, projects.createdDate, projects.unitprice, projects.unitnum, projects.employee, projects.cl, projects.kb_des, projects.kb_des2, projects.kb_value, projects.kb_value2, projects.req_id,statusReq.sid,statusReq.sinfo,projects.statusReq
                                  FROM (((req 
                                  LEFT JOIN projects ON req.project_id_fk = projects.ID) 
                                  LEFT JOIN contact ON projects.client_id_fk = contact.client_id_fk)
                                  LEFT JOIN statusReq ON req.status = statusReq.sid)
                                  WHERE projects.statusReq=11 
                                  GROUP BY projects.ID, projects.project_desc, projects.project_code1, projects.qt_date, projects.tender_date, projects.flag_date, projects.result_date, projects.sign_date, projects.tender_code, projects.announ_code, projects.budget, projects.pro_value, projects.client_id_fk, projects.pcode, projects.date_created, projects.org_id_fk, projects.employee_id_fk, projects.waran, projects.onsite_within, projects.notes, projects.delidate, projects.spt_note, projects.delitime, projects.status, projects.modified_by, projects.modifiedDate, projects.createdDate, projects.unitprice, projects.unitnum, projects.employee, projects.cl, projects.kb_des, projects.kb_des2, projects.kb_value, projects.kb_value2, projects.pcode, projects.req_id,contact.company_Name,statusReq.sid,statusReq.sinfo,projects.statusReq
                                  ORDER BY projects.ID ASC
                                  ";
                        $stmt = $conn->query( $query );

                        if( $conn->query( $query ) ){
                            if (empty($_GET)) {
                            echo "<table class='table_h' >
                            <tr>
                            <th>รหัสโครงการ</th>
                            <th>วันที่ในสัญญา</th>
                            <th>โรงพยาบาล</th>
                            <th>ประกาศ <br> ประกวดราคา</th>
                            <th>เลขที่สัญญา</th>
                            <th>งบกลาง</th>
                            <th>ราคาต่อเครื่อง</th>
                            <th>จำนวน</th>
                            <th>ราคารวม VAT</th>
                            <th>ส่งมอบ</th>
                            <th>REQ NO.</th>
                            <th></th>
                            </tr>";

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo "<td style= width:7%;><a href=\"viewAP_req.php?ID=".$row['ID']."&PID=".$row['project_code1']."&\">". $row['project_code1'] ."</td>";
                                    echo "<td style= width:8.5%;>". $row['sign_date'] ."</td>";

                                    echo "<td style= width:25%;><a href=\"appove.php\">"
                                    .$row['company_Name']."</a>"."<br>".$row['project_desc'];
                                     "</td>";

                                    echo "<td style= width:8.5%;>". $row['announ_code'] ."<br>".$row['tender_code']."</td>";
                                    echo "<td>". $row['pcode'] ."</td>";
                                    echo "<td style= width:6%;>". number_format($row['budget']) ."</td>";
                                    echo "<td>". number_format($row['unitprice']) ."</td>";
                                    echo "<td>". $row['unitnum'] ."</td>";
                                    echo "<td style= width:8%;>". number_format($row['pro_value']) ."</td>";
                                    echo "<td>". $row['delitime'] ."</td>";
                                    echo "<td>". $row['req_id'] ."</td>";
                                    echo "<td style= width:4%;><a href=\"viewAP_req.php?ID=".$row['ID']."&PID=".$row['project_code1']."&\"> View </a></td>";
                                echo "</tr>";
                            } 

                        echo "</table>";
                        }       
                        }
                                
                    ?>

                    <p id ="headr2"> รายการ Appove แล้ว</p>

                    <?php
                        include "connect.php";  // Using database connection file here
                        $query = "SELECT contact.company_Name,projects.project_code1, projects.ID, projects.project_desc, projects.qt_date, projects.tender_date, projects.flag_date, projects.result_date, projects.sign_date, projects.tender_code, projects.announ_code, projects.budget, projects.pro_value , projects.client_id_fk, projects.pcode, projects.date_created, projects.org_id_fk, projects.employee_id_fk, projects.waran, projects.onsite_within, projects.notes, projects.delidate, projects.spt_note, projects.delitime, projects.status, projects.modified_by, projects.modifiedDate, projects.createdDate, projects.unitprice, projects.unitnum, projects.employee, projects.cl, projects.kb_des, projects.kb_des2, projects.kb_value, projects.kb_value2, projects.req_id,statusReq.sid,statusReq.sinfo,req.appove,projects.statusReq
                                  FROM (((req 
                                  LEFT JOIN projects ON req.project_id_fk = projects.ID) 
                                  LEFT JOIN contact ON projects.client_id_fk = contact.client_id_fk)
                                  LEFT JOIN statusReq ON req.status = statusReq.sid)
                                  WHERE projects.statusReq=12
                                  GROUP BY projects.ID, projects.project_desc, projects.project_code1, projects.qt_date, projects.tender_date, projects.flag_date, projects.result_date, projects.sign_date, projects.tender_code, projects.announ_code, projects.budget, projects.pro_value, projects.client_id_fk, projects.pcode, projects.date_created, projects.org_id_fk, projects.employee_id_fk, projects.waran, projects.onsite_within, projects.notes, projects.delidate, projects.spt_note, projects.delitime, projects.status, projects.modified_by, projects.modifiedDate, projects.createdDate, projects.unitprice, projects.unitnum, projects.employee, projects.cl, projects.kb_des, projects.kb_des2, projects.kb_value, projects.kb_value2, projects.pcode, projects.req_id,contact.company_Name,statusReq.sid,statusReq.sinfo,req.appove,projects.statusReq
                                  ORDER BY projects.ID ASC
                                  ";
                        $stmt = $conn->query( $query );

                        if( $conn->query( $query ) ){
                            if (empty($_GET)) {
                            echo "<table class='table_h' >
                            <tr>
                            <th>รหัสโครงการ</th>
                            <th>วันที่ในสัญญา</th>
                            <th>โรงพยาบาล</th>
                            <th>ประกาศ <br> ประกวดราคา</th>
                            <th>เลขที่สัญญา</th>
                            <th>งบกลาง</th>
                            <th>ราคาต่อเครื่อง</th>
                            <th>จำนวน</th>
                            <th>ราคารวม VAT</th>
                            <th>ส่งมอบ</th>
                            <th>appove by</th>
                            <th></th>
                            </tr>";

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo "<td style= width:7%;><a href=\"viewAP1_req.php?ID=".$row['ID']."&PID=".$row['project_code1']."&\">". $row['project_code1'] ."</td>";
                                    echo "<td style= width:8.5%;>". $row['sign_date'] ."</td>";

                                    echo "<td style= width:25%;><a href=\"appove.php\">"
                                    .$row['company_Name']."</a>"."<br>".$row['project_desc'];
                                     "</td>";

                                    echo "<td style= width:8.5%;>". $row['announ_code'] ."<br>".$row['tender_code']."</td>";
                                    echo "<td>". $row['pcode'] ."</td>";
                                    echo "<td style= width:6%;>". number_format($row['budget']) ."</td>";
                                    echo "<td>". number_format($row['unitprice']) ."</td>";
                                    echo "<td>". $row['unitnum'] ."</td>";
                                    echo "<td style= width:8%;>". number_format($row['pro_value']) ."</td>";
                                    echo "<td>". $row['delitime'] ."</td>";
                                    echo "<td>". $row['appove'] ."</td>";
                                    echo "<td style= width:4%;><a href=\"viewAP1_req.php?ID=".$row['ID']."&PID=".$row['project_code1']."&\"> View </a></td>";
                                echo "</tr>";
                            } 

                        echo "</table>";
                        }       
                        }
                                
                    ?>
                </div>
</div>
     <div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>  
 
</body>
</html> 

