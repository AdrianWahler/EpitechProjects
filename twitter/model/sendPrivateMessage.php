<?php

include "../model/database_connection.php";
session_start();
$correspondantID = $_POST["correspondantID"];
$message = $_POST["message"];

try{
    $statement = $db-> prepare("INSERT INTO `private_message`(`user_from`, `user_to`, `message`, `date`) 
    VALUES (?,?,?,CURRENT_TIMESTAMP)");
    $statement->execute([$_SESSION["userID"],$correspondantID,$message]);
    $lastId = $db->lastInsertId();

    if (isset($_FILES['image'])){
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $name = "imageMessage".$lastId.".".$imageFileType;

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            // Upload file
            if(move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$name)){
                // Insert record
                $imageStatement = $db-> prepare("INSERT INTO `message_image`(`message_id`, `Path`, `Date`) 
                VALUES (?,?,CURRENT_TIMESTAMP)");
                $imageStatement->execute([$lastId , "http://localhost/twitter/uploads/".$name]);
            }
        }
    }

    $statement = $db-> prepare("SELECT private_message.id, private_message.user_from, private_message.user_to, private_message.date, private_message.message,message_image.Path  
    FROM private_message LEFT JOIN message_image ON message_image.message_id = private_message.id 
    WHERE private_message.id = ?");
    $statement->execute([$lastId]);
    echo json_encode($statement->fetch());

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}