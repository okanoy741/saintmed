<?php
include "../SaleCheckIn/head.php";
include "../FDA/encode.php";
session_start();
$abr = $_SESSION['sales_code'];

require_once "../SaleCheckIn/conn.php";  // Using database connection file here
$query3 = "SELECT users.username, employee2.ID AS emp_id, employee2.manager_id_fk, employee2.team3_id_fk FROM users 
LEFT JOIN employee2 on users.sales_code = employee2.abr WHERE users.username = '".$_SESSION['USERNAME']." '";
$stmt3 = $conn2->query( $query3 );
while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
    $manager_id = $row3['manager_id_fk'];
    $emp_id = $row3['emp_id'];
    
    if ($row3['team3_id_fk'] <> NULL) {
        // code...
        $am_team3 = $row3['team3_id_fk'];
    }
    elseif ($row3['team3_id_fk'] == NULL){
        $am_team3 = "0";
    }

}


if (empty($_SESSION['USERNAME']) ) { 
 header("Location: ../SaleCheckIn/logininput.php?");
}
?>

<?php
include "head.php";
?>
<div class="grid3">
    <br><br>
    <p id ="headr2">รายการเข้าพบแพทย์ </p>
    <form name="search" action='../SaleCheckIn/search.php?' method="POST">

        <?php
        
        echo "<center>
        <div id=serchBox5>
        <input type='date' name='enc1' id='serchBox9'> 
        </div>  
        <div id=serchBox6> 
        <input type='text' name='enc2' id='serchBox9' placeholder='--- ชื่อพนักงาน/โรงพยาบาล/แผนก ---'> 
        </div>
        </center>
        <center>
        <input id='serchBox2' type='submit' value='ค้นหา'>
        <div  id='serchBox2'> <a href='../SaleCheckIn/indexAM.php'>ล้างค่า</a></div>  
        </center> <br>
        ";

        ?>
    </form>


    <div class="name-wrap">
        <a class="btn_req1" href=../SaleCheckIn/indexAM_chk.php?> ลงรายงาน </a>
    </div>   
</div>
<div class="grid3">
    <?php
    
    if (empty($_GET)) {
        // code...
        if ($am_team3 == 0) {
            // code...
            $query = "SELECT * FROM sale_check_in 
            WHERE appove_status = '01' AND (am_id = $emp_id ) 
            ORDER BY id DESC
            ";
        }
        elseif ($am_team3 <> 0) {
             // code...
            $query = "SELECT * FROM sale_check_in 
            WHERE appove_status = '01' AND (am_id_team3 = $am_team3 ) 
            ORDER BY id DESC
            ";
        }
        

        $stmt = $conn->query( $query );

        echo "<ul id='nav'>
        <li><a href='#'>รอรับทราบ(ลูกทีม)</a>
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
        <th>comment</th>
        <th></th>
        </tr>
        ";
        while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)){
          echo "<td> ". date("d-m-Y H:i:s", strtotime($row2['chk_in'])) ." </td>";
          echo "<td> ".$row2['hospital']." </td>";
          echo "<td> ".$row2['department']." </td>";
          echo "<td> ".$row2['person']." </td>";
          echo "<td style= width:30%;> ".$row2['info']." </td>";
          echo "<td> ".$row2['username']." </td>";
          switch ($row2['appove_status']) {
              case "1" : echo "<td> รอรับทราบ </td>";
              break;
              case "2" : echo "<td> รับทราบแล้ว </td>";
              break;
          }
          echo "
          <form action='../SaleCheckIn/appove.php?ID=".$row2['id']."' method='POST'>
          <td> <textarea name = 'comment'>".$row2['comment_am']."</textarea> </td>";
          echo "<td><input type='submit' value='รับทราบ'></td>";
          echo "</tr>";
      } 

      echo "</table>
      </p>
      </section>
      </li>
      ";
      /*-------รายการได้รับเลขแล้ว---------*/

      if ($am_team3 == 0) {
            // code...
        $query2 = "SELECT * FROM sale_check_in 
        WHERE appove_status = '02' AND (am_id = $emp_id ) 
        ORDER BY id DESC
        ";
    }
    elseif ($am_team3 <> 0) {
             // code...
        $query2 = "SELECT * FROM sale_check_in 
        WHERE appove_status = '02' AND (am_id_team3 = $am_team3 ) 
        ORDER BY id DESC
        ";
    }
    $stmt2 = $conn->query( $query2 );

    echo "<li><a href='#'>รับทราบแล้ว(ลูกทีม)</a>
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
    <th>AM comment</th>
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
      echo "<td> ".$row2['comment_am']." </td>";
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
  <th>comments</th>
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
  echo "<td> ".$row2['comment_am']." </td>";
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
<th>comments</th>
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
  echo "<td> ".$row2['comment_am']." </td>";
  echo "</tr>";
} 

