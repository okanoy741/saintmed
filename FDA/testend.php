<?php

include "encode.php";
$testen1 = encrypted_url("6402510");
echo $testen1."<br>";
$testde1 = decrypted_url($testen1);
echo $testde1;

?>				
