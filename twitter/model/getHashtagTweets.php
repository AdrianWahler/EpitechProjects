<?php

include "../model/database_connection.php";
session_start();

try{
    $statement = $db-> prepare("SELECT * FROM `tweet` 
    INNER JOIN user ON tweet.user_id = user.id
    INNER JOIN hashtag ON hashtag.tweet_id = tweet.id
    INNER JOIN profile_image ON profile_image.id_user = tweet.user_id
    WHERE hashtag.hashtag_name = :hashtag ORDER BY tweet.date DESC LIMIT :pos,10");
    $db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
    $statement->bindValue(':hashtag', $_POST["hashtag"], PDO::PARAM_STR);
    $statement->bindValue(':pos', intval(trim($_POST["position"])), PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetchAll();
    echo json_encode($result);

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}