<?php

$conn = new PDO("sqlsrv:Server=saintmed.dyndns.biz,10143;Database=mantest","saintmed_it","P@ssw0rd#1");
//$conn = new PDO("sqlsrv:Server=saintmed.dyndns.biz,10143;Database=new_intra","saintmed_it","P@ssw0rd#1");	 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



?>