echo "</table></p>
</section>
</li>";
}//-------- empty($_GET) -------


elseif (!empty($_GET)) {
        // code...
    $dec1=$_GET['enc1'];
    $dec2=$_GET['enc2'];

    if ($am_team3 == 0) {
            // code...
        if (!empty($dec1) && $dec2=="") {
        // code...
            $query = "SELECT * FROM sale_check_in 
            WHERE appove_status = '01' AND am_id = $emp_id AND (chk_in LIKE '%$dec1%')
            ORDER BY id DESC
            ";
        }
        elseif ($dec1=="" && !empty($dec2)) {
        // code...
            $query = "SELECT * FROM sale_check_in 
            WHERE appove_status = '01' AND am_id = $emp_id AND (username LIKE '%$dec2%')
            ORDER BY id DESC
            ";
        }
        elseif ($dec2<>"" && $dec1<>"") {
        // code...
            $query = "SELECT * FROM sale_check_in 
            WHERE appove_status = '01' AND am_id = $emp_id AND (chk_in LIKE '%$dec1%' AND (username LIKE '%$dec2%' OR hospital LIKE '%$dec2%' OR department LIKE '%$dec2%'))
            ORDER BY id DESC
            ";
        }
        elseif ($dec1 == NULL && $dec2 == NULL) {  
            $query = "SELECT * FROM sale_check_in 
            WHERE appove_status = '01' AND am_id = $emp_id
            ";
        }
    }
    elseif ($am_team3 <> 0) {
             // code...
        if (!empty($dec1) && $dec2=="") {
        // code...
            $query = "SELECT * FROM sale_check_in 
            WHERE appove_status = '01' AND am_id_team3 = $am_team3 AND (chk_in LIKE '%$dec1%')
            ORDER BY id DESC
            ";
        }
        elseif ($dec1=="" && !empty($dec2)) {
        // code...
            $query = "SELECT * FROM sale_check_in 
            WHERE appove_status = '01' AND am_id_team3 = $am_team3 AND (username LIKE '%$dec2%')
            ORDER BY id DESC
            ";
        }
        elseif ($dec2<>"" && $dec1<>"") {
        // code...
            $query = "SELECT * FROM sale_check_in 
            WHERE appove_status = '01' AND am_id_team3 = $am_team3 AND (chk_in LIKE '%$dec1%' AND (username LIKE '%$dec2%' OR hospital LIKE '%$dec2%' OR department LIKE '%$dec2%'))
            ORDER BY id DESC
            ";
        }
        elseif ($dec1 == NULL && $dec2 == NULL) {  
            $query = "SELECT * FROM sale_check_in 
            WHERE appove_status = '01' AND am_id_team3 = $am_team3
            ";
        }
    }
    

$stmt = $conn->query( $query );

echo "<ul id='nav'>
<li><a href='#'>รอรับทราบ(ลูกทีม)</a>
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
<th>comment</th>
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
  echo "<td> ".$row2['comment_am']." </td>";
  echo "<td><a href=\"../SaleCheckIn/appove.php?ID=".iconv('TIS-620', 'UTF-8',$row2['id'])."\"> รับทราบ </a></td>";
  echo "</tr>";
} 

