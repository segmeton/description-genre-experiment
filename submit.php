<?php 

$input_data = $_POST;

// BU = Bangkok University
// ICE = ICE Lab
$session = '.BU.'

$filename = $input_data["user-id"] . $session . time() . '.txt';

$myfile = fopen('raw_data/' . $filename, "w") or die("Unable to open file!");
foreach ($input_data as $key => $value)
{
    $line = $key . " : " . $value . "\n";
    fwrite($myfile, $line);
}

fclose($myfile);