<?php
include "head.php";
?>
<div class="grid1">
  <div class="banner2">
    <img class="logo" src="../img/saintmed_logo.png"><p>PRE-REQ.</p>
    <p><BR></p>
  </div> 
</div>
<?php
include "connect.php";  // Using database connection file here
$query = "SELECT * , statusReq.sid,employee2.name,employee2.lastname,employee2.id as EID
FROM ((projects_pre LEFT JOIN statusReq 
	ON projects_pre.ap_status = statusReq.sid)
LEFT JOIN employee2 
ON projects_pre.employee_id_fk = employee2.id)
where projects_pre.employee_id_fk = ".$_GET['eid']." AND  ap_status <> 16 AND ap_status <> 13 OR ap_status IS NULL 
ORDER BY projects_pre.ap_status DESC
";
$stmt = $conn->query( $query );

echo "<ul id='nav'>
<li><a href='#'>Pre-req</a>
<section>
<p><table class='table_h6' >
<tr>
<th>No.</th>
<th>โรงพยาบาล</th>
<th>ราคาต่อเครื่อง</th>
<th>จำนวน</th>
<th>ราคา (เครื่อง)</th>
<th>ผู้รับผิดชอบ</th>
<th>Preview req</th>
</tr>
";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo "<td> </td>";
	echo "<td style= width:25%;>"
	.iconv('TIS-620', 'UTF-8',$row['cl'])." "."<br>".iconv('TIS-620', 'UTF-8',$row['project_desc']);
	"</td>";
	echo "<td style= width:15%;>". number_format($row['unitprice']) ."</td>";
	echo "<td >". $row['unitnum'] ."</td>";
	echo "<td >". number_format($row['unitprice']) ."</td>";
	echo "<td style= width:30%;>". iconv('TIS-620', 'UTF-8',$row['name']) ." ". iconv('TIS-620', 'UTF-8',$row['lastname']) ."</td>";
	echo "<td style= width:15%;><a href=\"edit_prereq.php?ID=". $row['ID']."&PID=". $row['info']."\"> Preview/Edit </a></td>";
	echo "</tr>";
} 

echo "</table>
</p>
</section>
</li>
</ul>";

/*<li><a href='#'>Item 2</a>
<section>
<p>ไม่พบข้อมูล</p>
</section>
</li>
*/

?>

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