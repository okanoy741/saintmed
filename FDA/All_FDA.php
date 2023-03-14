<?php
include "head.php";
include "encode.php";
?>
<br>
<div class="grid3">
    <p id ="headr2">ข้อมูลการจับคู่เลขที่สินค้ากับเลขที่ อย.</p>
    <a href="../FDA/update_set_item.php?"><div class="btn_update">  เพิ่ม / update ใบอนุญาต (ทั้งชุด) </div> </a>

    <?php  
	/*  if ($deage=="")
		$deage="NULL"; 
	$endc = urlencode(encrypted_url($_GET['item']));
	$dec=decrypted_url($endc);
	//$dec = str_replace(' ', '+', $dec1);
    $query2 = "SELECT *
    FROM ALL_FDA_VIEW 
    where ItemCode IS NULL AND (ItemCode LIKE '%".$_GET['item']."%' or  FDA_NO LIKE '%".$dec."%'  or FDA_DOCNO LIKE '%".$_GET['item']."%') 
        ORDER BY FDA_EXPIRED ASC
        ";
		
        echo $query2;*/





        ?>

        <form name="search" action='../FDA/search.php?' method="POST">
            <br><br>
            <input name="search" type="text" id="serchBox" placeholder="--- Search (SAPcode / ใบอนุญาต) ---"> <br><br>
            <center><div id="serchBox2"> <a href='../fda/all_fda.php'>ล้างค่า</a></div>  </center> <br>
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
        <br><br><br><br>
    </div>
    <br>
    <div class="grid3">
        <?php

        $date = date("Y/m/d");
        echo $date ;
    require_once "../FDA/connect.php";  // Using database connection file here
    if (empty($_GET)) {
        $query = "SELECT * FROM OITM_FDA_VIEW 
        ORDER BY FDA_EXPIRED ASC";

        $stmt = $conn->query( $query );

        $query11 = "SELECT count(*) AS sum_fda
        FROM OITM_FDA_VIEW
        ";
        $stmt11 = $conn->query( $query11 );
        
        echo "<ul id='nav'>";
        echo "<li><a href='#'>สินค้าใน SAP ได้รับ ITEM CODE แล้ว "; 
        while ($row11 = $stmt11->fetch(PDO::FETCH_ASSOC)){ 
            echo  "(".$row11['sum_fda'].")" ;
        }
        echo "</a>";
        echo "<section>";
        echo "<p>";


        echo "
        <table class='table_h6' >
        <tr>
        <th></th>
        <th>รหัสสินค้าใน SAP</th>
        <th>รายละเอียดสินค้า</th>
        <th>ยี่ห้อ</th>
        

        <th>เลขที่ใบจดแจ้งรายการละเอียด / ใบอนุญาต</th>
        <th>วัน/เดือน/ปี หมดอายุ</th>
        <th>หมดอายุในอีก</th>
        </tr>
        ";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            echo "<tr><td style= width:3%; > <a class = 'red3' href='update_item.php?item=".$row['id_num']."'> Update </a></td>";
            echo "<td style= width:11%;>". $row['ItemCode'] ."</td>";
            echo "<td style= width:11%;>". $row['ItemName'] ."</td>";
            echo "<td style= width:5%;>". $row['U_brand'] ."</td>";
            //echo "<td style= width:11%;>". $row['FDA_PRODUCT'] ."</td>";

            //$date1= date_create("$date");
            //$date2= date_create(" ".$row['FDA_EXPIRED']." ");
            //$diff= date_diff($date1,$date2);
            //$diff2 = $row['days_expired']->format("%y ปี  %m เดือน  %d ");
            $diff3 = $row['days_expired'];

            //echo "<td style= width:11%;>".$row['expiration_status'] ."</td>";

            echo "<td style= width:11%;> <a href='All_FDA.php?item=".urlencode(encrypted_url($row['FDA_NO']))."'>". $row['FDA_NO'] ."</a></td>";
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

        echo "</table> 
        </p>
        </section>
        </li>
        ";

        /*-------รายการได้รับเลขแล้ว---------*/
        $query2 = "SELECT *
        FROM ALL_FDA_VIEW 
        where ItemCode IS NULL 
        ORDER BY FDA_EXPIRED ASC
        ";
        $stmt2 = $conn->query( $query2 );

        $query12 = "SELECT count(*) AS sum_fda
        FROM ALL_FDA_VIEW 
        where ItemCode IS NULL 
        ";
        $stmt12 = $conn->query( $query12 );

        echo "<li><a href='#'>สินค้าใน SAP ยังไม่ได้รับ ITEM CODE "; 
        while ($row12 = $stmt12->fetch(PDO::FETCH_ASSOC)){ 
            echo  "(".$row12['sum_fda'].")" ;
        }
        echo "</a>";
        echo "<section>";
        echo "<p>";



        echo "
        <table class='table_h5' >
        <tr>
        <th>รหัสสินค้าใน SAP</th>
        <th>รายละเอียดสินค้า</th>
        <th>รุ่น</th>

        <th>เลขที่ใบจดแจ้งรายการละเอียด / ใบอนุญาต</th>
        <th>วัน/เดือน/ปี หมดอายุ</th>
        <th>หมดอายุในอีก</th>
        </tr>
        ";
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
            echo "<td style= width:3%;> <a href='update_item.php?item=".$row2['id_num']."'>Update </td>";
            echo "<td style= width:9%;>". $row2['FDA_CAT_NO'] ."</td>";
            echo "<td style= width:20%;>". $row2['FDA_ITEMNAME'] ."</td>";

        //$date1= date_create("$date");
       // $date2= date_create(" ".$row2['FDA_EXPIRED']." ");
        //$diff= date_diff($date1,$date2);
        //$diff2 = $diff->format("%y ปี  %m เดือน  %d ");
            $diff3 = $row2['days_expired']; 

        /* switch ($row2['FDA_STATUS']) {
          case ("HAVE      ") : echo "<td style= width:4%;> มี </td>";
          break;
          case ("NOT       ") : echo "<td style= width:4%; class = 'red'> สินค้าเลิกผลิต </td>";
          break;
      } */

//echo "<td style= width:11%;>". ."</td>";
      echo "<td style= width:11%;> <a href='All_FDA.php?item=".urlencode(encrypted_url($row2['FDA_NO']))."'>". $row2['FDA_NO'] ."</a></td>";
      echo "<td style= width:7%;>". date("d-m-Y", strtotime($row2['FDA_EXPIRED'])) ."</td>";
      
      switch ($diff3) {
        case ($diff3 <= 0) : echo "<td class = 'red' style= width:9%;> หมดอายุ ";
        break;
        case ($diff3 >= 180) : echo "<td class = 'green' style= width:11%;>".$row2['expired_time']."";
        break;
        case ($diff3 >= 90 && $diff3 < 180) : echo "<td class = 'yellow' style= width:11%;>".$row2['expired_time']."";
        break;
        case ($diff3 < 90) : echo "<td class = 'red' style= width:9%;>".$row2['expired_time']."";
        break;
    }
    echo "<br>--(".$row2['expiration_status'].")--</td>";


    echo "</tr>";
}  

