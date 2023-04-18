<?php
include_once '../script/serverConnection.php';

$id = $_REQUEST['id'];
$statement = $db->prepare("SELECT hobbies.name FROM hobbies INNER JOIN user_hobbies ON hobby_id = user_hobbies.hobby_id WHERE user_hobbies.user_id = ?");
$statement->execute([$id]);


$result = $statement->fetchAll();
echo json_encode($result);