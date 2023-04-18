<?php

include "../model/database_connection.php";
session_start();

try{

    $statement = $db-> prepare("SELECT Path from tweet_image WHERE tweet_id = ?");
    $statement->execute([$_POST["tweetID"]]);

    $result = $statement->fetchAll();
    echo json_encode($result);

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}