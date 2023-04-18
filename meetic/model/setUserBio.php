<?php 

    session_start();
    include_once '../script/serverConnection.php';
    $bio = $_REQUEST["bio"];

    try {
        $sqlQuery = 'UPDATE `user` SET `description` = ? WHERE id = ?;';
        $statement = $db->prepare($sqlQuery);
        $statement->execute([$bio,$_SESSION['userID']]);
        $result = $statement->fetchAll();
    } catch (\Error $e) {
        http_response_code(500);
        echo $e->getMessage();
    }