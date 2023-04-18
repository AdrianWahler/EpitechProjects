<?php
try{

    session_start();
    extract($_POST);
    include "../model/database_connection.php";
    
    if ($username != ''){
        $statement = $db->prepare("UPDATE user SET username = ? WHERE id = ?");
        $statement->execute([$username,$_SESSION["userID"]]);
    }
    
    if ($firstname != ''){
        $statement = $db->prepare("UPDATE user SET firstname = ? WHERE id = ?");
        $statement->execute([$firstname,$_SESSION["userID"]]);
    }
    if ($lastname != ''){
        $statement = $db->prepare("UPDATE user SET lastname = ? WHERE id = ?");
        $statement->execute([$lastname,$_SESSION["userID"]]);
    }
    if ($email != ''){
        $statement = $db->prepare("UPDATE user SET mail = ? WHERE id = ?");
        $statement->execute([$email,$_SESSION["userID"]]);
    }
    if ($city != ''){
        $statement = $db->prepare("UPDATE user SET city = ? WHERE id = ?");
        $statement->execute([$city,$_SESSION["userID"]]);
    }
    if ($bio != ''){
        $statement = $db->prepare("UPDATE user SET bio = ? WHERE id = ?");
        $statement->execute([$bio,$_SESSION["userID"]]);
    }
    if ($password != ''){
        $statement = $db->prepare("UPDATE user SET password = ? WHERE id = ?");
        $statement->execute([hash("ripemd160",$password),$_SESSION["userID"]]);
    }


} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}