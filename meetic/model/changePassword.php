<?php 

    session_start();
    include_once '../script/serverConnection.php';
    $password = $_REQUEST["password"];

    try {
        $sqlQuery = 'UPDATE `user` SET `password` = MD5(?) WHERE id = ?;';
        $statement = $db->prepare($sqlQuery);
        $statement->execute([$password,$_SESSION['userID']]);
        $result = $statement->fetchAll();
    } catch (\Error $e) {
        http_response_code(500);
        echo $e->getMessage();
    }