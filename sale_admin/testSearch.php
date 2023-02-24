<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Contact Filter</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--Materialize css cdn use-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<script>
		document.onkeydown=function(evt){
			var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
			if(keyCode == 13)
			{
            //your function call here
            document.search.submit();
        }
    }
</script>

</head>

<body>
	<div class="container">
		<h1 class="center-align">
			Contact List
		</h1>
		<form name="search" action='userserch.php?' method="POST">
			<input name="search" type="text" id="serchBox" placeholder="Search Name">
		</form>
		<ul class="collection width-header" id="names">

			<li class="nameItem">

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
                        	echo "<table class='table_h' >
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

                        elseif (!empty($_GET)) {
                        	$query = "SELECT * , statusReq.sid,employee2.name,employee2.lastname,employee2.id as EID
								FROM ((projects_pre LEFT JOIN statusReq 
								ON projects_pre.ap_status = statusReq.sid)
								LEFT JOIN employee2 
								ON projects_pre.employee_id_fk = employee2.id)
								where cl = 'หม้อกุ้ง'
                                  ORDER BY projects_pre.ap_status DESC
                        	";
                        	$stmt = $conn->query( $query );
                        	echo "<table class='table_h' >
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
                        	echo "<a href='http://saintmed.dyndns.biz:10898/user/user.php?'> clear </a>	";
							$stmt = null;
$stmt2 = null;
$conn = null;
                        }   

                        ?>
                    </li>

                </ul>
            </div>
            <script src="../user/userjs.js"></script>
        </body>

        </html>