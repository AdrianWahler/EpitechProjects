<?php

include "../model/database_connection.php";
session_start();

try{
    $statement = $db-> prepare("SELECT user.handle,user.username,profile_image.Path FROM user 
    INNER JOIN profile_image ON user.id = profile_image.id_user 
    INNER JOIN tweet ON user.id = tweet.user_id
    GROUP BY user.handle ORDER BY tweet.date DESC LIMIT 20");
    $statement->execute();
    $users = $statement->fetchAll();
    $usersRecommended = [];

    $count = 0;
    while ($count <= 2){
        $selection = random_int(0,count($users)-1);
        if (!in_array($users[$selection],$usersRecommended)){
            $count++;
            array_push($usersRecommended,$users[$selection]);
        }
    }

    $statement = $db-> prepare("SELECT hashtag_name FROM hashtag ORDER BY tweet_id DESC LIMIT 20;");
    $statement->execute();
    $hashtags = $statement->fetchAll();
    $hashtagsRecommended = [];

    $count = 0;
    while ($count <= 2){
        $selection = random_int(0,count($hashtags)-1);
        if (!in_array($hashtags[$selection],$hashtagsRecommended)){
            $count++;
            array_push($hashtagsRecommended,$hashtags[$selection]);
        }
    }

    $recommendations = [$usersRecommended,$hashtagsRecommended];
    echo json_encode($recommendations);


} catch (\Error $e) {

    http_response_code(500);
    echo $e->getMessage();

}