echo "</table></p>
</section>
</li>";



echo "</ul>";
}

/*-------use fileter name---------*/
elseif (!empty($_GET)) {
	$dec=decrypted_url($_GET['item']);
    $query = "SELECT *
    FROM OITM_FDA_VIEW
    where ItemCode LIKE '%".$dec."%' or  FDA_NO LIKE '%".$dec."%' 
    ORDER BY FDA_EXPIRED ASC
    ";

    $stmt = $conn->query( $query );

    $query11 = "SELECT count(*) AS sum_fda
    FROM OITM_FDA_VIEW 
    where ItemCode LIKE '%".$dec."%' or  FDA_NO LIKE '%".$dec."%' 
    ";
    $stmt11 = $conn->query( $query11 );
    /////////////

	////////////
    echo "<ul id='nav'>";
    echo "<li><a href='#'>สินค้าใน SAP ได้รับ ITEM CODE แล้ว "; 
    while ($row11 = $stmt11->fetch(PDO::FETCH_ASSOC)){ 
        echo  "(".$row11['sum_fda'].")" ;
    }
    echo "</a>";
    echo "<section>";
    echo "<p>";


    echo "
    <table class='table_h6' >
    <tr>
    <th></th>
    <th>รหัสสินค้าใน SAP</th>
    <th>รายละเอียดสินค้า</th>
    <th>ยี่ห้อ</th>


    <th>เลขที่ใบจดแจ้งรายการละเอียด / ใบอนุญาต</th>
    <th>วัน/เดือน/ปี หมดอายุ</th>
    <th>หมดอายุในอีก</th>
    </tr>
    ";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        echo "<tr><td style= width:3%; > <a class = 'red3' href='update_item.php?item=".$row['id_num']."'> Update </a></td>";
        echo "<td style= width:11%;>". $row['ItemCode'] ."</td>";
        echo "<td style= width:11%;>". $row['ItemName'] ."</td>";
        echo "<td style= width:5%;>". $row['U_brand'] ."</td>";
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

    echo "</table> 
    </p>
    </section>
    </li>
    ";

    /*-------รายการได้รับเลขแล้ว---------*/
    $dec=decrypted_url($_GET['item']);
    $query2 = "SELECT *
    FROM ALL_FDA_VIEW 
    where ItemCode IS NULL AND (ItemCode LIKE '%".$dec."%' or  FDA_NO LIKE '%".$dec."%'  or FDA_DOCNO LIKE '%".$dec."%') 
        ORDER BY FDA_EXPIRED ASC
        ";
        $stmt2 = $conn->query( $query2 );

        $query12 = "SELECT count(*) AS sum_fda
        FROM ALL_FDA_VIEW
        where ItemCode IS NULL AND (ItemCode LIKE '%".$dec."%' or  FDA_NO LIKE '%".$dec."%'  or FDA_DOCNO LIKE '%".$dec."%')
            ";
            $stmt12 = $conn->query( $query12 );

            echo "<li><a href='#'>สินค้าใน SAP ยังไม่ได้รับ ITEM CODE "; 
            while ($row12 = $stmt12->fetch(PDO::FETCH_ASSOC)){ 
                echo  "(".$row12['sum_fda'].")" ;
            }
            echo "</a>";
            echo "<section>";
            echo "<p>";



            echo "
            <table class='table_h5' >
            <tr>
            <th>รหัสสินค้าใน SAP</th>
            <th>รายละเอียดสินค้า</th>
            <th>รุ่น</th>

            <th>เลขที่ใบจดแจ้งรายการละเอียด / ใบอนุญาต</th>
            <th>วัน/เดือน/ปี หมดอายุ</th>
            <th>หมดอายุในอีก</th>
            </tr>
            ";
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                echo "<td style= width:3%;> <a href='update_item.php?item=".$row2['id_num']."'>Update </td>";
                echo "<td style= width:9%;>". $row2['FDA_CAT_NO'] ."</td>";
                echo "<td style= width:20%;>". $row2['FDA_ITEMNAME'] ."</td>";

        //$date1= date_create("$date");
       // $date2= date_create(" ".$row2['FDA_EXPIRED']." ");
        //$diff= date_diff($date1,$date2);
        //$diff2 = $diff->format("%y ปี  %m เดือน  %d ");
                $diff3 = $row2['days_expired']; 

        /* switch ($row2['FDA_STATUS']) {
          case ("HAVE      ") : echo "<td style= width:4%;> มี </td>";
          break;
          case ("NOT       ") : echo "<td style= width:4%; class = 'red'> สินค้าเลิกผลิต </td>";
          break;
      } */

//echo "<td style= width:11%;>". ."</td>";
      echo "<td style= width:12%;>". $row2['FDA_NO'] ."</td>";
      echo "<td style= width:7%;>". date("d-m-Y", strtotime($row2['FDA_EXPIRED'])) ."</td>";
      
      switch ($diff3) {
        case ($diff3 <= 0) : echo "<td class = 'red' style= width:9%;> หมดอายุ ";
        break;
        case ($diff3 >= 180) : echo "<td class = 'green' style= width:11%;>".$row2['expired_time']."";
        break;
        case ($diff3 >= 90 && $diff3 < 180) : echo "<td class = 'yellow' style= width:11%;>".$row2['expired_time']."";
        break;
        case ($diff3 < 90) : echo "<td class = 'red' style= width:9%;>".$row2['expired_time']."";
        break;
    }
    echo "<br>--(".$row2['expiration_status'].")--</td>";


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