<?php

    include_once "model/database_connection.php";
    session_start();

    $statement = $db->prepare("SELECT Path FROM profile_image WHERE id_user = ?");
    $statement->execute([$_SESSION["userID"]]);
    $source = $statement->fetch();

    echo "<img src='".$source["Path"]."' alt='Your profile picture'>";

?>