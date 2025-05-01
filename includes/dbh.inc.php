<?php


$dbh = "mysql:host=localhost;dbname:contact_form_db";
$dbusername ="root";
$dbpwd = "";

$username = $_POST["uname"];
$email = $_POST["email"];
$text = $_POST["text"];
echo $username;
echo $email;
echo $text;

try{

    $pdo = new PDO($dbh, $dbusername, $dbpwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){

    echo $e->getMessage();

}

