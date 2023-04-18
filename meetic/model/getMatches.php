<?php
include_once '../script/serverConnection.php';

if (isset($_REQUEST['hobbies'])){
    $hobbies = $_REQUEST['hobbies'];
}
if (isset($_REQUEST['cities'])){
    $cities = $_REQUEST['cities'];
}
if (isset($_REQUEST['genderArray'])){
    $genderArray = $_REQUEST['genderArray'];
}
$ageRange = $_REQUEST['ageRange'];
$options = [];

$whereInitiated = false;

$query = 'SELECT *, GROUP_CONCAT(hobbies.name) AS hobbies FROM user 
INNER JOIN user_hobbies ON user.id = user_hobbies.user_id 
INNER JOIN hobbies ON hobbies.id = user_hobbies.hobby_id 
LEFT JOIN portrait ON portrait.id = user.portraitID';

if (isset($hobbies)){
    $whereInitiated = true;
    $query .= " WHERE hobbies.name IN(";
    foreach ($hobbies as $key => $hobby) {
        $query .= "?,";
        $options[] = $hobby;
    }
    $query = rtrim($query, ",").")";
}

if (isset($cities)) {
    if ($whereInitiated){
        $query .= " AND";
    } else {
        $query .= " WHERE";
        $whereInitiated = true;
    }
    $query .= " user.city IN (";
    foreach ($cities as $key => $city) {
        $query .= "?,";
        $options[] = $city;
    }
    $query = rtrim($query, ",").")";
}

if (isset($genderArray)) {
    if ($whereInitiated){
        $query .= " AND";
    } else {
        $query .= " WHERE";
        $whereInitiated = true;
    }
    $query .= " user.gender IN (";
    foreach ($genderArray as $key => $gender) {
        $query .= "?,";
        $options[] = $gender;
    }
    $query = rtrim($query, ",").")";
}

if ($whereInitiated){
    $query .= " AND";
} else {
    $query .= " WHERE";
    $whereInitiated = true;
}

switch ($ageRange) {
    case "none":
        $query .= " DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),user.birthDate)), '%Y') + 0 BETWEEN 18 AND 9999";
        break;

    case "18/25":
        $query .= " DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),user.birthDate)), '%Y') + 0 BETWEEN 18 AND 25";
        break;

    case "25/35":
        $query .= " DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),user.birthDate)), '%Y') + 0 BETWEEN 25 AND 35";
        break;

    case "35/45":
        $query .= " DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),user.birthDate)), '%Y') + 0 BETWEEN 35 AND 45";
        break;

    case "45+":
        $query .= " DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),user.birthDate)), '%Y') + 0 BETWEEN 45 AND 9999";
        break;
}

$query .= " AND user.enabled = 1 GROUP BY user.id";

$statement = $db->prepare($query);
$statement->execute($options);
$result = $statement->fetchAll();
echo json_encode($result);