<?php
include "head.php";
?>
<div class="grid3">
    <p id ="headr2">ข้อมูลการจับคู่เลขที่สินค้ากับเลขที่ อย.</p>
    <form name="search" action='../FDA/search.php?' method="POST">
        <br><br>
        <input name="search" type="text" id="serchBox" placeholder="--- Search (SAPcode / ใบอนุญาต) ---"> <br><br>
        <a href='../FDA/All_FDA.php'><div id="serchBox2"> clear filter</div></a> <br>
    </form>
</div>
<div class="grid3">
    <?php
    $date = date("Y/m/d");
    echo $date ;
    require_once "../FDA/connect.php";  // Using database connection file here
    if (empty($_GET)) {
        $query = "SELECT fda_item.*, OITM.ItemName, OITM.U_brand
        FROM [it_project].[dbo].[fda_item] 
        LEFT JOIN [sap_smd].[dbo].[OITM] ON fda_item.ItemCode = OITM.ItemCode collate Thai_CI_AS
        where fda_item.ItemCode IS NOT NULL 
        ORDER BY fda_item.ItemCode ASC
        ";

        $stmt = $conn->query( $query );

        $query11 = "SELECT count(fda_item.id_num) AS sum_fda
        FROM [it_project].[dbo].[fda_item] 
        LEFT JOIN [sap_smd].[dbo].[OITM] ON fda_item.ItemCode = OITM.ItemCode collate Thai_CI_AS
        where fda_item.ItemCode IS NOT NULL 
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
        <th>รหัสสินค้าใน SAP</th>
        <th>รายละเอียดสินค้า</th>
        <th>ยี่ห้อ</th>
        <th>รุ่น</th>
        <th>สถานะอย.</th>
        <th>เลขที่ใบจดแจ้งรายการละเอียด / ใบอนุญาต</th>
        <th>วัน/เดือน/ปี หมดอายุ</th>
        <th>หมดอายุในอีก</th>
        </tr>
        ";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<td style= width:11%;>". $row['ItemCode'] ."</td>";
            echo "<td style= width:11%;>". $row['ItemName'] ."</td>";
            echo "<td style= width:5%;>". $row['U_brand'] ."</td>";
            echo "<td style= width:11%;>". $row['FDA_PRODUCT'] ."</td>";
            switch ($row['FDA_NO']) {
              case NULL : echo "<td style= width:4%;> ไม่มี </td>";
              break;
              default : echo "<td style= width:4%;> มี </td>";
          }
          echo "<td style= width:11%;>". $row['FDA_NO'] ."</td>";
          echo "<td style= width:9%;>". date("d-m-Y", strtotime($row['FDA_EXPIRED'])) ."</td>";

          
          $date1= date_create("$date");
          $date2= date_create(" ".$row['FDA_EXPIRED']." ");
          $diff= date_diff($date1,$date2);
          $diff2 = $diff->format("%y ปี  %m เดือน  %d ");
          $diff3 = $diff->format("%a");	

          switch ($diff3) {
              case ($diff3 >= 180) : echo "<td class = 'green' style= width:11%;>".$diff2." วัน"."</td>";
              break;
              case ($diff3 >= 90 && $diff3 < 180) : echo "<td class = 'yellow' style= width:11%;>".$diff2." วัน"."</td>";
              break;
              case ($diff3 < 90) : echo "<td class = 'red' style= width:9%;>".$diff2." วัน"."</td>";
              break;
          }

          echo "</tr>";

      } 

      echo "</table>
      </p>
      </section>
      </li>
      ";

      /*-------รายการได้รับเลขแล้ว---------*/
      $query2 = "SELECT fda_item.*, OITM.ItemName, OITM.U_brand
      FROM [it_project].[dbo].[fda_item] 
      LEFT JOIN [sap_smd].[dbo].[OITM] ON fda_item.ItemCode = OITM.ItemCode collate Thai_CI_AS
      where fda_item.ItemCode IS NULL 
      ORDER BY fda_item.ItemCode DESC
      ";
      $stmt2 = $conn->query( $query2 );

      $query12 = "SELECT count(fda_item.id_num) AS sum_fda
      FROM [it_project].[dbo].[fda_item] 
      LEFT JOIN [sap_smd].[dbo].[OITM] ON fda_item.ItemCode = OITM.ItemCode collate Thai_CI_AS
      where fda_item.ItemCode IS NULL 
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
    <th>สถานะอย.</th>
    <th>เลขที่ใบจดแจ้งรายการละเอียด / ใบอนุญาต</th>
    <th>วัน/เดือน/ปี หมดอายุ</th>
    <th>หมดอายุในอีก</th>
    </tr>
    ";
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        echo "<td style= width:5%;>". $row2['ItemCode'] ."</td>";
        echo "<td style= width:9%;>". $row2['FDA_CAT_NO'] ."</td>";
        echo "<td style= width:20%;>". $row2['FDA_ITEMNAME'] ."</td>";
        switch ($row2['FDA_NO']) {
          case NULL : echo "<td style= width:4%;> ไม่มี </td>";
          break;
          default : echo "<td style= width:4%;> มี </td>";
      }
      echo "<td style= width:12%;>". $row2['FDA_NO'] ."</td>";
      echo "<td style= width:7%;>". date("d-m-Y", strtotime($row2['FDA_EXPIRED'])) ."</td>";
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


      echo "</tr>";
  }  

  echo "</table></p>
  </section>
  </li>";



  echo "</ul>";
}

