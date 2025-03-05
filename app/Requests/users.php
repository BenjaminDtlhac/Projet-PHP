<?php

require_once '/app/config/mysql.php';

/**
 * 
 * Récupérer tous les utilisateurs en BDD
 * @return array
 */

function findAllUsers(): array
{
    global $db;
    // $query = "SELECT * FROM users";//Faire la requête 

    // $sql = $db->query($query);

    // return $sql->fetchAll();

    return $db  
    ->query('SELECT * FROM users')
    ->fetchAll();
}

/**
 * Récupère un tuilisateur en BDD en filtrant par son email
 * @param string $email Email de l'utilisateur à rechercher
 * @return bool| array
 */

function findOneUserByEmail(string $email): bool|array
{
   
    global $db;
    // $sql = $db->query("SELECT * FROM users WHERE email = '$email'"); NE PAS FAIRE CAR IL DOIT VERIFIER CE QUE l'utilisateur inscrit

    $sql = $db->prepare("SELECT * FROM users WHERE email = :email");
    $sql->execute([
        'email' => $email
    ]);

    return $sql->fetch();

    
}

