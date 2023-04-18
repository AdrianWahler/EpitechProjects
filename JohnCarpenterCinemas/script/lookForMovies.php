<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $movieName = $_REQUEST['movieName'];
    $movieName = "%$movieName%";
    
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    
    $sqlQuery = 'SELECT id,title FROM movie WHERE title LIKE :movieName ORDER BY release_date DESC';
    $movieStatement = $db->prepare($sqlQuery);
    $movieStatement->execute(['movieName' => $movieName]);
    $movies = $movieStatement->fetchAll();

    echo    "<table class='table table-striped table-condensed'>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th></th>
            </tr>";
    foreach ($movies as $key => $movie) {
        echo    "<tr>
                    <td>".$movie['id']."</td>
                    <td>".$movie['title']."</td>
                    <td><button class='btn btn-primary' onclick='setIdField(".$movie['id'].")'>Select</button></td>
                </tr>";
    }
    echo "</table>";