<?php

include '../model/database_connection.php';
session_start();
var_dump(count($_FILES));
var_dump($_FILES);


if (isset($_FILES['file'])){
    for ($i=0; $i < count($_FILES); $i++) { 
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        var_dump($target_file);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $name = "banner".$_SESSION["userID"]."-".$i.".".$imageFileType;

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            // Upload file
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
                // Insert record
                $sqlQuery = 'UPDATE `banner` SET `Path`= ? WHERE id_user = ?';
                $statement = $db->prepare($sqlQuery);
                $statement->execute(["http://localhost/twitter/uploads/".$name,$_SESSION["userID"]]);
            }

        }
    }
}

?>