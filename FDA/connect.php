<?php

$conn = new PDO("sqlsrv:Server=192.168.0.2;Database=it_project","sa","$@intmed#1");
//$conn = new PDO("sqlsrv:Server=saintmed.dyndns.biz,10143;Database=new_intra","saintmed_it","P@ssw0rd#1");	 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dbName = "D:/saintmedmirror/data/SM.mdb";
$conn2 = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};;Dbq=$dbName; charset=UTF-8");
$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>



