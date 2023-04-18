<?php

    $sessionId = $_REQUEST['sessionId'];
    $clientId = $_REQUEST['clientId'];

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $sqlQuery = 'INSERT INTO `membership_log`(`id_membership`, `id_session`) VALUES (:clientId,:sessionId)';
    $movieStatement = $db->prepare($sqlQuery);
    $movieStatement->execute(['clientId' => $clientId,'sessionId' => $sessionId]);
    $movies = $movieStatement->fetchAll();
