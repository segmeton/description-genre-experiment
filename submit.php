<?php 

$input_data = $_POST;

$filename = $input_data["user-id"] . '.BU.' . time() . '.txt';

$myfile = fopen('data/' . $filename, "w") or die("Unable to open file!");
foreach ($input_data as $key => $value)
{
    $line = $key . " : " . $value . "\n";
    fwrite($myfile, $line);
}

fclose($myfile);