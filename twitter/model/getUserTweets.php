<?php

include "../model/database_connection.php";
session_start();

try{

    $statement = $db->prepare("SELECT id FROM `user` WHERE handle = ?");
    $statement->execute([$_POST["handle"]]);
    $result = $statement->fetchAll();

    if (count($result) != 0){

        $statement = $db-> prepare("SELECT * FROM `tweet` 
        LEFT JOIN retweet ON retweet.tweet_id = tweet.id 
        INNER JOIN user ON tweet.user_id = user.id 
        LEFT JOIN profile_image ON profile_image.id_user = tweet.user_id 
        WHERE tweet.user_id = :id OR retweet.user_id = :id GROUP BY tweet.id ORDER BY tweet.date DESC LIMIT :pos,10");
        $db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        $statement->bindValue(':id', intval(trim($result[0]["id"])), PDO::PARAM_INT);
        $statement->bindValue(':pos', intval(trim($_POST["position"])), PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll();
        echo json_encode($result);
    }

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}