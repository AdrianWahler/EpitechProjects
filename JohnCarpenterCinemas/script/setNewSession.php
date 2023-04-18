<?php

    function movieIdValid($id){

        try
        {
            $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

        $sqlQuery = 'SELECT * FROM movie WHERE id = :id';
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['id' => $id]);
        $results = $statement->fetchAll();

        return (count($results) == 1) ? true : false ;
    }

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $date = $_REQUEST['date'];
    $movieId = $_REQUEST['movieId'];
    $movieName = $_REQUEST['movieName'];
    $room = $_REQUEST['room'];

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    if ($movieId != ""){
        if (movieIdValid($movieId)) {
            $sqlQuery = 'INSERT INTO `movie_schedule`(`id_movie`, `id_room`, `date_begin`) VALUES (:movie,:room,:date)';
            $statement = $db->prepare($sqlQuery);
            $statement->execute(['date' => $date, 'movie' => $movieId, 'room' => $room]);
        } else {
            echo "No movie found for this ID.";
            die();
        }
    } else if ($movieName != "") {
        $sqlQuery = 'SELECT * FROM movie WHERE title LIKE :title';
        $statement = $db->prepare($sqlQuery);
        $movieName = "%$movieName%";
        $statement->execute(['title' => $movieName]);
        $results = $statement->fetchAll();

        if (count($results) == 0) {
            echo "No movie matches search.";
            die();
        } else if (count($results) > 1) {
            echo "More than one movie matches search.";
            die();
        } else {
            $sqlQuery = 'INSERT INTO `movie_schedule`(`id_movie`, `id_room`, `date_begin`) VALUES (:movie,:room,:date)';
            $statement = $db->prepare($sqlQuery);
            $statement->execute(['movie' => $results[0]['id'],'room' => $room,'date' => $date]);
        }
    }

    echo "Session created!";
