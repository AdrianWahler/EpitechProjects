<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $movieName = $_REQUEST['movieName'];
    $genreName = $_REQUEST['genreName'];
    $distribName = $_REQUEST['distribName'];
    $movieName = "%$movieName%";
    
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    
    $sqlQuery = 'SELECT movie.id,movie.title,movie.release_date FROM movie 
    INNER JOIN movie_genre ON movie.id = movie_genre.id_movie 
    INNER JOIN genre on genre.id = movie_genre.id_genre
    INNER JOIN distributor ON distributor.id = movie.id_distributor
    WHERE movie.title LIKE :movieName ';

    if ($genreName != "") {
        $sqlQuery .= 'AND genre.name = "'.$genreName.'"';
    }

    if ($distribName != "") {
        $sqlQuery .= 'AND distributor.name = "'.$distribName.'"';
    }
    $sqlQuery .= 'ORDER BY title ASC';

    $movieStatement = $db->prepare($sqlQuery);
    $movieStatement->execute(['movieName' => $movieName]);
    $movies = $movieStatement->fetchAll();

    echo    "<table class='table table-striped table-condensed'>
            <tr>
                <th>Title</th>
                <th>Release Date</th>
                <th>Movie ID</th>
            </tr>";
    foreach ($movies as $key => $movie) {
        echo    "<tr>
                    <td>".$movie['title']."</td>
                    <td>".$movie['release_date']."</td>
                    <td>".$movie['id']."</td>
                </tr>";
    }
    echo "</table>";