echo "</table>
</p>
</section>
</li>
";
/*-------รายการได้รับเลขแล้ว---------*/
if ($am_team3 == 0) {
            // code...
        if (!empty($dec1) && $dec2=="") {
        // code...
            $query2 = "SELECT * FROM sale_check_in 
            WHERE appove_status = '02' AND am_id = $emp_id AND (chk_in LIKE '%$dec1%')
            ORDER BY id DESC
            ";
        }
        elseif ($dec1=="" && !empty($dec2)) {
        // code...
            $query2 = "SELECT * FROM sale_check_in 
            WHERE appove_status = '02' AND am_id = $emp_id AND (username LIKE '%$dec2%')
            ORDER BY id DESC
            ";
        }
        elseif ($dec2<>"" && $dec1<>"") {
        // code...
            $query2 = "SELECT * FROM sale_check_in 
            WHERE appove_status = '02' AND am_id = $emp_id AND (chk_in LIKE '%$dec1%' AND (username LIKE '%$dec2%' OR hospital LIKE '%$dec2%' OR department LIKE '%$dec2%'))
            ORDER BY id DESC
            ";
        }
        elseif ($dec1 == NULL && $dec2 == NULL) {  
            $query2 = "SELECT * FROM sale_check_in 
            WHERE appove_status = '02' AND am_id = $emp_id
            ";
        }
    }
    elseif ($am_team3 <> 0) {
             // code...
        if (!empty($dec1) && $dec2=="") {
        // code...
            $query2 = "SELECT * FROM sale_check_in 
            WHERE appove_status = '02' AND am_id_team3 = $am_team3 AND (chk_in LIKE '%$dec1%')
            ORDER BY id DESC
            ";
        }
        elseif ($dec1=="" && !empty($dec2)) {
        // code...
            $query2 = "SELECT * FROM sale_check_in 
            WHERE appove_status = '02' AND am_id_team3 = $am_team3 AND (username LIKE '%$dec2%')
            ORDER BY id DESC
            ";
        }
        elseif ($dec2<>"" && $dec1<>"") {
        // code...
            $query2 = "SELECT * FROM sale_check_in 
            WHERE appove_status = '02' AND am_id_team3 = $am_team3 AND (chk_in LIKE '%$dec1%' AND (username LIKE '%$dec2%' OR hospital LIKE '%$dec2%' OR department LIKE '%$dec2%'))
            ORDER BY id DESC
            ";
        }
        elseif ($dec1 == NULL && $dec2 == NULL) {  
            $query2 = "SELECT * FROM sale_check_in 
            WHERE appove_status = '02' AND am_id_team3 = $am_team3
            ";
        }
    }


$stmt2 = $conn->query( $query2 );

echo "<li><a href='#'>รับทราบแล้ว(ลูกทีม)</a>
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
<th>comments</th>
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
  echo "<td> ".$row2['comment_am']." </td>";
  echo "</tr>";
} 

echo "</table></p>
</section>
</li>";

/*-------รอรับทราบ(AM)---------*/
if (!empty($dec1) && empty($dec2)) {
        // code...
    $query2 = "SELECT * FROM sale_check_in 
    WHERE appove_status = '01'  AND username = '".$_SESSION['USERNAME']."' AND (chk_in LIKE '%$dec1%')
    ORDER BY id DESC
    ";
}
elseif (!empty($dec2) && empty($dec1)) {
        // code...
    $query2 = "SELECT * FROM sale_check_in 
    WHERE appove_status = '01' AND username = '".$_SESSION['USERNAME']."' AND (username LIKE '%$dec2%')
    ORDER BY id DESC
    ";
}
elseif (!empty($dec2) && !empty($dec1)) {
        // code...
    $query2 = "SELECT * FROM sale_check_in 
    WHERE appove_status = '01' AND username = '".$_SESSION['USERNAME']."' AND (chk_in LIKE '%$dec1%' AND (username LIKE '%$dec2%' OR hospital LIKE '%$dec2%' OR department LIKE '%$dec2%'))
    ORDER BY id DESC
    ";
}
elseif ($dec1 == NULL && $dec2 == NULL) {  
    $query2 = "SELECT * FROM sale_check_in 
    WHERE appove_status = '01'  AND username = '".$_SESSION['USERNAME']."' 
    ";
}

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
<th>comments</th>
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
  echo "<td> ".$row2['comment_am']." </td>";
  echo "</tr>";
} 

echo "</table></p>
</section>
</li>";

/*-------รับทราบแล้ว(AM)---------*/
if (!empty($dec1) && empty($dec2)) {
        // code...
    $query2 = "SELECT * FROM sale_check_in 
    WHERE appove_status = '02'  AND username = '".$_SESSION['USERNAME']."' AND (chk_in LIKE '%$dec1%')
    ORDER BY id DESC
    ";
}
elseif (!empty($dec2) && empty($dec1)) {
        // code...
    $query2 = "SELECT * FROM sale_check_in 
    WHERE appove_status = '02' AND username = '".$_SESSION['USERNAME']."' AND (username LIKE '%$dec2%')
    ORDER BY id DESC
    ";
}
elseif (!empty($dec2) && !empty($dec1)) {
        // code...
    $query2 = "SELECT * FROM sale_check_in 
    WHERE appove_status = '02' AND username = '".$_SESSION['USERNAME']."' AND (chk_in LIKE '%$dec1%' AND (username LIKE '%$dec2%' OR hospital LIKE '%$dec2%' OR department LIKE '%$dec2%'))
    ORDER BY id DESC
    ";
}
elseif ($dec1 == NULL && $dec2 == NULL) {  
    $query2 = "SELECT * FROM sale_check_in 
    WHERE appove_status = '02'  AND username = '".$_SESSION['USERNAME']."' "
    ;}
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
    <th>comments</th>
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
      echo "<td> ".$row2['comment_am']." </td>";
      echo "</tr>";
  } 

  echo "</table></p>
  </section>
  </li>";
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