<?php 

class user
{
    function __construct($lastName,$firstName,$birthDate,$gender,$city,$email,$password,$hobbies) {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->city = $city;
        $this->email = $email;
        $this->password = $password;
        $this->hobbies = $hobbies;
    }

    function addToDatabase() {
        
        include "../script/serverConnection.php";

        $sqlQuery = "INSERT INTO `user`(`firstName`, `lastName`, `birthDate`, `gender`, `city`, `email`, `password`) 
        VALUES ( ? , ? , ? , ? , ? , ? , ? )";
        $statement = $db->prepare($sqlQuery);
        $statement->execute([$this->firstName,$this->lastName,$this->birthDate,$this->gender,$this->city,$this->email,MD5($this->password)]);

        $sqlQuery = "SELECT id FROM user where email = ?";
        $statement = $db->prepare($sqlQuery);
        $statement->execute([$this->email]);
        $result = $statement->fetchAll();
        $userId = $result[0]['id'];

        foreach ($this->hobbies as $key => $hobby) {
            $sqlQuery = "SELECT id FROM hobbies where name = ?";
            $statement = $db->prepare($sqlQuery);
            $statement->execute([$hobby]);
            $result = $statement->fetchAll();
            $hobbyId = $result[0]['id'];

            $sqlQuery = "INSERT INTO `user_hobbies`(`user_id`, `hobby_id`) VALUES (?,?)";
            $statement = $db->prepare($sqlQuery);
            $statement->execute([$userId,$hobbyId]);
        }
    }
}