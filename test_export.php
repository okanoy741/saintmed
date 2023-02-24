<?php
include "head.php";


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
                    			<th>เลขที่ใบยืม</th>
                    			<th>Appove By</th>
                    			</tr>";

                    			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    				echo "<td style= width:8%;>". iconv('TIS-620', 'UTF-8',$row['project_code1']) ."</td>";
                    				echo "<td style= width:16%;>". $row['itemCode'] ."</td>";
                    				echo "<td>". iconv('TIS-620', 'UTF-8',$row['ItemName']) ." <br>". iconv('TIS-620', 'UTF-8',$row['itemName1']) ." </td>";
                    				echo "<td id='no' style= width:10%; >". number_format($row['unitnum']) ."</td>";
                    				echo "<td id='no' style= width:10%; >". number_format($row['price']) ." </td>";
                    				echo "<td>". iconv('TIS-620', 'UTF-8',$row['binfo']) ." </td>";
                    				echo "<td id='no' style= width:10%; >". $row['appove'] ." </td>";

                    				echo "</tr>";
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

                    				";}
                    				echo "</table>";
echo "<input class='btn_req' type='submit' ID='create_excel' value='Export to Excel'>";
?>

                                        <script> 
                         function fncEX()
                         {
                              $(document).ready(function () {
                                   $('#create_excel').click(function(){
                                        $("#p_info").table2excel({ 
                                             filename: "p_info.xls" 
                                        });   
                                   }); 
                              }); 
                         }
                    </script> 