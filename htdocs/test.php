<?php
try {
$conn = new PDO("sqlsrv:Server=192.168.0.2;Database=sm","sa","$@intmed#1");
//$conn = new PDO("sqlsrv:Server=saintmed.dyndns.biz,10143;Database=new_intra","saintmed_it","P@ssw0rd#1");  
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "hell yeah!!!!";
}

catch (PDOException $e)
{
echo "Connection failed: ". $e->getMessage();
}
?>