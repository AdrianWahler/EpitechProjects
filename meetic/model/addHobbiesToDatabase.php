<?php

    include_once '../script/serverConnection.php';
    $hobby = $_REQUEST["hobby"];

    try {
        $sqlQuery = 'SELECT * FROM hobbies WHERE name = ?';
        $statement = $db->prepare($sqlQuery);
        $statement->execute([$hobby]);
        $result = $statement->fetchAll();
    } catch (\Error $e) {
        http_response_code(500);
        echo $e->getMessage();
    }

    if (count($result) == 0){
        $sqlQuery = 'INSERT INTO `hobbies`(`name`) VALUES (?)';
        $statement = $db->prepare($sqlQuery);
        $statement->execute([$hobby]);
    }