<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $sqlQuery = 'SELECT user.id from user where email = :email and password = MD5(:password)';
    $statement = $db->prepare($sqlQuery);
    $statement->execute(['email' => $email, 'password' => $password]);
    $results = $statement->fetchAll();

    if (count($results) == 0){
        echo "false";
    } else {
        $userId = $results[0]['id'];

        $sqlQuery = 'SELECT id_job from employee where id_user = :id';
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['id' => $userId]);
        $results = $statement->fetchAll();

        if (count($results) > 0){
            if ($results[0]['id_job'] == 1){
                echo "employee,".$userId;
            } 
        } else {
            echo "user,".$userId;
        }
    }