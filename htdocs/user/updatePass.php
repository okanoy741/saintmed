<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Contact Filter</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--Materialize css cdn use-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<script>
		document.onkeydown=function(evt){
			var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
			if(keyCode == 13)
			{
            //your function call here
            document.search.submit();
      }
}
</script>

</head>

<body>
	<div class="container">
		<h1 class="center-align">
			Contact List
		</h1>
		<form name="search" action='userserch.php?' method="POST">
			<input name="search" type="text" id="serchBox" placeholder="Search Name">
		</form>
		<ul class="collection width-header" id="names">

			<li class="nameItem">

				<?php
                        require_once "../connect.php";  // Using database connection file here
                        if (empty($_GET)) {
                        	echo "ไม่พบข้อมูลพนักงาน <br>";
                        	echo "<a href='http://saintmed.dyndns.biz:10898/user/user.php?'> back </a>  ";
                              $stmt = null;
                              $conn = null;

                        } 




                        elseif (!empty($_GET)) {
                        	$query2 = "SELECT users.username , users.pswd , users.name , users.lastname ,employee2.abr, employee2.emloffice, employee2.uid
                        	FROM (users LEFT JOIN employee2
                             ON users.sales_code = employee2.abr)
                             WHERE users.name Like '%".$_GET['uid']."%'  or users.username Like '%".$_GET['uid']."%'
                             ";
                             $stmt2 = $conn->query( $query2 );
                             echo "<table class='table_h' >
                             <tr>
                             <th>รหัสพนักงาน</th>
                             <th>username</th>
                             <th>password</th>
                             <th>ชื่อ</th>
                             <th>นามสกุล</th>
                             <th>email</th>


                             </tr>";

                             while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                  echo "<td >". iconv('TIS-620','UTF-8' ,$row2['uid']) ."</td>";
                                  echo "<td >". iconv('TIS-620','UTF-8' ,$row2['username']) ."</td>";
                                  echo "<td >". "UPDATE_ " . 
                                  "<form action='../user/updatePass2.php?uid=".$row2['username']."' method='POST' >
                                  <input type='text' name ='passW' placeholder='Password'  style= width:40%; required></input>
                                  <input type='submit' name ='submit'  style= width:20%; ></input>
                                  " .

                                  "</td>";
                                  echo "<td >". iconv('TIS-620','UTF-8' ,$row2['name']) ."</td>";
                                  echo "<td >". iconv('TIS-620','UTF-8' ,$row2['lastname']) ."</td>";
                                  echo "<td >". $row2['emloffice'] ."</td>";


                                  echo "</tr>";

                            } 
                            echo "</table>"; 
                            echo "<a href='http://saintmed.dyndns.biz:10898/user/user.php?'> BACK </a>	";
                            $stmt = null;
                            $stmt2 = null;
                            $conn = null;
                      }   

                      ?>
                </li>

          </ul>
    </div>
    <script src="../user/userjs.js"></script>
</body>

</html>