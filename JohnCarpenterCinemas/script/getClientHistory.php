<?php

ini_set('display_errors', '1');
ini_set('log_errors', '0');
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];

try
{
    $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if ($firstName != "" && $lastName != ""){
   
    $sqlQuery = 'SELECT user.id,user.firstname,user.lastname,membership.id as membId FROM user INNER JOIN membership ON user.id = membership.id_user
        WHERE firstname LIKE :firstname AND lastname LIKE :lastname;';
    $statement = $db->prepare($sqlQuery);
    $statement->execute(['firstname' => $firstName, 'lastname' => $lastName]);
    $userResult = $statement->fetchAll();

} else if ($firstName != "") {

    $sqlQuery = 'SELECT user.id,user.firstname,user.lastname,membership.id as membId FROM user INNER JOIN membership ON user.id = membership.id_user 
        WHERE firstname LIKE :firstname';
    $statement = $db->prepare($sqlQuery);
    $statement->execute(['firstname' => $firstName]);
    $userResult = $statement->fetchAll();

} else if ($lastName != ""){

    $sqlQuery = 'SELECT user.id,user.firstname,user.lastname,membership.id as membId FROM user INNER JOIN membership ON user.id = membership.id_user 
        WHERE lastname LIKE :lastname';
    $statement = $db->prepare($sqlQuery);
    $statement->execute(['lastname' => $lastName]);
    $userResult = $statement->fetchAll();

}

if (!isset($userResult)){

    echo "No name entered.";
    die();

}
if (count($userResult) == 0) {

    echo "No user found or user has no membership.";

} else if (count($userResult) > 1) {

    echo "More than one user found";

} else {

    $sqlQuery = 'SELECT movie.title,movie_schedule.date_begin,membership.id as meId, movie.id
    FROM membership INNER JOIN `user` ON membership.id_user = user.id 
    INNER JOIN membership_log ON membership_log.id_membership = membership.id
    INNER JOIN movie_schedule ON membership_log.id_session = movie_schedule.id 
    INNER JOIN movie ON movie.id = movie_schedule.id_movie 
    WHERE user.id = :id
    ORDER BY movie_schedule.date_begin DESC';
    $statement = $db->prepare($sqlQuery);
    $statement->execute(['id' => $userResult[0]['id']]);
    $movieResult = $statement->fetchAll();

    if (count($movieResult) == 0){
        echo "<table class='table table-striped table-condensed'>
                <tr>
                    <th>Title</th>
                    <th>Seen on</th>
                    <th>Movie ID</th>
                </tr>
                <tr>
                    <th><input style='width:50%' type='text' placeholder='Session ID'></th>
                    <th colspan='2'><button class='btn btn-primary p1' onclick='addSessionToClient(".$userResult[0]['membId'].",\"".$userResult[0]['firstname']."\",\"".$userResult[0]['lastname']."\")'>Add session</button></th>
                </tr>
                <tr>
                    <th colspan='3'>This user does not have any viewing history...</th>
                </tr>
                </table>";
        die();
    }

    echo    "<table class='table table-striped table-condensed'>
            <tr>
                <th>Title</th>
                <th>Seen on</th>
                <th>Movie ID</th>
            </tr>
            <tr>
                <th><input id='sessionId' style='width:50%' type='text' placeholder='Session ID'></th>
                <th colspan='2'><button class='btn btn-primary p1' onclick='addSessionToClient(".$userResult[0]['membId'].",\"".$userResult[0]['firstname']."\",\"".$userResult[0]['lastname']."\")'>Add session</button></th>
            </tr>";
    foreach ($movieResult as $key => $result) {
        echo    "<tr>
            <td>".$result['title']."</td>
            <td>".$result['date_begin']."</td>
            <td>".$result['id']."</td>
        </tr>";
    }

    echo "</table>";
}