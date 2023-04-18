<?php

include "../model/database_connection.php";
session_start();
$correspondantID = $_POST["correspondantID"];

try{
    $statement = $db-> prepare("SELECT * FROM ( 
    
        SELECT private_message.id, private_message.user_from, private_message.user_to, private_message.date, private_message.message,message_image.Path 
        FROM private_message LEFT JOIN message_image ON message_image.message_id = private_message.id 
        WHERE private_message.user_from = ? AND private_message.user_to = ?
        
        UNION SELECT private_message.id, private_message.user_from, private_message.user_to, private_message.date, private_message.message,message_image.Path  
        FROM private_message LEFT JOIN message_image ON message_image.message_id = private_message.id 
        WHERE private_message.user_from = ? AND private_message.user_to = ? 

        ) as Z ORDER by Z.date ASC");
    $statement->execute([$_SESSION["userID"],$correspondantID,$correspondantID,$_SESSION["userID"]]);
    $result = $statement->fetchAll();

    echo json_encode($result);

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}
