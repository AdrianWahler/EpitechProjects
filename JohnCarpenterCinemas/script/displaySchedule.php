<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $date = $_REQUEST['date'];

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $sqlQuery = 'SELECT movie.title,CAST(date_begin AS TIME) as "hour" FROM movie_schedule INNER JOIN movie ON movie.id = movie_schedule.id_movie
    WHERE CAST(date_begin AS DATE) = :date
    ORDER BY date_begin ASC'; 
    $statement = $db->prepare($sqlQuery);
    $statement->execute(['date' => $date]);
    $results = $statement->fetchAll();

    echo "<table class='table table-striped table-condensed'>
    <tr>
        <th>Movies for ".$date."</th>
        <th>Starts at</th>
    </tr>";
    foreach ($results as $key => $result) {
        echo    "<tr>
            <td>".$result['title']."</td>
            <td>".$result['hour']."</td>
        </tr>";
    }
    echo "</table>";