<?php

$file = "currency.json";

$data = file_get_contents($file);

header("Content-Type: application/json");

echo $data;

?>