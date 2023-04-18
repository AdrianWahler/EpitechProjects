<?php
include '../model/userObject.php';

try {

    $testUser = new User(
        $_REQUEST["firstName"],
        $_REQUEST["lastName"],
        $_REQUEST["birthDate"],
        $_REQUEST["gender"],
        $_REQUEST["city"],
        $_REQUEST["email"],
        $_REQUEST["password"],
        $_REQUEST["hobbies"]
    );
    $testUser->addToDatabase();

    echo '';

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}
