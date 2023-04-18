<?php

include "../model/database_connection.php";

try {

    $login = $_POST["login"];
    $password = $_POST["password"];
    $password = hash("ripemd160",$password."vive le projet tweet_academy");

    if(strpos($login, "@") !== false){
        $statement = $db->prepare("SELECT * FROM user where mail = ? and password = ?");
    } else {
        $statement = $db->prepare("SELECT * FROM user where handle = ? and password = ?");
    }
    
    $statement->execute([$login,$password]);
    $result = $statement->fetchAll();

    if ( count($result) == 1 ){
        session_start();
        $_SESSION['userID'] = $result[0]["id"];
        echo "true";
    } else {
        echo "false";
    }

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}