/*-------use fileter name---------*/
elseif (!empty($_GET)) {
    $query = "SELECT fda_item.*, OITM.ItemName, OITM.U_brand
    FROM [it_project].[dbo].[fda_item] 
    LEFT JOIN [sap_smd].[dbo].[OITM] ON fda_item.ItemCode = OITM.ItemCode collate Thai_CI_AS
    where fda_item.ItemCode IS NOT NULL AND fda_item.ItemCode LIKE '%".$_GET['item']."%' or  fda_item.ItemCode IS NOT NULL AND fda_item.FDA_NO LIKE '%".$_GET['item']."%' or  fda_item.ItemCode IS NOT NULL AND fda_item.FDA_DOCNO LIKE '%".$_GET['item']."%'
    ";

    $stmt = $conn->query( $query );

    $query11 = "SELECT count(fda_item.id_num) AS sum_fda
    FROM [it_project].[dbo].[fda_item] 
    LEFT JOIN [sap_smd].[dbo].[OITM] ON fda_item.ItemCode = OITM.ItemCode collate Thai_CI_AS
    where fda_item.ItemCode IS NOT NULL AND fda_item.ItemCode LIKE '%".$_GET['item']."%' or  fda_item.ItemCode IS NOT NULL AND fda_item.FDA_NO LIKE '%".$_GET['item']."%' or  fda_item.ItemCode IS NOT NULL AND fda_item.FDA_DOCNO LIKE '%".$_GET['item']."%'
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
    <th>รหัสสินค้าใน SAP</th>
    <th>รายละเอียดสินค้า</th>
    <th>ยี่ห้อ</th>
    <th>รุ่น</th>
    <th>สถานะอย.</th>
    <th>เลขที่ใบจดแจ้งรายการละเอียด / ใบอนุญาต</th>
    <th>วัน/เดือน/ปี หมดอายุ</th>
    <th>หมดอายุในอีก</th>
    </tr>
    ";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<td style= width:11%;>". $row['ItemCode'] ."</td>";
        echo "<td style= width:11%;>". $row['ItemName'] ."</td>";
        echo "<td style= width:5%;>". $row['U_brand'] ."</td>";
        echo "<td style= width:11%;>". $row['FDA_PRODUCT'] ."</td>";
        switch ($row['FDA_NO']) {
          case NULL : echo "<td style= width:4%;> ไม่มี </td>";
          break;
          default : echo "<td style= width:4%;> มี </td>";
      }
      echo "<td style= width:11%;>". $row['FDA_NO'] ."</td>";
      echo "<td style= width:9%;>". date("d-m-Y", strtotime($row['FDA_EXPIRED'])) ."</td>";


      $date1= date_create("$date");
      $date2= date_create(" ".$row['FDA_EXPIRED']." ");
      $diff= date_diff($date1,$date2);
      $diff2 = $diff->format("%y ปี  %m เดือน  %d ");
      $diff3 = $diff->format("%a"); 

      switch ($diff3) {
          case ($diff3 >= 180) : echo "<td class = 'green' style= width:11%;>".$diff2." วัน"."</td>";
          break;
          case ($diff3 >= 90 && $diff3 < 180) : echo "<td class = 'yellow' style= width:11%;>".$diff2." วัน"."</td>";
          break;
          case ($diff3 < 90) : echo "<td class = 'red' style= width:9%;>".$diff2." วัน"."</td>";
          break;
      }
      echo "</tr>";
  } 

  echo "</table>
  </p>
  </section>
  </li>
  ";

  /*-------รายการได้รับเลขแล้ว---------*/
  $query2 = "SELECT fda_item.*, OITM.ItemName, OITM.U_brand
  FROM [it_project].[dbo].[fda_item] 
  LEFT JOIN [sap_smd].[dbo].[OITM] ON fda_item.ItemCode = OITM.ItemCode collate Thai_CI_AS
  where fda_item.ItemCode IS NULL AND fda_item.ItemCode LIKE '%".$_GET['item']."%' or  fda_item.ItemCode IS NULL AND fda_item.FDA_NO LIKE '%".$_GET['item']."%'  or  fda_item.ItemCode IS NULL AND fda_item.FDA_DOCNO LIKE '%".$_GET['item']."%'
  ";
  $stmt2 = $conn->query( $query2 );

  $query12 = "SELECT count(fda_item.id_num) AS sum_fda
  FROM [it_project].[dbo].[fda_item] 
  LEFT JOIN [sap_smd].[dbo].[OITM] ON fda_item.ItemCode = OITM.ItemCode collate Thai_CI_AS
  where fda_item.ItemCode IS NULL AND fda_item.ItemCode LIKE '%".$_GET['item']."%' or  fda_item.ItemCode IS NULL AND fda_item.FDA_NO LIKE '%".$_GET['item']."%'  or  fda_item.ItemCode IS NULL AND fda_item.FDA_DOCNO LIKE '%".$_GET['item']."%'
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
<th>สถานะอย.</th>
<th>เลขที่ใบจดแจ้งรายการละเอียด / ใบอนุญาต</th>
<th>วัน/เดือน/ปี หมดอายุ</th>
<th>หมดอายุในอีก</th>
</tr>
";
while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
    echo "<td style= width:5%;> <a href='update_item.php?item=".$row2['FDA_DOCNO']."'>Update </td>";
    echo "<td style= width:9%;>". $row2['FDA_CAT_NO'] ."</td>";
    echo "<td style= width:20%;>". $row2['FDA_ITEMNAME'] ."</td>";
    switch ($row2['FDA_NO']) {
      case NULL : echo "<td style= width:4%;> ไม่มี </td>";
      break;
      default : echo "<td style= width:4%;> มี </td>";
  }
  echo "<td style= width:12%;>". $row2['FDA_NO'] ."</td>";
  echo "<td style= width:7%;>". date("d-m-Y", strtotime($row2['FDA_EXPIRED'])) ."</td>";
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