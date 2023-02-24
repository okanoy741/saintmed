<?php
include "head.php";
?>
<div class="grid3">
    <p id ="headr2">รายการขออนุมัติเลขโครงการ / รายการทำ req. เรียบร้อยแล้ว</p>
    <form name="search" action='../sale_admin/search.php?' method="POST">

        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input name="search" type="text" id="serchBox" placeholder="---Search จากชื่อพนักงาน---"> <br><br>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href='../sale_admin/chk_projects.php'> clear filter</a> <br>
    </form>
</div>
<div class="grid3">
    <?php
    include "../connect.php";  // Using database connection file here
    if (empty($_GET)) {
        $query = "SELECT * , statusReq.sid,employee2.name,employee2.lastname,employee2.id as EID
        FROM ((projects_pre LEFT JOIN statusReq 
            ON projects_pre.ap_status = statusReq.sid)
        LEFT JOIN employee2 
        ON projects_pre.employee_id_fk = employee2.id)
        where ap_status <> 16 AND ap_status <> 13 OR ap_status IS NULL 
        ORDER BY projects_pre.ap_status DESC
        ";

        $stmt = $conn->query( $query );

        echo "<ul id='nav'>
        <li><a href='#'>รายการขออนุมัติเลขโครงการ</a>
        <section>
        <p>";


        echo "
        <table class='table_h6' >
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
        </tr>
        ";
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

        echo "</table>
        </p>
        </section>
        </li>
        ";

        /*-------รายการได้รับเลขแล้ว---------*/
        $query2 = "SELECT projects_pre.* , statusReq.sid, projects.project_code1 as fid, statusReq.sinfo,employee2.name,employee2.lastname
        FROM (((projects_pre LEFT JOIN statusReq 
            ON projects_pre.ap_status = statusReq.sid)
        LEFT JOIN projects 
        ON projects_pre.funnel_id = projects.funnel_id)
        LEFT JOIN employee2 
        ON projects_pre.employee_id_fk = employee2.id)
        where ap_status = 16 
        ORDER BY projects_pre.ID ASC
        ";
        $stmt2 = $conn->query( $query2 );

        echo "<li><a href='#'>รายการได้รับเลขแล้ว</a>
        <section>
        <p>
        <table class='table_h5' >
        <tr>
        <th>รหัสโครงการ</th>
        <th>โรงพยาบาล</th>
        <th>ราคาต่อเครื่อง</th>
        <th>จำนวน</th>
        <th>ราคารวม VAT</th>
        <th>ผู้รับผิดชอบ</th>
        <th>สถานะ</th>
        </tr>";

        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
            echo "<td style= width:7%;>". $row2['fid'] ."</td>";
            echo "<td style= width:25%;>"
            .iconv('TIS-620', 'UTF-8',$row2['cl'])." "."<br>".iconv('TIS-620', 'UTF-8',$row2['project_desc']);
            "</td>";
            echo "<td style= width:8%;>". number_format($row2['unitprice']) ."</td>";
            echo "<td style= width:8%;>". $row2['unitnum'] ."</td>";
            echo "<td style= width:8%;>". number_format($row2['pro_value']) ."</td>";
            echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row2['name']) ." ". iconv('TIS-620', 'UTF-8',$row2['lastname']) ."</td>";
            echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row2['sinfo']) ."</td>";
            echo "</tr>";
        } 

        echo "</table></p>
        </section>
        </li>";

        /*-------รายการการยกเลิกโครงการ---------*/
        $query3 = "SELECT projects_pre.* , statusReq.sid, projects.project_code1 as fid, statusReq.sinfo,employee2.name,employee2.lastname
        FROM (((projects_pre LEFT JOIN statusReq 
            ON projects_pre.ap_status = statusReq.sid)
        LEFT JOIN projects 
        ON projects_pre.funnel_id = projects.funnel_id)
        LEFT JOIN employee2 
        ON projects_pre.employee_id_fk = employee2.id)
        where ap_status = 13 
        ORDER BY projects_pre.ID ASC
        ";
        $stmt3 = $conn->query( $query3 );

        echo "<li><a href='#'>รายการการยกเลิกโครงการ</a>
        <section>
        <p>
        <table class='table_h5' >
        <tr>
        <th>โรงพยาบาล</th>
        <th>ราคาต่อเครื่อง</th>
        <th>จำนวน</th>
        <th>ราคารวม VAT</th>
        <th>สถานะ</th>
        <th>ผู้รับผิดชอบ</th>
        <th>Reject</th>
        </tr>";

        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
            echo "<td style= width:20%;>"
            .iconv('TIS-620', 'UTF-8',$row3['cl'])." "."<br>".iconv('TIS-620', 'UTF-8',$row3['project_desc']);
            "</td>";
            echo "<td style= width:8%;>". number_format($row3['unitprice']) ."</td>";
            echo "<td style= width:8%;>". $row3['unitnum'] ."</td>";
            echo "<td style= width:8%;>". number_format($row3['pro_value']) ."</td>";
            echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row3['name']) ." ". iconv('TIS-620', 'UTF-8',$row3['lastname']) ."</td>";
            echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row3['sinfo']) ."</td>";
            echo "<td style= width:5%;><a href=\"../sale_admin/return.php?ID=".iconv('TIS-620', 'UTF-8',$row3['ID'])."\"> ขอเลขอีกครั้ง </a></td>";
            echo "</tr>";
        } 

        echo "</table></p>
        </section>
        </li>";

        /*-------sale ทำส่ง req แล้ว---------*/
        $query4 = "select projects.*,projects.ID as IDP,statusReq.sid,statusReq.sinfo,employee2.ID,employee2.name,employee2.lastname,BplusData.AR_NAME
        FROM (((projects LEFT JOIN statusReq 
        ON projects.statusReq = statusReq.sid)
        LEFT JOIN employee2 
        ON projects.employee_id_fk = employee2.id)
        LEFT JOIN BplusData
        ON projects.client_id_fk = BplusData.ID)
        where projects.statusReq = 12 
        ORDER BY projects.ID DESC
        ";
        $stmt4 = $conn->query( $query4 );

        echo "<li><a href='#'>sale ทำ req. ส่งแล้ว</a>
        <section>
        <p>
        <table class='table_h5' >
        <tr>
        <th>เลขที่โครงการ</th>
        <th>โรงพยาบาล</th>
        <th>ราคาต่อเครื่อง</th>
        <th>จำนวน</th>
        <th>ราคารวม VAT</th>
        <th>ผู้รับผิดชอบ</th>
        <th>สถานะ</th>
        </tr>";

        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
            echo "<td style= width:5%;><a href=\"../viewAP1_req.php?ID=".iconv('TIS-620', 'UTF-8',$row4['IDP'])."&PID=".iconv('TIS-620', 'UTF-8',$row4['project_code1'])."\"> ".$row4['project_code1']." </a></td>";
            echo "<td style= width:20%;>"
            .iconv('TIS-620', 'UTF-8',$row4['AR_NAME'])." "."<br>".iconv('TIS-620', 'UTF-8',$row4['project_desc']);
            "</td>";
            echo "<td style= width:8%;>". number_format($row4['unitprice']) ."</td>";
            echo "<td style= width:8%;>". $row4['unitnum'] ."</td>";
            echo "<td style= width:8%;>". number_format($row4['pro_value']) ."</td>";
            echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row4['name']) ." ". iconv('TIS-620', 'UTF-8',$row4['lastname']) ."</td>";
            echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row4['sinfo']) ."</td>";
            echo "</tr>";
        } 

        echo "</table></p>
        </section>
        </li>";

        echo "</ul>";
    }

    /*-------use fileter name---------*/
    elseif (!empty($_GET)) {
            $query = "SELECT * , statusReq.sid,employee2.name,employee2.lastname,employee2.id as EID
        FROM ((projects_pre LEFT JOIN statusReq 
            ON projects_pre.ap_status = statusReq.sid)
        LEFT JOIN employee2 
        ON projects_pre.employee_id_fk = employee2.id)
        where projects_pre.employee_id_fk = ".$_GET['uname']." AND ap_status <> 16 AND ap_status <> 13 OR ap_status IS NULL 
        ORDER BY projects_pre.ap_status DESC
        ";

        $stmt = $conn->query( $query );

        echo "<ul id='nav'>
        <li><a href='#'>รายการขออนุมัติเลขโครงการ</a>
        <section>
        <p>";


        echo "
        <table class='table_h6' >
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
        </tr>
        ";
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

        echo "</table>
        </p>
        </section>
        </li>
        ";

        /*-------รายการได้รับเลขแล้ว---------*/
        $query2 = "SELECT projects_pre.* , statusReq.sid, projects.project_code1 as fid, statusReq.sinfo,employee2.name,employee2.lastname
        FROM (((projects_pre LEFT JOIN statusReq 
            ON projects_pre.ap_status = statusReq.sid)
        LEFT JOIN projects 
        ON projects_pre.funnel_id = projects.funnel_id)
        LEFT JOIN employee2 
        ON projects_pre.employee_id_fk = employee2.id)
        where projects_pre.employee_id_fk = ".$_GET['uname']." AND ap_status = 16 
        ORDER BY projects_pre.ID ASC
        ";
        $stmt2 = $conn->query( $query2 );

        echo "<li><a href='#'>รายการได้รับเลขแล้ว</a>
        <section>
        <p>
        <table class='table_h5' >
        <tr>
        <th>รหัสโครงการ</th>
        <th>โรงพยาบาล</th>
        <th>ราคาต่อเครื่อง</th>
        <th>จำนวน</th>
        <th>ราคารวม VAT</th>
        <th>ผู้รับผิดชอบ</th>
        <th>สถานะ</th>
        </tr>";

        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
            echo "<td style= width:7%;>". $row2['fid'] ."</td>";
            echo "<td style= width:25%;>"
            .iconv('TIS-620', 'UTF-8',$row2['cl'])." "."<br>".iconv('TIS-620', 'UTF-8',$row2['project_desc']);
            "</td>";
            echo "<td style= width:8%;>". number_format($row2['unitprice']) ."</td>";
            echo "<td style= width:8%;>". $row2['unitnum'] ."</td>";
            echo "<td style= width:8%;>". number_format($row2['pro_value']) ."</td>";
            echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row2['name']) ." ". iconv('TIS-620', 'UTF-8',$row2['lastname']) ."</td>";
            echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row2['sinfo']) ."</td>";
            echo "</tr>";
        } 

        echo "</table></p>
        </section>
        </li>";

        /*-------รายการการยกเลิกโครงการ---------*/
        $query3 = "SELECT projects_pre.* , statusReq.sid, projects.project_code1 as fid, statusReq.sinfo,employee2.name,employee2.lastname
        FROM (((projects_pre LEFT JOIN statusReq 
            ON projects_pre.ap_status = statusReq.sid)
        LEFT JOIN projects 
        ON projects_pre.funnel_id = projects.funnel_id)
        LEFT JOIN employee2 
        ON projects_pre.employee_id_fk = employee2.id)
        where projects_pre.employee_id_fk = ".$_GET['uname']." AND ap_status = 13 
        ORDER BY projects_pre.ID ASC
        ";
        $stmt3 = $conn->query( $query3 );

        echo "<li><a href='#'>รายการการยกเลิกโครงการ</a>
        <section>
        <p>
        <table class='table_h5' >
        <tr>
        <th>โรงพยาบาล</th>
        <th>ราคาต่อเครื่อง</th>
        <th>จำนวน</th>
        <th>ราคารวม VAT</th>
        <th>สถานะ</th>
        <th>ผู้รับผิดชอบ</th>
        <th>Reject</th>
        </tr>";

        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
            echo "<td style= width:20%;>"
            .iconv('TIS-620', 'UTF-8',$row3['cl'])." "."<br>".iconv('TIS-620', 'UTF-8',$row3['project_desc']);
            "</td>";
            echo "<td style= width:8%;>". number_format($row3['unitprice']) ."</td>";
            echo "<td style= width:8%;>". $row3['unitnum'] ."</td>";
            echo "<td style= width:8%;>". number_format($row3['pro_value']) ."</td>";
            echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row3['name']) ." ". iconv('TIS-620', 'UTF-8',$row3['lastname']) ."</td>";
            echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row3['sinfo']) ."</td>";
            echo "<td style= width:5%;><a href=\"../sale_admin/return.php?ID=".iconv('TIS-620', 'UTF-8',$row3['ID'])."\"> ขอเลขอีกครั้ง </a></td>";
            echo "</tr>";
        } 

        echo "</table></p>
        </section>
        </li>";

        /*-------sale ทำส่ง req แล้ว---------*/
        $query4 = "select projects.*,projects.ID as IDP,statusReq.sid,statusReq.sinfo,employee2.ID,employee2.name,employee2.lastname,BplusData.AR_NAME
        FROM (((projects LEFT JOIN statusReq 
        ON projects.statusReq = statusReq.sid)
        LEFT JOIN employee2 
        ON projects.employee_id_fk = employee2.id)
        LEFT JOIN BplusData
        ON projects.client_id_fk = BplusData.ID)
        where projects.employee_id_fk = ".$_GET['uname']." AND projects.statusReq = 12 
        ORDER BY projects.ID DESC
        ";
        $stmt4 = $conn->query( $query4 );

        echo "<li><a href='#'>sale ทำ req. ส่งแล้ว</a>
        <section>
        <p>
        <table class='table_h5' >
        <tr>
        <th>เลขที่โครงการ</th>
        <th>โรงพยาบาล</th>
        <th>ราคาต่อเครื่อง</th>
        <th>จำนวน</th>
        <th>ราคารวม VAT</th>
        <th>ผู้รับผิดชอบ</th>
        <th>สถานะ</th>
        </tr>";

        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
            echo "<td style= width:5%;><a href=\"../viewAP1_req.php?ID=".iconv('TIS-620', 'UTF-8',$row4['IDP'])."&PID=".iconv('TIS-620', 'UTF-8',$row4['project_code1'])."\"> ".$row4['project_code1']." </a></td>";
            echo "<td style= width:20%;>"
            .iconv('TIS-620', 'UTF-8',$row4['AR_NAME'])." "."<br>".iconv('TIS-620', 'UTF-8',$row4['project_desc']);
            "</td>";
            echo "<td style= width:8%;>". number_format($row4['unitprice']) ."</td>";
            echo "<td style= width:8%;>". $row4['unitnum'] ."</td>";
            echo "<td style= width:8%;>". number_format($row4['pro_value']) ."</td>";
            echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row4['name']) ." ". iconv('TIS-620', 'UTF-8',$row4['lastname']) ."</td>";
            echo "<td style= width:5%;>". iconv('TIS-620', 'UTF-8',$row4['sinfo']) ."</td>";
            echo "</tr>";
        } 

        echo "</table></p>
        </section>
        </li>";

        echo "</ul>";
    }
    ?>
</div>

<script> 


    $(document).ready(function () {

        $('#nav').children('li').first().children('a').addClass('active')
        .next().addClass('is-open').show();

        $('#nav').on('click', 'li > a', function() {

            if (!$(this).hasClass('active')) {

                $('#nav .is-open').removeClass('is-open').hide();
                $(this).next().toggleClass('is-open').toggle();

                $('#nav').find('.active').removeClass('active');
                $(this).addClass('active');
            } else {
                $('#nav .is-open').removeClass('is-open').hide();
                $(this).removeClass('active');
            }
        });
    });


</script> 