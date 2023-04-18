<?php

include "../model/database_connection.php";
session_start();
$handle = $_POST['handle'];

try{
    $statement = $db->prepare("SELECT id FROM `user`
    WHERE handle = ?");
    $statement->execute([$handle]);
    $result = $statement->fetchAll();

    echo json_encode($result);

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}