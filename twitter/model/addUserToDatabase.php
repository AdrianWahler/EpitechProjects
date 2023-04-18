<?php

include "../model/database_connection.php";

try {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $password = hash("ripemd160",$_POST["password"]."vive le projet tweet_academy");
    $birthDate = $_POST["birthDate"];
    $email = $_POST["email"];
    $handle = $_POST["handle"];


    $query = ("INSERT INTO 
    `user`(`birthdate`, 
    `firstname`, 
    `lastname`, 
    `mail`, 
    `password`, 
    `username`, 
    `handle`,
    `bio`,
    `theme`,
    `city`,
    `created_date`) 
    VALUES 
    (?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP);");

    $statement = $db->prepare($query);
    $statement->execute([$birthDate,
    $firstName,
    $lastName,
    $email,
    $password,
    $handle,
    $handle,
    "",
    "",
    ""]);
    
    $query = "SELECT * from user WHERE mail = ?";
    $statement = $db->prepare($query);
    $statement->execute([$email]);
    $result = $statement->fetchAll();
    $id = $result[0]["id"];

    $query = "INSERT INTO `profile_image`(`id_user`, `Path`) VALUES (?,'http://localhost/twitter/uploads/default.png')";
    $statement = $db->prepare($query);
    $statement->execute([$id]);

    $query = "INSERT INTO `banner`(`user_id`, `Path`) VALUES (?,'http://localhost/twitter/uploads/defaultBanner.png')";
    $statement = $db->prepare($query);
    $statement->execute([$id]);

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}

