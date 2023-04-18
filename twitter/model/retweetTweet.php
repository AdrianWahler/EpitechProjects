<?php

include "../model/database_connection.php";
session_start();
$tweetID = $_POST["tweetID"];
$userID = $_SESSION["userID"]; 

try{
    $statement = $db-> prepare("SELECT * FROM `retweet` WHERE user_id = ? AND tweet_id = ?");
    $statement->execute([$userID,$tweetID]);
    $result = $statement->fetchAll();

    if (count($result) == 0){
        $statement = $db-> prepare("INSERT INTO `retweet`(`user_id`, `tweet_id`) VALUES (?,?)");
        $statement->execute([$userID,$tweetID]);
        echo "Tweet ".$tweetID." retweeted by ".$userID;
    } else {
        $statement = $db-> prepare("DELETE FROM `retweet` WHERE user_id = ? AND tweet_id = ?");
        $statement->execute([$userID,$tweetID]);
        echo "Tweet ".$tweetID." unretweeted by ".$userID;
    }

} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}