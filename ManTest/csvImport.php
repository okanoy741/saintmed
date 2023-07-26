<?php

$path_parts = "ManTest/uploads/data ";
if(!is_dir("ManTest/uploads/data/")){

}
elseif(is_dir("ManTest/uploads/data/")){
    if ($handle = opendir($path_parts)) {
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
          echo "<a href= '..ManTest/uploads/data/$entry' target='_blank'>- $entry <br></a>";

      }
  }
  closedir($handle);
}
}
echo " <form action='uploads.php?' method='post' enctype='multipart/form-data'> <br>";
echo " <a href=\"delete_upload.php?\"> <div class='del_up'>Delete File</div></a>";
echo "   <input type='file' name='fileToUpload' id='fileToUpload'>";
echo "   <input type='submit' value='Upload File' name='submit' id='fileToUpload'>";
echo " </form>";

$csvFile = '../ManTest/uploads/data.csv';
$data = [];

if (($handle2 = fopen($csvFile, "r")) !== false) {
    while (($row = fgetcsv($handle2, 1000, ",")) !== false) {
        $Account = $row[0];
        $Zone = $row[1];
        $Province = $row[2];
        $InternetType = $row[3];
        $StreamingTV = $row[4];
        $FaultPowerOutagePerMonth = $row[5];
        $FaultCableCutPerMonth = $row[6];

        $data[] = array(
            'Account' => $Account,
            'Zone' => $Zone,
            'Province' => $Province,
            'InternetType' => $InternetType,
            'StreamingTV' => $StreamingTV,
            'FaultPowerOutagePerMonth' => $FaultPowerOutagePerMonth,
            'FaultCableCutPerMonth' => $FaultCableCutPerMonth
        );
    }

    fclose($handle2);
}

$jsonData = json_encode($data);

require_once "../ManTest/connect.php";

$sql = "INSERT INTO technical_test VALUES ('$jsonData')";

if ($conn->query($sql) === false) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

echo "success";
$conn->close();
?>