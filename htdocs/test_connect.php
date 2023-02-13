

<?php
try {
//$conn = new PDO("sqlsrv:Server=192.168.0.6,1433;Database=new_intra","saintmed_it","P@ssw0rd#1");
$conn = new PDO("sqlsrv:Server=saintmed.dyndns.biz,10143;Database=new_intra","saintmed_it","P@ssw0rd#1");	 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch (PDOException $e)
{
echo "Connection failed: ". $e->getMessage();
}
?>



<?php
$dbName = "D:/Saintmedmillor/data/SM.mdb";

try {
    $conn = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};;Dbq=$dbName");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: ".$e->getMessage()."<br />";
}

?>