<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $lastName = "%$lastName%";
    $firstName = "%$firstName%";
    
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
        
    if ($firstName != "" && $lastName != ""){
   
        $sqlQuery = 'SELECT * FROM user WHERE firstname LIKE :firstname AND lastname LIKE :lastname;';
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['firstname' => $firstName, 'lastname' => $lastName]);
        $results = $statement->fetchAll();

    } else if ($firstName != "") {

        $sqlQuery = 'SELECT * FROM user WHERE firstname LIKE :firstname';
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['firstname' => $firstName]);
        $results = $statement->fetchAll();

    } else if ($lastName != ""){

        $sqlQuery = 'SELECT * FROM user WHERE lastname LIKE :lastname';
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['lastname' => $lastName]);
        $results = $statement->fetchAll();

    }

    if (isset($results)) {
        if (count($results) == 0){
            echo "No results found :c";
            die();
        }
    } else {
        echo "No results found :c";
        die();
    }

    echo    "<table class='table table-striped table-condensed'>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>User ID</th>
                <th></th>
            </tr>";

    foreach ($results as $key => $result) {
        echo    "<tr>
            <td>".$result['firstname']."</td>
            <td>".$result['lastname']."</td>
            <td>".$result['id']."</td>
            <td><button class='btn btn-primary' onclick='getClientHistory(\"".$result['firstname']."\",\"".$result['lastname']."\")'>Check History</button></td>
        </tr>";
    }

    echo "</table>";
