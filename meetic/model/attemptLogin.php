<?php   
    session_start();

    include_once '../script/serverConnection.php';
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    try {
        $sqlQuery = 'SELECT * FROM user WHERE email = ? AND password = MD5(?) AND enabled = true';
        $statement = $db->prepare($sqlQuery);
        $statement->execute([$email,$password]);
        $result = $statement->fetchAll();
    } catch (\Error $e) {
        http_response_code(500);
        echo $e->getMessage();
    }

    if (count($result) == 1){
        echo "true";
        $_SESSION['userID'] = $result[0]['id'];
    } else {
        echo "false";
    }