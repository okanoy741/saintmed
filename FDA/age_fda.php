<?php
include "head.php";
include "encode.php";

?>
<br><br><br><br><br><br><br><br><br><br><br>
<div class="grid3">
    <p id ="headr2">ข้อมูลการจับคู่เลขที่สินค้ากับเลขที่ อย.</p>
    <a href="../FDA/update_set_item.php?"><div class="btn_update">  เพิ่ม / update ใบอนุญาต (ทั้งชุด) </div></a>
    <form name="search" action='../FDA/search.php?' method="POST">
        <br><br>
        <input name="search" type="text" id="serchBox" placeholder="--- Search (SAPcode / ใบอนุญาต) ---"> <br><br>
        <center><div id="serchBox2"> <a href='../fda/all_fda.php'>กลับไปหน้าหลัก</a></div></center> <br>
		<?php
			$age1 = encrypted_url("1");
			$age2 = encrypted_url("2");
			$age3 = encrypted_url("3");
			$age4 = encrypted_url("4");
			echo "<center>
         <div id=serchBoxNO> <a href='../fda/age_fda.php?age=".$age1."'>อย.หมดอายุ</a></div>  
         <div id=serchBoxLess3> <a href='../fda/age_fda.php?age=".$age2."'>อย.ไม่ถึง 3 เดือน</a></div>
         <div id=serchBoxLess6> <a href='../fda/age_fda.php?age=".$age3."'>อย.ไม่ถึง 6 เดือน</a></div>
         <div id=serchBoxMore6> <a href='../fda/age_fda.php?age=".$age4."'>อย.เกิน 6 เดือน</a></div>
     </center>";
		?>
    </form>
    <br><br><br><br><br>
</div>
<br>
<div >
    <?php
    $agestart = decrypted_url($_GET['age']);
    if ($agestart == "1")
       $age_fda = "สินค้าเลิกผลิต";
   elseif ($agestart =="2")
       $age_fda =" เหลือน้อยกว่า 3 เดือน";
   elseif ($agestart == "3")
       $age_fda ="เหลือน้อยกว่า 6 เดือน";
   else $age_fda ="เหลือเกิน 6 เดือน";
   //$date = date("Y/m/d");
   //echo $age_fda;
    require_once "../FDA/connect.php";  // Using database connection file here
    if (!empty($_GET)) {
        $query = "SELECT * FROM ALL_FDA_VIEW 
        WHERE expiration_status = '".$age_fda."'
        ORDER BY FDA_EXPIRED ASC";

        $stmt = $conn->query( $query );

        $query11 = "SELECT count(*) AS sum_fda
        FROM ALL_FDA_VIEW 
        WHERE expiration_status = '".$age_fda."'
        ";
        $stmt11 = $conn->query( $query11 );
        

        echo "<br><center><h4>สถานะรายการ  &nbsp;".$age_fda."&nbsp;"; 
        while ($row11 = $stmt11->fetch(PDO::FETCH_ASSOC)){ 
            echo  "(".$row11['sum_fda']." รายการ) </h4></center>" ;
        }

        echo "
        <table class='table_h6' >
        <tr>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>รหัสสินค้าใน SAP</th>
        <th>รายละเอียดสินค้า  SAP</th>
        <th>ยี่ห้อ</th>
        <th>รายละเอียดสินค้า  FDA</th>
        <th>เลขที่ใบจดแจ้งรายการละเอียด / ใบอนุญาต</th>
        <th>วัน/เดือน/ปี หมดอายุ</th>
        <th>หมดอายุในอีก</th>
        </tr>
        ";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            echo "<tr><td style= width:3%; > <a class = 'red4' href='update_item.php?item=".$row['id_num']."'> Update </a></td>";
            echo "<td style= width:11%;>". $row['ItemCode'] ."</td>";
            echo "<td style= width:11%;>". $row['ItemName'] ."</td>";
            echo "<td style= width:5%;>". $row['u_brand'] ."</td>";
            echo "<td style= width:20%;>". $row['FDA_ITEMNAME'] ."</td>";
            //echo "<td style= width:11%;>". $row['FDA_PRODUCT'] ."</td>";

            //$date1= date_create("$date");
            //$date2= date_create(" ".$row['FDA_EXPIRED']." ");
            //$diff= date_diff($date1,$date2);
            //$diff2 = $row['days_expired']->format("%y ปี  %m เดือน  %d ");
            $diff3 = $row['days_expired'];

            //echo "<td style= width:11%;>".$row['expiration_status'] ."</td>";

            echo "<td style= width:11%;>". $row['FDA_NO'] ."</td>";
            echo "<td style= width:9%;>".date("d-m-Y", strtotime($row['FDA_EXPIRED'])) ."</td>";
            switch ($diff3) {
                case ($diff3 <= 0) : echo "<td class = 'red' style= width:9%;> หมดอายุ ";
                break;
                case ($diff3 >= 180) : echo "<td class = 'green' style= width:11%;>".$row['expired_time']."";
                break;
                case ($diff3 >= 90 && $diff3 < 180) : echo "<td class = 'yellow' style= width:11%;>".$row['expired_time']."";
                break;
                case ($diff3 < 90) : echo "<td class = 'red' style= width:9%;>".$row['expired_time']."";
                break;
            }
            echo "<br>--(".$row['expiration_status'].")--</td>";


            echo "</tr>";

        }

        echo "</table>   ";
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