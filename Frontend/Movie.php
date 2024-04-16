<?php

$servername = "localhost";
$username = "root";
$password = "";


try {
    
    $conn = new PDO("mysql:host=localhost", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $state = "CREATE DATABASE IF NOT EXISTS home";
    $conn->exec($state);

    
    $conn = null;

    
    $dsn = "mysql:host=localhost;dbname=home";
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
}


try {
    $use = "USE home";
    $db->exec($use);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
}

try {

    $querymovie = "SELECT * FROM movies";
    $mstates = $db->prepare($querymovie);
    $mstates->execute();
    $movieInfs = $mstates->fetchAll(PDO::FETCH_ASSOC); 
    $movieOnCheck = $mstates->rowCount();
    $mstates->closeCursor();


    $categoryQuery = "SELECT DISTINCT category FROM movies";
    $query2 = $db->prepare($categoryQuery);
    $query2->execute();
    $allCategories = $query2->fetchAll(PDO::FETCH_COLUMN); 
} catch (PDOException $e) {
    $error_message = $e->getMessage();
}
?>