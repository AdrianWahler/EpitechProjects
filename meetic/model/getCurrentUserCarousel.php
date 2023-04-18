<?php
session_start();
include_once '../script/serverConnection.php';

$query = 'SELECT *, GROUP_CONCAT(hobbies.name) AS hobbies FROM user 
INNER JOIN user_hobbies ON user.id = user_hobbies.user_id 
INNER JOIN hobbies ON hobbies.id = user_hobbies.hobby_id 
LEFT JOIN portrait ON portrait.id = user.portraitID
WHERE user.id = ?';

$statement = $db->prepare($query);
$statement->execute([$_SESSION['userID']]);
$result = $statement->fetch();
echo json_encode($result);