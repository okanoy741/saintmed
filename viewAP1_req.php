<?php
include "sale_admin/head.php";
?>
<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["user"]) ){
  header("location: chkA.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
  exit;
}
?>
<div class="grid1">

  <div class="banner1">
    <img class="logo" src="../img/saintmed_logo.png"><p>REQ.</p>
    <p><BR></p>
  </div> 
  <div class="side_nav">
    <?php
    if (empty($_GET)) { 
      header("Location: http://saintmed.dyndns.biz/sales/tender_list_am.asp?"); 
    }

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
                       $stmt = null;
                       echo "</div>

                       <p id ='headr'>Preview set สินค้า</p>
                       <table class='table_in'>
                       <tr>
                       <form action='previewAP.php?ID=".$_GET['ID']."&PID=".$_GET['PID']."' method='POST'>
                       <td id= itemNamet3>
                       <input  id ='code1' style= width:95%; type='text' name ='itemset1' list='itemName3'class='itemName' placeholder='Preview set สินค้า'  autofocus>
                       <datalist id = 'itemName3'> ";
                           // Using database connection file here
                       $query9 = "SELECT id,groupname FROM groupcode WHERE grouptype = 3 order by groupname";
                       $stmt9 = $conn2->query( $query9 );

                       while ($row9 = $stmt9->fetch(PDO::FETCH_ASSOC)){
                        echo iconv('TIS-620', 'UTF-8',"<option data-id='$row9[id]' value = '$row9[id]. $row9[groupname]'> </option>n)");
                      }
                      $stmt = null;
                      $stmt9 = null;

                      echo "</td>
                      <td><input class='btn_d' type='submit' value='Preview'></td>
                      </tr>
                      </table>
                      </form> ";

                      if(!empty($_GET['ITEM'])){
                        echo "<form action='inset_req5.php?ID=".$_GET['ID']."&PID=".$_GET['PID']."&ITEM=".$_GET['ITEM']."' method='POST' >";
                        echo " <div class='wrapper_preview'>";

                            // Using database connection file here
                        $query10 = "SELECT  groupcodeitem.*, groupcode.groupname,alloitm.ItemName
                        FROM ((groupcodeitem 
                          left join groupcode on  groupcodeitem.groupcode_id_fk = groupcode.id)
                        LEFT JOIN alloitm ON groupcodeitem.ItemCode = alloitm.ItemCode)
                        where groupcodeitem.groupcode_id_fk = ".$_GET['ITEM']." " ;
                        $stmt10 = $conn2->query( $query10 );

                        echo "<table class='table_in1'>
                        <tr>
                        <th>SET</th>
                        <th>Item code</th>
                        <th>Product</th>
                        </tr>
                        ";
                        while ($row10 = $stmt10->fetch(PDO::FETCH_ASSOC)){
                          echo iconv('TIS-620', 'UTF-8',"<td style= width:12%;>$row10[groupname] </td>");
                          echo "<td style= width:23%;>$row10[itemcode] </td>";
                          echo "<td>". iconv('TIS-620', 'UTF-8',$row10['ItemName']) ."</td>";
                          echo "</tr>";
                        }
                        echo "</table>";
                        echo "</div>";
                        echo "<input class='btn_d2' type='submit' value='เพิ่ม set'>";
                      }

                      $stmt10 = null;


                      echo "</form>

                      <table class='table_in'>
                      <tr>
                      <form action='inset_reqAP3.php?ID=".$_GET['ID']."&PID=".$_GET['PID']."' method='POST'>
                      <p id ='headr'>เพิ่ม-ลด สินค้า</p>


                      </td>

                      <td id= itemNamet>
                      <input  style= width:95%; type='text' name ='item1' list='itemName'class='itemName' placeholder='ชื่อสินค้า' >
                      <datalist id = 'itemName'>
                      <option type='text'>สินค้าไม่มี item code</option>n ";
                                // Using database connection file here
                      $query = "SELECT u_brand,itemName,itemCode FROM alloitm WHERE u_brand IS NOT NULL and u_brand <> ' ' and itemCode NOT LIKE 'DEM%' and itemCode NOT LIKE 'AS%' order by u_brand " ;
                      $stmt = $conn->query( $query );

                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo iconv('TIS-620', 'UTF-8',"<option value = '$row[itemCode]'> || $row[itemName]  </option>n)");
                      }
                      echo "</datalist>
                      </td>

                      <td><input type='number' name ='item2' placeholder='จำนวน'  style= width:95%; ></input></td>

                      <td>
                      <input  style= width:95%; type='number' name ='item3' class='prc' placeholder='ราคา'>
                      </td>

                      <td><input class='btn_d' type='submit' value='เพิ่ม'></td>



                      </table>
                      </form>
                      <p id ='headr'>สรุปและตรวจสอบรายการ</p> ";
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


                      $query = "SELECT req.ID,projects.ID as pid,projects.project_code1,req.unitnum ,alloitm.ItemName,alloitm.itemCode, req.unitnum, req.price ,req.description,req.itemName as itemName1
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
                            <p> AM Appove :". iconv('TIS-620', 'UTF-8',$row2['sinfo']) ." </p>
                            ";

                            if($row2['count_bm_appove'] <> 0 ){
                              echo "<p> BM Appove : Appove";
                            }
                            elseif($row2['count_bm_appove'] == 0 ){
                              echo "<p> BM Appove : In progress";
                            }

                            echo "
                            <p> สถานที่ส่งมอบ : ". iconv('TIS-620', 'UTF-8',$row2['location']) ."</p>
                            <p> วันที่ส่งมอบ :  ". date("d / m / Y", strtotime($row2['trans_date'])) ."</p>
                            <p> เงื่อนไขพิเศษ :". iconv('TIS-620', 'UTF-8',$row2['condition_id']) ." &nbsp; ". iconv('TIS-620', 'UTF-8',$row2['condition_info']) ."</p>
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
                            <th></th>
                            <th></th>
                            <th>อย.</th>
                            </tr>";

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                              echo " <form action='update_req3AP.php?ID=".$row['ID']."&PPID=".$row['pid']."&PID=". $_GET['PID']."&' method='POST'>";


                              echo "<td style= width:7%;>". iconv('TIS-620', 'UTF-8',$row['project_code1']) ."</td>";
                              echo "<td style= width:16%;>". $row['itemCode'] ."</td>";
                              echo "<td> <input  id='itemname1' type='text' name ='item4' value ='". iconv('TIS-620', 'UTF-8',$row['ItemName']) ." ' maxlength='255' >". iconv('TIS-620', 'UTF-8',$row['itemName1']) ." </td>";

                              echo "<td style= width:5%; ><input  id='itemname' type='text' name ='item5' value ='". number_format($row['unitnum']) ."'>". number_format($row['unitnum']) ."</td>";

                              echo "<td id='itemname2' style= width:10%;><input  id='itemname' type='text' name ='item6' value =''><br>". number_format($row['price']) ."</td>";

                              echo "<td style= width:5%;><input type='submit' value='บันทึก'></td>";

                              echo "<td style= width:5%;><a href=\"del_item2.php?ID=".$row['ID']."&PPID=".$row['pid']."&PID=". $_GET['PID']." \"> ลบ </td>";

                              $itemFDA = $row['itemCode'];
                              $queryFDA = "SELECT * FROM ALL_FDA_VIEW WHERE itemCode = '$itemFDA' ";
                              $stmtFDA = $conn3->query( $queryFDA );
                              while ($rowFDA = $stmtFDA->fetch(PDO::FETCH_ASSOC)){
                                switch ($rowFDA['FDA_STATUS']) {
                                  case ("HAVE      ") : echo "<td style= width:4%;> มี <br> (".$rowFDA['expiration_status'].") </td>";
                                  break;
                                  case ("NOT       ") : echo "<td style= width:4%; class = 'red'> สินค้าเลิกผลิต </td>";
                                  break;
                                  case $rowFDA['FDA_STATUS'] === NULL : echo "<td style= width:4%; class = 'red'> สินค้าเลิกผลิต </td>";
                                  break;
                                }
                              }

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

                            echo "</div><br>";
                            echo "<a class='btn-a' ID='create_excel' >Export Excel</a>";




                            echo "<br><br><br><br><br><br><br>"; 
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

