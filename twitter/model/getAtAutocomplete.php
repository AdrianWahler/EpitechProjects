<?php

include "../model/database_connection.php";
session_start();
$userInput = "%".$_POST["userInput"]."%";

try{
    $statement = $db-> prepare("SELECT user.handle,user.username,profile_image.Path FROM user 
    INNER JOIN profile_image ON user.id = profile_image.id_user WHERE handle like ?");
    $statement->execute([$userInput]);
    $result = $statement->fetchAll();
    echo json_encode($result);

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}