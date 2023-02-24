<?php
include "head.php";
?>
<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["user"]) ){
  header("location: chk.php?ID=". $_GET['ID']."&PID=". $_GET['PID']);
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
    if (empty($_GET['PID']) || empty($_GET['ID'])) { 
      $message = "กรุณา! ขอเลขที่รหัสโครงการก่อน";
      echo "<script type='text/javascript'>alert('$message');</script>";
      header("Refresh:1; url=http://saintmed.dyndns.biz/sales/tender_list_sales.asp?"); 
    }
    elseif (!empty($_GET['PID'])){

                        require_once "connect.php";  // Using database connection file here
                        $query = "select TOP 1 *,statusReq.sid,statusReq.sinfo,employee2.ID,employee2.name,employee2.lastname
                        FROM (((projects LEFT JOIN statusReq 
                        ON projects.status = statusReq.sid)
                        LEFT JOIN employee2 
                        ON projects.employee_id_fk = employee2.id)
                        LEFT JOIN BplusData
                        ON projects.client_id_fk = BplusData.ID)
                        where projects.ID = ".$_GET['ID']."
                        ";
                        $stmt = $conn->query( $query );
                        if( $conn->query( $query ) ){
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                            if($row['statusReq'] != 12){
                              echo "<table class='table_show' ID='all_p'>
                              <tr>
                              <th>รหัสโครงการ</th>
                              <td><h2>".iconv('TIS-620', 'UTF-8',$row['project_code1']) ."</h2></td>
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

                            elseif($row['statusReq'] = 12){
                              $stmt = null;
                              $conn = null;
                              $message = "เลขที่รหัสโครงการถูก appove แลัว (หากต้องการแก้ไข ให้แจ้ง AM ทำการ Reject เพื่อแก้ไข)";
                              echo "<script type='text/javascript'>alert('$message');</script>";
                              header("Refresh:0; url= view_req.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." ");
                            }
                          }

                          $stmt = null;
                          echo "</table>";
                        }
                    }            
                    echo "</div>
                    
                    <p id ='headr'>Preview set สินค้า</p>
                    <table class='table_in'>
                    <tr>
                    <form action='preview.php?ID=".$_GET['ID']."&PID=".$_GET['PID']." ' method='POST'>
                    <td id= itemNamet3>
                    <input  id ='code1' style= width:95%; type='text' name ='itemset1' list='itemName3'class='itemName' placeholder='Preview set สินค้า' >
                    <datalist id = 'itemName3'>";
                    /*php query*/
                    $query9 = "SELECT id,groupname FROM groupcode WHERE grouptype = 3 order by groupname";
                    $stmt9 = $conn2->query( $query9 );

                    while ($row9 = $stmt9->fetch(PDO::FETCH_ASSOC)){
                      echo iconv('TIS-620', 'UTF-8',"<option data-id='$row9[id]' value = '$row9[id]. $row9[groupname]'> </option>n)");
                    }
                    $stmt = null;
                    $stmt9 = null;

                    /*php query end*/
                    echo " </td>
                    <td><input class='btn_d' type='submit' value='Preview'></td>
                    </tr>
                    </table>
                    </form>";

                    if(!empty($_GET['ITEM'])){
                      echo "<form action='inset_req4.php?ID=".$_GET['ID']."&PID=".$_GET['PID']."&ITEM=".$_GET['ITEM']."&NUM=".$_GET['NUM']."' method='POST' >";
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
                      $stmt10 = null;
                      $conn2 = null;
                      echo "</table>";
                      echo "</div>";
                      echo "<input class='btn_d2' type='submit' value='เพิ่ม set'>";
                    }




                    echo " </form>

                    <table class='table_in'>
                    <tr>
                    <form action='inset_req3.php?ID=".$_GET['ID']."&PID=".$_GET['PID']."' method='POST' >
                    <p id ='headr'>เพิ่มสินค้า</p>

                    <td id= itemNamet>
                    <input  style= width:95%; type='text' name ='item1' list='itemName'class='itemName' placeholder='ชื่อสินค้า' >
                    <datalist id = 'itemName'>
                    <option type='text'>สินค้าไม่มี item code</option>n";

                              // Using database connection file here
                    $query = "SELECT u_brand,itemName,itemCode FROM alloitm WHERE u_brand IS NOT NULL and u_brand <> ' ' and itemCode NOT LIKE 'DEM%' and itemCode NOT LIKE 'AS%' order by u_brand " ;
                    $stmt = $conn->query( $query );

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                      echo iconv('TIS-620', 'UTF-8',"<option value = '$row[itemCode]'> || $row[itemName]  </option>n)");
                    }
                    $stmt = null;

                    echo " </datalist>
                    </td>

                    <td><input type='number' name ='item2' placeholder='จำนวน'  style= width:95%; ></input></td>

                    <td>
                    <input  style= width:95%; type='number' name ='item3' class='prc' placeholder='ราคา'>
                    </td>

                    <td><input class='btn_d' type='submit' value='เพิ่ม'></td>
                    </table>
                    </form> 


                    <div class = 'name-wrap'> ";

                    echo "<form action='destroy.php?ID=".$_GET['ID']."&PID=". $_GET['PID']."' method='POST'>";
  // Using database connection file here
  $query = "SELECT req.ID,projects.ID as pid,projects.project_code1,req.unitnum ,alloitm.ItemName,req.itemName as itemName1,alloitm.itemCode, req.unitnum, req.price ,req.description,req.binfo
  FROM ((req 
  INNER JOIN projects ON req.project_id_fk = projects.ID) 
  LEFT JOIN alloitm ON req.ItemCode = alloitm.ItemCode)
  WHERE req.project_id_fk = ".$_GET['ID']." AND req.unitnum IS NOT NULL 
  order by req.ID ASC
  ";
  
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

  $stmt = $conn->query( $query );

  if( $conn->query( $query ) ){
    if($_GET['ID']){

      while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        echo "<h2 id='name-p'> ชื่องบ : <input type='text' id='itemname2'  name='item8' value ='". iconv('TIS-620', 'UTF-8',$row2['name_p']) ."'> </h2>
        <p> Status REQ. : ". iconv('TIS-620', 'UTF-8',$row2['sinfo']) ." </p>
        <p> สถานที่ส่งมอบ : <input type='text' id='itemname2' name='item9' value ='". iconv('TIS-620', 'UTF-8',$row2['location']) ."'></p>
        <p> วันที่ส่งมอบ :  ". date("d-m-Y", strtotime($row2['trans_date'])) ." <input type='date' id='itemname3' name='item10' placeholder='dd-mm-yyyy' value ='' > </p>
        ";

        echo "  <input class='btn_name-p' type='submit' value='บันทึก'>";

      }

      echo" </form></div> ";

      echo "<table class='table_h' id='p_info'>
      <tr>
      <th >รหัสโครงการ</th>
      <th>Code สินค้า</th>
      <th>รายการRequisition</th>
      <th>จำนวน</th>
      <th>ราคา (รวม)</th>
      <th>เลขที่ใบยืม</th>
      <th></th>
      <th><a id='delhy' href=\"setDel.php?ID=".$_GET['ID']."&PID=". $_GET['PID']." \">Del.</th>
      </tr>";

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        echo " <form action='update_req3.php?ID=".$row['ID']."&PPID=".$row['pid']."&PID=". $_GET['PID']."' method='POST'>";
        echo "<td style= width:7%;><a name='". $row['ID'] ."'></a>". iconv('TIS-620', 'UTF-8',$row['project_code1']) ."</td>";
        echo "<td style= width:10%;>". $row['itemCode'] ."</td>";
        echo "<td> <input id='itemname1' type='text' name ='item4' value ='". iconv('TIS-620', 'UTF-8',$row['ItemName']) ." ' maxlength='255' size='50'>
        ". iconv('TIS-620', 'UTF-8',$row['itemName1']) ." </td>";

        echo "<td style= width:5%; ><input  id='itemname' type='text' name ='item5' value ='". number_format($row['unitnum']) ."'></td>";

        echo "<td id='itemname2' style= width:7%;><input  id='itemname' type='text' name ='item6' value =''><br>". number_format($row['price']) ."</td>";
        echo "<td style= width:7%; ><input  id='itemname' type='text' name ='item7' value ='".iconv('TIS-620', 'UTF-8',$row['binfo']) ."'></td>";

        echo "<td style= width:4%;><input type='submit' value='บันทึก'></td>";

        echo "<td style= width:4%;><a href=\"del_item.php?ID=".$row['ID']."&PPID=".$row['pid']."&PID=". $_GET['PID']." \"> ลบ </td>";


        echo "</tr>";
        echo "</form>";
      }

      echo "</table>";


      echo "<div class = 'w-uplist'>";
      echo "<div class = 'uplist'>";
      $path_parts = "uploads/". $_GET["PID"] ." ";
      if(!is_dir("uploads/". $_GET["PID"] ."/")){

      }
      elseif(is_dir("uploads/". $_GET["PID"] ."/")){
        if ($handle = opendir($path_parts)) {
          while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
              echo "<a href= '../uploads/". $_GET["PID"] ."/$entry' target='_blank'>- $entry <br></a>";

            }
          }
          closedir($handle);
        }
      }
      echo " <form action='upload.php?ID=".$_GET['ID']."&PID=". $_GET['PID']."' method='post' enctype='multipart/form-data'> <br>";
      echo " <a href=\"delete_upload.php?ID=".$_GET['ID']."&PID=".$_GET['PID']."\"> <div class='del_up'>Delete File</div></a>";
      echo "   <input type='file' name='fileToUpload' id='fileToUpload'>";
      echo "   <input type='submit' value='Upload File' name='submit' id='fileToUpload'>";
      echo " </form>";
      echo "</div>";
      echo "</div>";

      $query = "SELECT projects.ID ,projects.info, projects.name_p, projects.h_sheet
      FROM projects 
      WHERE projects.ID = ".$_GET['ID']." 
      ";
      $stmt = $conn->query( $query );
      echo "<form action='destroy.php?ID=".$_GET['ID']."&PID=". $_GET['PID']."' method='POST'>";


      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<textarea id='remark' name='item11' placeholder='เอกสารส่งมอบ' >" .iconv('TIS-620', 'UTF-8',$row['h_sheet']) ."</textarea>";
        echo "<textarea id='remark' name='item7' placeholder='หมายเหตุ' maxlength='255'>" .iconv('TIS-620', 'UTF-8',$row['info']) ."</textarea>";
      }

      echo "<div class=warp_bt>";

      echo "<input class='btn_req1' type='submit' value='บันทึก Requisition'><br> ";

      echo "</div>";
      echo "</form>";


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
<script> 
  var today = new Date().toISOString().split('T')[0];
  document.getElementsByName("item10")[0].setAttribute('min', today); 
</script> 
</body>
</html> 

