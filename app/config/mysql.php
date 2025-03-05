<?php

try {
$dsn = "mysql:host=dataBase;dbname=Cours_php;charset=utf8mb4";

$db = new PDO(
    $dsn,
    'root',
    password:null,
    options: [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 

    ]
);
} catch (PDOException $e) {
    die("erreur de connexion à la base de donnée: {$error->getMessage()}");
}