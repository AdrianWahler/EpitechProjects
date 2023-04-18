<?php
session_start();    
include_once '../script/serverConnection.php';

if(isset($_POST['portrait'])){
    $target_dir = "../assets/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $name = "portrait".$_SESSION['userID'].".".$imageFileType;

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){
         // Upload file
         if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
            // Insert record
            $sqlQuery = 'INSERT INTO portrait(name) value(?);';
            $statement = $db->prepare($sqlQuery);
            $statement->execute([$name]);

            $sqlQuery = 'SELECT id FROM portrait WHERE name=?';
            $statement = $db->prepare($sqlQuery);
            $statement->execute([$name]);
            $portraitID = $statement->fetch()['id'];

            $sqlQuery = 'UPDATE user SET portraitID=? WHERE id = ?';
            $statement = $db->prepare($sqlQuery);
            $statement->execute([$portraitID,$_SESSION['userID']]);
        }

    }
 
}

header("Location: ../userPage.php");
?>