<?php

ini_set('display_errors', '1');
ini_set('log_errors', '0');

try
{
    $db = new PDO('mysql:host=localhost;dbname=meetic;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

?>