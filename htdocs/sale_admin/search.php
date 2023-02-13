<?php
session_start();
try {
	include "../connect.php";  // Using database connection file here

	$item1 = iconv('UTF-8', 'TIS-620',$_POST['search']);
	//$item2 = iconv('UTF-8', 'TIS-620',$_POST['cl']);
	
		if(!empty($item1) && empty($item2)){
                        $query = "SELECT  employee2.ID,employee2.name,employee2.lastname
								FROM  employee2 
								where employee2.name LIKE '%$item1%' or employee2.lastname LIKE '%$item1%' 
                                  ";
						$stmt = $conn->query( $query );
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
							header("Refresh:0; url=../sale_admin/chk_projects.php?uname=$row[ID] ");
						}
						
						
	$stmt = null;
	$conn = null;
		}
		elseif(!empty($item2) && empty($item1)){
                        $query = "SELECT top 1 BplusData.ID,BplusData.AR_CODE, BplusData.AR_NAME, BplusData.ADDB_COMPANY
								FROM  BplusData 
								where BplusData.AR_NAME LIKE '%$item2%' or BplusData.ADDB_COMPANY LIKE '%$item2%' 
                                  ";
						$stmt = $conn->query( $query );
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
							//echo "$row[ID]";
							header("Refresh:0; url=../sale_admin/chk_projects.php?uname=$row[ID] ");
						}
						
						
	$stmt = null;
	$conn = null;
		}
	
}
	
catch (PDOException $e){
	echo "Connection failed: ". $e->getMessage();
}

?>