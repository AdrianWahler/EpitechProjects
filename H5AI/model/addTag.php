<?php

ini_set('display_errors', '1');
ini_set('log_errors', '0');

try
{
    $db = new PDO('mysql:host=localhost;dbname=h5ai;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$statement = $db->prepare("DELETE FROM `tags` WHERE `path` = ? and `filename` = ?");
$statement->execute([$_POST['path'],$_POST['file']]);

$statement = $db->prepare("INSERT INTO `tags`( `path`, `filename`,`tag`) VALUES (?,?,?)");
$statement->execute([$_POST['path'],$_POST['file'],$_POST['tag']]);