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
 * Récupère un uilisateur en BDD en filtrant par son ID
 * @param string $id ID de l'utilisateur à rechercher
 * @return bool| array
 */

function findOneUserById(int $id): bool|array
{
    global $db;

    $query = "SELECT * FROM users WHERE id = :id";

    $sql = $db->prepare($query);
    $sql->execute([
        'id' => $id
    ]);
    return $sql->fetch();
}




/**
 * Récupère un uilisateur en BDD en filtrant par son email
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




/**
 * Création d'un utilisateur en BDD 
 * Summary of createUser
 * @param string $firstName
 * @param string $lastName
 * @param string $email
 * @param string $password
 * @return bool true si en BDD false si erreur
 */

function createUser(string $firstName, string $lastName, string $email, string $password): bool
{
    global $db;

    try {

        $query = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";

        $sql = $db->prepare($query);
        $sql->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_ARGON2I),
        ]);
    } catch (PDOException $e) {
        return false;
    }

    return true;

}

/**
 * Met à jour un utilisateur en BDD
 * @param int $id
 * @param string $firstName
 * @param string $lastName
 * @param string $email
 * @param null|string $password
 * @return bool
 */
function updateUser(int $id, string $firstName, string $lastName, string $email, ?string $password): bool
{
    // UPDATE users SET first_name = 
    global $db;
    $query = "UPDATE users SET first_name = :firstName, last_name = :lastName, email = :email";

    $params = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
    ];


    if (!empty($password)) {
        $query .= ", password = :password";
        $params["password"] = password_hash($password, PASSWORD_ARGON2I);
    }

    $query .= " WHERE id = :id";
    $params['id'] = $id;

    try {
        $sql = $db->prepare($query);
        $sql->execute($params);
    } catch (PDOException $e) {
        // var_dump($e->getMessage());
        return false;
    }
    return true;
}

function deleteUser(int $id): bool
{
    global $db;
    //DELETE FROM users WHERE id = :id;
    $query = 'DELETE FROM users WHERE id = :id';

    try {
        $sql = $db->prepare($query);
        $sql->execute([
            'id' => $id,
        ]);
    } catch (PDOException $e) {
        return false;
    }
    return true;
}