<?php

include '../model/database_connection.php';
session_start();

if ($_POST['responseTo'] != "") {
    $commentOf = $_POST['responseTo'];
} else {
    $commentOf = NULL;
}

$statement = $db->prepare("INSERT INTO `tweet`(`user_id`, `date`, `content`,`comment_of`) VALUES (?,CURRENT_TIMESTAMP,?,?)");
$statement->execute([$_SESSION['userID'],$_POST['tweet'],$commentOf]);
$lastId = $db->lastInsertId();

$hashtags = [];
preg_match_all('/(?<=#)\w*/',$_POST['tweet'], $hashtags);
var_dump($hashtags);

foreach ($hashtags[0] as $key => $hashtag) {
    $statement = $db->prepare("INSERT INTO `hashtag`(`tweet_id`, `hashtag_name`) VALUES (?,?)");
    $statement->execute([$lastId,$hashtag]);
}

$mentions = [];
preg_match_all('/(?<=@)\w*/',$_POST['tweet'], $mentions);
var_dump($mentions);

foreach ($mentions[0] as $key => $mention) {
    $statement = $db->prepare("SELECT id FROM `user` WHERE handle = ?");
    $statement->execute([$mention]);
    $mentionnedUserID = $statement->fetch();
    
    if (count($mentionnedUserID) != 0) {
        $statement = $db->prepare("INSERT INTO `mention`(`tweet_id`,`mentionned_user_id`,`user_id`) VALUES (?,?,?)");
        $statement->execute([$lastId,$mentionnedUserID["id"],$_SESSION["userID"]]);
    }
}

if (isset($_FILES['file'])){
    for ($i=0; $i < count($_FILES["file"]["name"]); $i++) { 
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"][$i]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $name = "imageTweet".$lastId."-".$i.".".$imageFileType;

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            // Upload file
            if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$target_dir.$name)){
                // Insert record
                $sqlQuery = 'INSERT INTO `tweet_image`(`tweet_id`, `Path`) VALUES (?,?)';
                $statement = $db->prepare($sqlQuery);
                $statement->execute([$lastId,"http://localhost/twitter/uploads/".$name]);
            }

        }
    }
}

header("Location: https://localhost/twitter/homepage.php");
die();

?>