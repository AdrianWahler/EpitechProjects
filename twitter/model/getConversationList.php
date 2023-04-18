<?php

include "../model/database_connection.php";
session_start();

try{
    $statement = $db-> prepare("SELECT * 
    FROM (
        SELECT user.id,user.handle,user.username,profile_image.Path,date,message FROM user 
        INNER JOIN profile_image ON user.id = profile_image.id_user 
        JOIN private_message ON private_message.user_to = user.id
        WHERE private_message.user_from = ?
        
        UNION SELECT user.id,user.handle,user.username,profile_image.Path,date,message FROM user 
        INNER JOIN profile_image ON user.id = profile_image.id_user 
        JOIN private_message ON private_message.user_from = user.id
        WHERE private_message.user_to = ? ORDER BY date DESC) AS Z 
       group by Z.id ORDER by Z.date DESC;");
    $statement->execute([$_SESSION["userID"],$_SESSION["userID"]]);
    $result = $statement->fetchAll();

    $newResult = [];

    foreach ($result as $key => $user) {
        if ($user["id"] != $_SESSION["userID"]){
            array_push($newResult,$user);
        }
    }

    echo json_encode($newResult);

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}