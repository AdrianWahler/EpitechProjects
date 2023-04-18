<?php

include "../model/database_connection.php";
session_start();

try{
    $statement = $db-> prepare("SELECT * FROM `tweet` INNER JOIN user on tweet.user_id = user.id
    WHERE tweet.id = ?");
    $statement->execute([$_POST["tweetID"]]);

    $result = $statement->fetchAll();
    echo json_encode($result);

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}