<?php
include "../SaleCheckIn/head.php";
session_start();
$abr = $_SESSION['sales_code'];

include "../SaleCheckIn/conn.php";  // Using database connection file here
$query3 = "SELECT users.username, employee2.ID AS emp_id, employee2.manager_id_fk FROM users 
LEFT JOIN employee2 on users.sales_code = employee2.abr WHERE users.username = '".$_SESSION['USERNAME']." '";
$stmt3 = $conn2->query( $query3 );
while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
    $manager_id = $row3['manager_id_fk'];
    $emp_id = $row3['emp_id'];
}


if (empty($_SESSION['USERNAME']) ) { 
   header("Location: ../SaleCheckIn/logininput.php?");
}
?>

<?php
include "head.php";
?>
<div class="grid3">
    <p id ="headr2">รายการเข้าพบแพทย์ </p>
    <!-- <form name="search" action='../sale_admin/search.php?' method="POST">

        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input name="search" type="text" id="serchBox" placeholder="---Search จากชื่อพนักงาน---"> <br><br>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href='../sale_admin/chk_projects.php'> clear filter</a> <br>
    </form> -->
    <br><br>
    <div class="name-wrap">
        <a class="btn_req1" href=../SaleCheckIn/indexAM_chk.php?> ลงรายงาน </a>
    </div>
</div>
<div class="grid3">
    <?php
    
    
    $query = "SELECT * FROM sale_check_in 
    WHERE appove_status = '01' AND am_id = $emp_id 
    ORDER BY id DESC
    ";

    $stmt = $conn->query( $query );

    echo "<ul id='nav'>
    <li><a href='#'>รอรับทราบ</a>
    <section>
    <p>";


    echo "
    <table class='table_h6' >
    <tr>
    <th>วันที่</th>
    <th>โรงพยาบาล</th>
    <th>แผนก</th>
    <th>เข้าพบ</th>
    <th>รายละเอียดเข้าพบ</th>
    <th>sale</th>
    <th>สถานะการตรวจของ AM</th>
    <th></th>
    </tr>
    ";
    while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)){
      echo "<td> ". date("d-m-Y H:i:s", strtotime($row2['chk_in'])) ." </td>";
      echo "<td> ".$row2['hospital']." </td>";
      echo "<td> ".$row2['department']." </td>";
      echo "<td> ".$row2['person']." </td>";
      echo "<td> ".$row2['info']." </td>";
      echo "<td> ".$row2['username']." </td>";
      switch ($row2['appove_status']) {
          case "1" : echo "<td> รอรับทราบ </td>";
          break;
          case "2" : echo "<td> รับทราบแล้ว </td>";
          break;
      }
      echo "<td><a href=\"../SaleCheckIn/appove.php?ID=".iconv('TIS-620', 'UTF-8',$row2['id'])."\"> รับทราบ </a></td>";
      echo "</tr>";
  } 

  echo "</table>
  </p>
  </section>
  </li>
  ";
  /*-------รายการได้รับเลขแล้ว---------*/
  $query2 = "SELECT * FROM sale_check_in 
  WHERE appove_status = '02' AND am_id = $emp_id 

  ORDER BY id DESC
  ";
  $stmt2 = $conn->query( $query2 );

  echo "<li><a href='#'>รับทราบแล้ว</a>
  <section>
  <p>
  <table class='table_h6' >
  <tr>
  <th>วันที่</th>
  <th>โรงพยาบาล</th>
  <th>แผนก</th>
  <th>เข้าพบ</th>
  <th>รายละเอียดเข้าพบ</th>
  <th>sale</th>
  <th>สถานะการตรวจของ AM</th>
  </tr>";

  while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){

    echo "<td> ". date("d-m-Y H:i:s", strtotime($row2['chk_in'])) ." </td>";
    echo "<td> ".$row2['hospital']." </td>";
    echo "<td> ".$row2['department']." </td>";
    echo "<td> ".$row2['person']." </td>";
    echo "<td> ".$row2['info']." </td>";
    echo "<td> ".$row2['username']." </td>";
    switch ($row2['appove_status']) {
      case "1" : echo "<td> รอรับทราบ </td>";
      break;
      case "2" : echo "<td> รับทราบแล้ว </td>";
      break;
  }
  echo "</tr>";
} 

echo "</table></p>
</section>
</li>";

/*-------รอรับทราบ(AM)---------*/
  $query2 = "SELECT * FROM sale_check_in 
  WHERE appove_status = '01' AND username = '".$_SESSION['USERNAME']."'

  ORDER BY id DESC
  ";
  $stmt2 = $conn->query( $query2 );

  echo "<li><a href='#'>รอรับทราบ(AM)</a>
  <section>
  <p>
  <table class='table_h6' >
  <tr>
  <th>วันที่</th>
  <th>โรงพยาบาล</th>
  <th>แผนก</th>
  <th>เข้าพบ</th>
  <th>รายละเอียดเข้าพบ</th>
  <th>sale</th>
  <th>สถานะการตรวจของ AM</th>
  </tr>";

  while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){

    echo "<td> ". date("d-m-Y H:i:s", strtotime($row2['chk_in'])) ." </td>";
    echo "<td> ".$row2['hospital']." </td>";
    echo "<td> ".$row2['department']." </td>";
    echo "<td> ".$row2['person']." </td>";
    echo "<td> ".$row2['info']." </td>";
    echo "<td> ".$row2['username']." </td>";
    switch ($row2['appove_status']) {
      case "1" : echo "<td> รอรับทราบ </td>";
      break;
      case "2" : echo "<td> รับทราบแล้ว </td>";
      break;
  }
  echo "</tr>";
} 

echo "</table></p>
</section>
</li>";

/*-------รับทราบแล้ว(AM)---------*/
  $query2 = "SELECT * FROM sale_check_in 
  WHERE appove_status = '02' AND username = '".$_SESSION['USERNAME']."'

  ORDER BY id DESC
  ";
  $stmt2 = $conn->query( $query2 );

  echo "<li><a href='#'>รับทราบแล้ว(AM)</a>
  <section>
  <p>
  <table class='table_h6' >
  <tr>
  <th>วันที่</th>
  <th>โรงพยาบาล</th>
  <th>แผนก</th>
  <th>เข้าพบ</th>
  <th>รายละเอียดเข้าพบ</th>
  <th>sale</th>
  <th>สถานะการตรวจของ AM</th>
  </tr>";

  while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){

    echo "<td> ". date("d-m-Y H:i:s", strtotime($row2['chk_in'])) ." </td>";
    echo "<td> ".$row2['hospital']." </td>";
    echo "<td> ".$row2['department']." </td>";
    echo "<td> ".$row2['person']." </td>";
    echo "<td> ".$row2['info']." </td>";
    echo "<td> ".$row2['username']." </td>";
    switch ($row2['appove_status']) {
      case "1" : echo "<td> รอรับทราบ </td>";
      break;
      case "2" : echo "<td> รับทราบแล้ว </td>";
      break;
  }
  echo "</tr>";
} 

echo "</table></p>
</section>
</li>";

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