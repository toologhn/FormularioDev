<?php
$host = 'localhost';
$db = 'formulariodevs';
$user = 'root';
$password = '';

try{
    $mysql = new PDO("mysql:host=$host;dbname=$db;charset=UTF8", $user, $password);
}
catch (PDOException $e){
    echo $e->getMessage();
}
