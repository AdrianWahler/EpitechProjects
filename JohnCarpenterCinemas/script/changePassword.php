<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $oldPassword = $_REQUEST['oldPassword'];
    $newPassword = $_REQUEST['newPassword'];
    $id = $_COOKIE["id"];
    echo $id;

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $sqlQuery = 'UPDATE user set password = MD5(:newPassword) where id = :id x;';
    $statement = $db->prepare($sqlQuery);
    $statement->execute(['newPassword' => $newPassword, 'id' => $id]);