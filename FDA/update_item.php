<?php
include "head.php";
?>
<div class="grid3">
    <p id ="headr2">ข้อมูลการจับคู่เลขที่สินค้ากับเลขที่ อย.</p>
</div>
<div class="grid4">
    <?php
    $date = date("Y/m/d");
    require_once "../FDA/connect.php";  // Using database connection file here
    if (empty($_GET)) {
        header("Refresh:0; url=../FDA/All_FDA.php");
    }

    /*-------use fileter name---------*/
    elseif (!empty($_GET)) {

      /*-------รายการได้รับเลขแล้ว---------*/
      $query2 = "SELECT fda_item.*, OITM.ItemName, OITM.U_brand
      FROM [it_project].[dbo].[fda_item] 
      LEFT JOIN [sap_smd].[dbo].[OITM] ON fda_item.ItemCode = OITM.ItemCode collate Thai_CI_AS
      where fda_item.ItemCode IS NULL AND fda_item.id_num = '".$_GET['item']."'
      ";
      $stmt2 = $conn->query( $query2 );

      echo "
      <table class='table_h5' >
      <tr>
      <th>รหัสสินค้าใน SAP</th>
      <th>รายละเอียดสินค้า</th>
      <th>รุ่น</th>
      <th>สถานะอย.</th>
      <th>เลขที่ใบจดแจ้งรายการละเอียด / ใบอนุญาต</th>
      <th>วัน/เดือน/ปี หมดอายุ</th>
      <th>หมดอายุในอีก</th>
      <th></th>
      </tr>
      ";
      while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        echo "<form action='../FDA/update_item_con.php?' method='POST' id='subform' >";
        echo "<td style= width:10%;> <input name='item1' type='text' id='insertBox' placeholder='--- SAP Item code ---' required></td>";
        echo "<td style= width:9%;>". $row2['FDA_CAT_NO'] ."</td>";
        echo "<td style= width:15%;>". $row2['FDA_ITEMNAME'] ."</td>";
        switch ($row2['FDA_NO']) {
          case NULL : echo "<td style= width:4%;> ไม่มี </td>";
          break;
          default : echo "<td style= width:4%;> มี </td>";
      }
      echo "<td style= width:10%;> <input name='item2' type='text' id='insertBox' placeholder=' ".$row2['FDA_NO']." ' required></td>";
      echo "<td style= width:7%;> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ". date("d-m-Y", strtotime($row2['FDA_EXPIRED'])) ." <br> <input name='item3' type='date' id='insertBox' value ='' required> </td>";

      $date1= date_create("$date");
      $date2= date_create(" ".$row2['FDA_EXPIRED']." ");
      $diff= date_diff($date1,$date2);
      $diff2 = $diff->format("%y ปี  %m เดือน  %d ");
      $diff3 = $diff->format("%a");   

      switch ($diff3) {
          case ($diff3 >= 180) : echo "<td class = 'green' style= width:7%;>".$diff2." วัน"."</td>";
          break;
          case ($diff3 >= 90 && $diff3 < 180) : echo "<td class = 'yellow' style= width:7%;>".$diff2." วัน"."</td>";
          break;
          case ($diff3 < 90) : echo "<td class = 'red' style= width:7%;>".$diff2." วัน"."</td>";
          break;
      }
      echo "<td class = 'red2' style= width:3%;><a href='../FDA/del_item_con.php?item=".$row2['id_num']."' onclick=\"return confirm('ต้องการ ลบ ข้อมูลหรือไม่?')\"> <img src=\"../img/delete.png\" /'></a></td>";
      echo "</tr>";
  } 

  echo "</table></p>";
}
?>
<input class="btn_submit2" name='submit' type='submit' value="บันทึก"> <br><br>
<a href="../FDA/All_FDA.php"><div class="btn_cancel">  กลับ </div></a>

</form>
</div>


<script>
    var submit = document.querySelector("input[type=submit]");
  
/* set onclick on submit input */   
submit.setAttribute("onclick", "return test()");

//submit.addEventListener("click", test);

function test() {

  if (confirm('กรุณาตรวจสอบข้อมูล ถูกต้องหรือไม่?')) {         
    return true;         
  } else {
    return false;
  }

}
</script>

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