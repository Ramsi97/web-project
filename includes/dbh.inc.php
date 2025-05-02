<?php

$dbh = "mysql:host=localhost;dbname=contact_form_db";
$dbusername ="root";
$dbpwd = "";

$username = $_POST["uname"];
$email = $_POST["email"];
$text = $_POST["text"];


try{

    $pdo = new PDO($dbh, $dbusername, $dbpwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "INSERT INTO submissions (name, email, message) VALUES(?, ?, ?);";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $email, $text]);

    $pdo = null;
    $stmt = null;
    header("Location: ../example.html");
    
}catch(PDOException $e){
    echo $e->getMessage();
}

