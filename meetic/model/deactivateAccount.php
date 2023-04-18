<?php 

    session_start();
    include_once '../script/serverConnection.php';

    try {
        $sqlQuery = 'UPDATE `user` SET `enabled` = 0 WHERE id = ?;';
        $statement = $db->prepare($sqlQuery);
        $statement->execute([$_SESSION['userID']]);
    } catch (\Error $e) {
        http_response_code(500);
        echo $e->getMessage();
    }
    
    session_destroy();