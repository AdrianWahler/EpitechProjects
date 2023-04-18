<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $userId = $_REQUEST['clientID'];
    $newSub = $_REQUEST['newSub'];

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $sqlQuery = 'SELECT * FROM membership WHERE id_user = :id';
    $statement = $db->prepare($sqlQuery);
    $statement->execute(['id' => $userId]);
    $results = $statement->fetchAll();

    $sqlQuery = 'SELECT id FROM subscription WHERE name = :name';
    $statement = $db->prepare($sqlQuery);
    $statement->execute(['name' => $newSub]);
    $newSubId = $statement->fetchAll();
    $newSubId = $newSubId[0]['id'];

    if (count($results) == 0) {

        $sqlQuery = "INSERT INTO `membership`(`id_user`, `id_subscription`) VALUES (:userId,:subId)";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['userId' => $userId,'subId' => $newSubId]);

    } else if ($newSub != "none") {

        $sqlQuery = "UPDATE `membership` SET `id_subscription`=:subId WHERE `id_user` = :userId;";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['userId' => $userId,'subId' => $newSubId]);

    } else {

        $sqlQuery = "DELETE FROM `membership_log` WHERE `id_membership` = :membId";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['membId' => $results[0]['id']]);

        $sqlQuery = "DELETE FROM `membership` WHERE `id_user` = :userId";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['userId' => $userId]);
        
    }