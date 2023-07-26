<?php
include "head.php";
?>
<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["user"]) ){
  header("location: chkB.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
  exit;
}
?>
<div class="grid1">

  <div class="banner1">
    <img class="logo" src="../img/saintmed_logo.png"><p>REQ.</p>
    <p><BR></p>
  </div> 
  <?php
     require_once "connect.php";  // Using database connection file here
     if (empty($_GET)) { 
      header("Location: http://saintmed.dyndns.biz/sales/tender_list_am.asp?"); 
    }

    echo "
    
    <p id ='headr'>สรุปและตรวจสอบรายการ</p> ";

     echo "<div class='side_nav'>";
    
    if (empty($_GET['PID']) || empty($_GET['ID'])) { 
      $message = "กรุณา! ขอเลขที่รหัสโครงการก่อน";
      echo "<script type='text/javascript'>alert('$message');</script>";
      header("Refresh:1; url=http://saintmed.dyndns.biz/sales/tender_list_sales.asp?"); 
    }

    elseif (!empty($_GET['PID'])){

                        require_once "connect.php";  // Using database connection file here
                        $query = "select TOP 1 *,statusReq.sid,statusReq.sinfo,employee2.ID,employee2.name,employee2.lastname
                        FROM (((projects LEFT JOIN statusReq 
                        ON projects.statusReq = statusReq.sid)
                        LEFT JOIN employee2 
                        ON projects.employee_id_fk = employee2.id)
                        LEFT JOIN BplusData
                        ON projects.client_id_fk = BplusData.ID)
                        where projects.ID = ".$_GET['ID']."
                        ";

                        $stmt = $conn->query( $query );
                        if( $conn->query( $query ) ){
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo "<table class='table_show' ID='all_p'>
                            <tr>
                            <th>รหัสโครงการ</th>
                            <td><h2>".iconv('TIS-620', 'UTF-8',$row['project_code1'])."</h2></td>
                            </tr><tr>
                            <th>ประกาศลงวันที่</th>
                            <td> ". date("d-m-Y", strtotime($row['tender_date'])) ."</td>
                            </tr>
                            <tr>
                            <th>วันที่เปิดซอง</th>
                            <td>". date("d-m-Y", strtotime($row['qt_date'])) ."</td>
                            </tr>
                            <tr>
                            <th>เรียกทำสัญญา</th>
                            <td>". date("d-m-Y", strtotime($row['sign_date'])) ."</td>
                            </tr>
                            <tr>
                            <th>โรงพยาบาล</th>
                            <td>". iconv('TIS-620', 'UTF-8',$row['AR_NAME']) ."</td>
                            </tr><tr>
                            <th>เลขที่ประกาศ</th>
                            <td>". iconv('TIS-620', 'UTF-8',$row['announ_code']) ." </td>
                            </tr>
                            <tr>
                            <th>เอกสารประกวด/สอบราคาซื้อ</th>
                            <td>". iconv('TIS-620', 'UTF-8',$row['tender_code']) ." </td>
                            </tr><tr>
                            <th>เลขที่สัญญาซื้อขาย</th>
                            <td>". iconv('TIS-620', 'UTF-8',$row['pcode']) ." </td>
                            </tr><tr>
                            <th>งบกลาง</th>
                            <td>". number_format($row['budget']) . " บาท </td>
                            </tr><tr>
                            <th>เครื่อง/รุ่น</th>
                            <td>". iconv('TIS-620', 'UTF-8',$row['project_desc']) ." </td>
                            </tr><tr>
                            <th>จำนวน(เครื่อง)</th>
                            <td>". $row['unitnum'] ." </td>
                            </tr><tr>
                            <th>ราคาต่อเครื่อง</th>
                            <td>". number_format($row['unitprice']) ." บาท</td>
                            </tr>
                            <tr>
                            <th>ราคาที่ได้งาน รวม Vat</th>
                            <td>". number_format($row['pro_value']) ." บาท</td>
                            </tr>
                            <tr>
                            <th>กำหนดส่งมอบ</th>
                            <td>". $row['delidate'] ." <br> ". "หรือภายใน" ."  <br> ". $row['delitime'] ." ". "วัน" ." </td>
                            </tr>
                            <tr>
                            <th>การรับประกัน</th>
                            <td>". $row['waran'] ." ปี ". "<br>หรือเข้าซ่อมภายใน " ." <br> ". $row['onsite_within'] ."". " วัน" ." </td>
                            </tr>
                            <tr>
                            <th>ผู้รับผิดชอบ</th>
                            <td>". iconv('TIS-620', 'UTF-8',$row['name']) ." ". iconv('TIS-620', 'UTF-8',$row['lastname']) ." </td>
                            </tr>
                            <tr>
                            <th>สถานะของงาน </th>
                            <td>". iconv('TIS-620', 'UTF-8',$row['sinfo']) ."</td>
                            </tr>
                            <tr>
                            <th>หมายเหตุ </th>
                            <td>". iconv('TIS-620', 'UTF-8',$row['info']) ." </textarea></td>
                            </tr>
                            ";    

                            echo "</tr>";
                          } 


                          echo "</table>";
                        }
                      }   
                      $stmt = null;
                      echo "</div>";
                    // Using database connection file here
    $query2 = "select TOP 1 *,statusReq.sid,statusReq.sinfo,employee2.ID,employee2.name,employee2.lastname
    FROM (((projects LEFT JOIN statusReq 
    ON projects.statusReq = statusReq.sid)
    LEFT JOIN employee2 
    ON projects.employee_id_fk = employee2.id)
    LEFT JOIN BplusData
    ON projects.client_id_fk = BplusData.ID)
    where projects.ID = ".$_GET['ID']."
    ";
    $stmt2 = $conn->query( $query2 );


    $query = "SELECT req.ID,projects.ID as pid,projects.project_code1,req.unitnum ,alloitm.ItemName,alloitm.itemCode, req.unitnum, req.price ,req.description,req.itemName as itemName1,alloitm.u_bm
    FROM ((req 
      INNER JOIN projects ON req.project_id_fk = projects.ID) 
    LEFT JOIN alloitm ON req.ItemCode = alloitm.ItemCode)
    WHERE req.project_id_fk = ".$_GET['ID']." AND req.unitnum IS NOT NULL  
    order by req.price DESC
    ";
    $stmt = $conn->query( $query );

    $query3 = "SELECT  req.project_id_fk ,sum(req.price) as price,((price*100)/107) as pitem,(price-pitem) as vat
    FROM req 
    WHERE req.project_id_fk = ".$_GET['ID']." group by req.project_id_fk 
    ";
    $stmt3 = $conn->query( $query3 );

    if( $conn->query( $query ) ){
      if($_GET['ID']){
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
          echo "<h2 id='name-p' > ชื่องบ : ". iconv('TIS-620', 'UTF-8',$row2['name_p']) ." </h2>
          <p> Status REQ. : ". iconv('TIS-620', 'UTF-8',$row2['sinfo']) ." </p>
          <p> AM Approve :". iconv('TIS-620', 'UTF-8',$row2['sinfo']) ." </p>
          ";

          if($row2['count_bm_appove'] <> 0 ){
            echo "<p> BM Approve : Approve";
          }
          elseif($row2['count_bm_appove'] == 0 ){
            echo "<p> BM Approve : In progress";
          }

          echo "
          <p> สถานที่ส่งมอบ : ". iconv('TIS-620', 'UTF-8',$row2['location']) ."</p>
          <p> วันที่ส่งมอบ :  ". date("d / m / Y", strtotime($row2['trans_date'])) ."</p>
          <p> เงื่อนไขพิเศษ :". iconv('TIS-620', 'UTF-8',$row2['condition_id']) ." &nbsp; ". iconv('TIS-620', 'UTF-8',$row2['condition_info']) ."</p>
          <p> สาเหตุที่ไม่ทำ REQ. ใน 14 วัน : ". iconv('TIS-620', 'UTF-8',$row2['deadLine']) ." </p>
          ";

          echo "<table class='table_h' id='p_info'>

          <tr class='t_head'>
          <td><h2> ".$row2['project_code1']."</h2> <br><br></td>
          <td><h2> ".iconv('TIS-620', 'UTF-8',$row2['name_p'])."</h2> <br><br></td>
          <td> <br>". iconv('TIS-620', 'UTF-8',$row2['AR_NAME']) ." <br><br> กำหนดส่งมอบ ". $row2['delidate'] ."  ". "หรือภายใน" ."   ". $row2['delitime'] ." ". "วัน" ." <br><br></td>

          <td> ราคาที่ได้งาน <br>". number_format($row2['pro_value']) ." บาท</td>

          <td> เอกสารประกวด/สอบราคาซื้อ <br>". $row2['tender_code'] ." </td>

          <td> ผู้รับผิดชอบ <br>". iconv('TIS-620', 'UTF-8',$row2['name']) ." ". iconv('TIS-620', 'UTF-8',$row2['lastname']) ." </td>
          <td> สถานที่และเวลาส่งมอบ( sale)<br>". iconv('TIS-620', 'UTF-8',$row2['location']) ." <br> วันที่ ". date("d / m / Y", strtotime($row2['trans_date'])) ." </td>
          </tr>

          <tr>
          <th>รหัสโครงการ</th>
          <th>Code สินค้า</th>
          <th>รายการ Requisition </th>
          <th>จำนวน</th>
          <th>ราคา:หน่วย</th>
          <th>BM</th>
          </tr>";

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo " <form action='update_req3AP.php?ID=".$row['ID']."&PPID=".$row['pid']."&PID=". $_GET['PID']."&' method='POST'>";


            echo "<td style= width:7%;>". iconv('TIS-620', 'UTF-8',$row['project_code1']) ."</td>";
            echo "<td style= width:16%;>". $row['itemCode'] ."</td>";
            echo "<td> ". iconv('TIS-620', 'UTF-8',$row['ItemName']) ."". iconv('TIS-620', 'UTF-8',$row['itemName1']) ."";

            echo "<td style= width:5%; >". number_format($row['unitnum']) ."</td>";

            echo "<td id='itemname2' style= width:10%;>". number_format($row['price']) ."</td>";
            echo "<td style= width:7%;>". iconv('TIS-620', 'UTF-8',$row['u_bm']) ."</td>";

            echo "</tr>";
            echo "</form>";
          }
          while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
           echo "
           <br>
           <tr>
           <th>ราคา</th>
           <td>". number_format($row3['pitem'],2) ."</td>
           </tr>
           <tr>
           <th>VAT 7%</th>
           <td>". number_format($row3['vat'],2) ."</td>
           </tr>
           <tr>
           <th>ราคาสุทธิ</th>
           <td>". number_format($row3['price'],2) ."</td>
           </tr>

           <tr class='t_head'>
           <td> เอกสารส่งมอบ : ".iconv('TIS-620', 'UTF-8',$row2['h_sheet'])." <br><br></td>
           <td> หมายเหตุ : ".iconv('TIS-620', 'UTF-8',$row2['info'])."<br><br></td>
           </tr>

           ";}}

           echo "</table>";

           echo "<div class = 'w-uplist'> <h2>เอกสารประกอบงานขาย</h2>";
           echo "<div class = 'uplist'>";
           $path_parts = "uploads/". $_GET["PID"] ." ";
           if(!is_dir("uploads/". $_GET["PID"] ."/")){

           }
           elseif(is_dir("uploads/". $_GET["PID"] ."/")){
            if ($handle = opendir($path_parts)) {
              while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                  echo "<a href= '../uploads/". $_GET["PID"] ."/$entry' target='_blank'>- $entry<br></a>";
                }
              }
              closedir($handle);
            }
          }
          echo "</div>";
          echo "</div>";

          echo " <form action='reject.php?ID=".$_GET['ID']."&PID=".$_GET['PID']."' method='POST'>";
          $query = "SELECT projects.ID ,projects.info ,projects.h_sheet
          FROM projects 
          WHERE projects.ID = ".$_GET['ID']." 
          ";
          $stmt = $conn->query( $query );
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<textarea id='remark' name='item11' placeholder='เอกสารส่งมอบ' disabled>" .iconv('TIS-620', 'UTF-8',$row['h_sheet']) ."</textarea>";
            echo "<textarea id='remark' name='item7' placeholder='หมายเหตุ' maxlength='255'>" .iconv('TIS-620', 'UTF-8',$row['info']) ."</textarea>";
          }

          echo "<div class='wrap-btn'>";
          echo "<div class='btn-a'> <a href=\"sendAPbm_req.php?ID=".$_GET['ID']."&PID=".$_GET['PID']." \">Appove</a></div>";
          echo "<a href=\"reject.php?ID=".$_GET['ID']."&PID=".$_GET['PID']." \"><input class='btn_req' type='submit' value='Reject'></a>";
          echo "<a class='btn-a' ID='create_excel' >Export to Excel</a>";
          echo "</div>";


          $query2 = "SELECT TOP 6 req.project_id_fk,projects.info,FORMAT (edit_log.date1, 'dd-MM-yy ') as date1,edit_log.edit_log
          FROM ((req 
            INNER JOIN projects ON req.project_id_fk = projects.ID)
          INNER JOIN edit_log ON req.project_id_fk = edit_log.project_id_fk)  
          WHERE req.project_id_fk = ".$_GET['ID']." 
          GROUP BY req.project_id_fk,projects.info, edit_log.edit_log, edit_log.date1,edit_log.ID
          ORDER BY edit_log.ID DESC
          ";
          $stmt2 = $conn->query( $query2 );
          echo "<div class='panel-wrapper'>";
          echo "<a href='#show' class='show btn' id='show'>Show Log</a>";
          echo "<a href='#hide' class='hide btn' id='hide'>Hide Log</a>";
          echo "<div class='panel'>";

          echo "<table class='table_h1'>
          <tr>
          <th>Log แก้ไข</th>
          </tr>";
          while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
           echo "<td>". $row2['edit_log'] ." วันที่ ". $row2['date1'] ." </td>";
           echo "</tr>";
         } echo "</table>";
         echo "</div>";
         echo "<div class='fade'></div>";
         echo "</div>"; 
       } 
     }

     $stmt = null;
     $stmt2 = null;
     $conn = null;
     ?>


   </div>

 </div>
 <div class="footer">ลิขสิทธิ์ถูกต้อง © 2021 บริษัท เซนต์เมด จำกัด (มหาชน)</div>
 <script> 

   $(document).ready(function () {
    $('#create_excel').click(function(){
      $("#p_info").table2excel({ 
        filename: "p_info.xls" 
      });   
    }); 
  }); 

</script> 
</body>
</html> 

