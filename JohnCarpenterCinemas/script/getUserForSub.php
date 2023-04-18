<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');
    $firstName = $_REQUEST['firstName'];
    $firstName = "%$firstName%";
    $lastName = $_REQUEST['lastName'];
    $lastName = "%$lastName%";
    $numberOfIds = 0;
    
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
        
    if ($firstName != "" && $lastName != ""){
   
        $sqlQuery = 'SELECT user.firstname,user.lastname,user.id,subscription.name 
        from user left join membership on user.id = membership.id_user 
        left join subscription on subscription.id = membership.id_subscription
        WHERE firstname LIKE :firstname AND lastname LIKE :lastname;';
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['firstname' => $firstName, 'lastname' => $lastName]);
        $userResults = $statement->fetchAll();

    } else if ($firstName != "") {

        $sqlQuery = 'SELECT user.firstname,user.lastname,user.id,subscription.name 
        from user left join membership on user.id = membership.id_user 
        left join subscription on subscription.id = membership.id_subscription
        WHERE firstname LIKE :firstname';
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['firstname' => $firstName]);
        $userResults = $statement->fetchAll();

    } else if ($lastName != ""){

        $sqlQuery = 'SELECT user.firstname,user.lastname,user.id,subscription.name 
        from user left join membership on user.id = membership.id_user 
        left join subscription on subscription.id = membership.id_subscription
        WHERE lastname LIKE :lastname';
        $statement = $db->prepare($sqlQuery);
        $statement->execute(['lastname' => $lastName]);
        $userResults = $statement->fetchAll();

    }

    $subQuery = 'SELECT name FROM subscription';
    $subStatement = $db->prepare($subQuery);
    $subStatement->execute();
    $subResults = $subStatement->fetchAll();

    if (isset($userResults)) {
        if (count($userResults) == 0){
            echo "No results found :c";
            die();
        }
    } else {
        echo "No results found :c";
        die();
    }

    foreach ($userResults as $key => $result) {
        echo    "<table class='align-middle table table-striped table-condensed'>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>User ID</th>
            <th>Current Subscription</th>
        </tr>
        <tr>
            <td>".$result['firstname']."</td>
            <td>".$result['lastname']."</td>
            <td id='id".$numberOfIds."'>".$result['id']."</td>";

            if ($result['name'] == ""){
                echo "<td>None</td>";
            } else {
                echo "<td>".$result['name']."</td>";
            }

            echo "</tr>
            <tr>
            <td>
            <select id='newSubType".$numberOfIds."'>
            <option value='none'>None</option>";
                    
        foreach ($subResults as $key => $result) {
            echo "<option value=\"".$result['name']."\">".$result['name']."</option>";
        }

        echo "</select><td>
            <td colspan='3'><button class='btn btn-primary' onclick='changeSub($numberOfIds)'>Change Subscription</button>
            </td></tr>";

        $numberOfIds++;
    }

    echo "</table>";