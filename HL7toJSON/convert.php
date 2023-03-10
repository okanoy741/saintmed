<?php
require_once '../HL7toJSON/hl7_parser_library.php'; // include the HL7 parser library

// read in HL7 message from file
$hl7_message = file_get_contents('../HL7toJSON/VS900-Spot_Check.hl7');

// parse HL7 message
$hl7_parser = new HL7_Parser();
$parsed_message = $hl7_parser->parse($hl7_message);

// extract desired fields from message and store in array
$data_array = array(
    'patient_id' => $parsed_message[3][0][0],
    'patient_name' => $parsed_message[5][0][0],
    'diagnosis' => $parsed_message[8][0][0],
    'notes' => $parsed_message[8][1][0]
);

// convert array to JSON object
$json_data = json_encode($data_array);

// write JSON object to file
file_put_contents('path/to/output.json', $json_data);
?>