<?php

session_start();

// Vérification si le formulaire est soumis et que les champs obligatoires ne sont pas vides
// var_dump($_POST);

require_once '/app/Requests/users.php';

if (
    !empty($_POST['firstName'])
    && !empty($_POST['lastName'])
    && !empty($_POST['email'])
    && !empty($_POST['password'])
) {
    //Nettoyer les données : faille XSS
    $firstName = strip_tags($_POST['firstName']);
    $lastName = strip_tags($_POST['lastName']);
    $email = strip_tags($_POST['email']);
    $password = $_POST['password'];

    // Vérification des contraintes SQL

    $userExist = findOneUserByEmail($email);

    if (!$userExist) {
        if (createUser($firstName, $lastName, $email, $password)) {
            // Définir un message de success
            $_SESSION['messages']['success'] = "Votre compte a bien été créé";
            header("Location: /login.php");
            exit(302);
        } else {
            $errorMessage = "Une erreur est survenue lors de la création de votre compte";
        }

    } else {
        $errorMessage = "Email existant";
    }
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire | My first app PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
    <?php require_once '/app/public/Layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="title text-center">S'inscrire</h1>
            <form action="/register.php" method="POST" class="card mt-4">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage; ?>
                    </div><?php endif; ?>
                <div class="form-group">
                    <label for="firstName">Prénom</label>
                    <input type="text" name="firstName" id="firstName" required placeholder="John">
                </div>
                <div class="form-group">
                    <label for="lastName">Nom</label>
                    <input type="text" name="lastName" id="lastName" required placeholder="Doe">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required placeholder="email">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required placeholder="S3CR3T">
                </div>

                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>
        </section>
    </main>
</body>

</html>