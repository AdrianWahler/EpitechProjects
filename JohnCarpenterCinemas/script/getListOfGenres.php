<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $listOfGenre = "";

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $sqlQuery = 'SELECT DISTINCT `name` FROM `genre`;';
    $statement = $db->prepare($sqlQuery);
    $statement->execute();
    $genres = $statement->fetchAll();

    foreach ($genres as $key => $genre) {
        echo "<option value='".$genre['name']."'>".$genre['name']."</option><br>;";
    }

    echo $listOfGenre;
