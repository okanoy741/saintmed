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

  <div class="banner2">
    <img class="logo" src="../img/saintmed_logo.png"><p>PRE-REQ.</p>
    <p><BR></p>
  </div> 
  <?php
  if (empty($_GET['PID']) || empty($_GET['ID'])) { 
    $message = "กรุณา! ขอทำ PRE-REQUISITION ใหม่อีกครั้ง";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Refresh:1; url=http://saintmed.dyndns.biz/sales/tender_list_sales.asp?"); 
  }
  elseif (!empty($_GET['PID'])){

                        require_once "connect.php";  // Using database connection file here
                        $query = "select TOP 1 *,statusReq.sid,statusReq.sinfo,employee2.ID,employee2.name,employee2.lastname
                        FROM (((projects_pre LEFT JOIN statusReq 
                        ON projects_pre.status = statusReq.sid)
                        LEFT JOIN employee2 
                        ON projects_pre.employee_id_fk = employee2.id)
                        LEFT JOIN BplusData
                        ON projects_pre.client_id_fk = BplusData.ID)
                        where projects_pre.ID = ".$_GET['ID']."
                        ";
                        $stmt = $conn->query( $query );
                        if( $conn->query( $query ) ){
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                            if($row['statusReq'] != 12){
                              echo "
                              <form action='insert_preReq.php?ID=".$_GET['ID']."&PID=".$_GET['PID']." ' method='POST'>
                              <table class='table_show' ID='all_p'>
                              <tr>
                              <th>รหัสโครงการ</th>
                              <td><h2>".iconv('TIS-620', 'UTF-8',$row['info']) ."</h2></td>
                              </tr>
                              <tr>
                              <th>โรงพยาบาล</th>
                              <td>
                              <input  style= width:95%; type='text' name ='item1' class='itemName' placeholder='---โรงพยาบาล---' ></td>
                              </tr>
                              <tr>
                              <th>เครื่อง/รุ่น</th>
                              <td><input  style= width:95%; type='text' name ='item2' class='itemName' placeholder='---เครื่อง/รุ่น---' ></td>
                              </tr><tr>
                              <th>จำนวน(เครื่อง)</th>
                              <td><input  style= width:95%; type='number' name ='item3' class='itemName' placeholder='---จำนวน---' ></td>
                              </tr>
                              <tr>
                              <th>ราคาต่อชิ้น</th>
                              <td><input  style= width:95%; type='number' name ='item4' class='itemName' placeholder='---ราคา---' ></td>
                              </tr>
                              
                              <tr>
                              <th>ผู้รับผิดชอบ</th>
                              <td>". iconv('TIS-620', 'UTF-8',$row['name']) ." ". iconv('TIS-620', 'UTF-8',$row['lastname']) ." </td>
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
                          echo "</table>
                          <input class='btn_d3' type='submit' value='บันทึก PRE-REQUISITION'>
                          </form> ";
                        }
                      }            

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

