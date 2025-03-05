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


var_dump($db->query('SELECT * FROM users')->fetchAll());// FETCH all = tous les résultats de la base de donnée en tableau associatif. fetch = il prend la première occurence
