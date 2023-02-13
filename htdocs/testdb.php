<?php
$servername = "192.168.0.250";
$username = "saintmed_it";
$password = "P@ssw0rd#1";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";
$conn->close();

for ($x = 0; $x <= 10; $x++) {
  echo "The number is: $x <br>";
}
?>