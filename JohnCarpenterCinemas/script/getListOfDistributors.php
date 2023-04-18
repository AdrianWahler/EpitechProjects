<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $listOfDistributor = "";

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $sqlQuery = 'SELECT DISTINCT `name` FROM `distributor`;';
    $statement = $db->prepare($sqlQuery);
    $statement->execute();
    $distributors = $statement->fetchAll();

    foreach ($distributors as $key => $distributor) {
        echo "<option value='".$distributor['name']."'>".$distributor['name']."</option><br>;";
    }

    echo $listOfDistributor;
    