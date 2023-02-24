<?php
$dbName2 = "D:/saintmedmirror/data/b2.mdb";
$conn2 = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};;Dbq=$dbName2");
$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>