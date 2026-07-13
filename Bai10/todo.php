<?php

$file = "todos.json";


$data = [];


if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input = json_decode(file_get_contents("php://input"), true);


    if ($input["action"] == "add") {

        $data[] = [
            "task" => $input["task"],
            "done" => false
        ];
    }


    if ($input["action"] == "delete") {

        unset($data[$input["id"]]);

        $data = array_values($data);
    }


    if ($input["action"] == "done") {

        $data[$input["id"]]["done"] =
            !$data[$input["id"]]["done"];
    }



    file_put_contents(
        $file,
        json_encode($data)
    );
}



header("Content-Type: application/json");

echo json_encode($data);
