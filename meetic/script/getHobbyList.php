<?php

    include_once '../script/serverConnection.php';

    $listOfGenre = "";

    $sqlQuery = 'SELECT DISTINCT `name` FROM `hobbies`;';
    $statement = $db->prepare($sqlQuery);
    $statement->execute();
    $genres = $statement->fetchAll();

    echo "<option value=''></option><br>;";
    foreach ($genres as $key => $genre) {
        echo "<option value='".$genre['name']."'>".$genre['name']."</option><br>;";
    }
