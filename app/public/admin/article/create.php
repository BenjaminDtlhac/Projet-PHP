<?php

session_start();

require_once '/app/Utils/utils.php';
require_once '/app/Requests/articles.php';


checkAdmin();

// 1. Vérification si le formulaire est transmis. Inscrire dans le tableau POST en fonction de name
if (
    !empty($_POST['title'])
    && !empty($_POST['description'])
) {
    // 2. Nettoyage des données. Inscrire dans le tableau POST en fonction de name
    $title = strip_tags($_POST['title']);
    $description = strip_tags($_POST['description']);

    // 3. Créer une variable où sont tous les articles
    $titleExist = findOneArticleByTitle($title);

    if (!$titleExist) {
        // if
        $_SESSION['messages']['success'] = "Votre article a bien été créé";
        header("Location: /article.php");
        exit(302);
    } else {
        $errorMessage = "Une erreur est survenue lors de la création de votre article";
    }
} else {
    $errorMessage = "Email existant";
}


// 4. Créer une fonction pour créer un article
// 5. Comparer le nouvel article crée avec la variable contenant tous les articles
// 6. Si article existant => indiquer par message que l'article existe
// 7. Si article non existant, faire un message indiquant que l'article a été créé



?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des articles | My first app PHP</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require_once '/app/public/Layout/_header.php'; ?>
    <main>
        <?php require_once '/app/public/Layout/_messages.php'; ?>
        <section class="container mt-4">
            <h1 class="title text-center">Création d'un article</h1>
            <form action="/create.php" method="POST" class="card mt-4">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?= $errorMessage; ?>
                    </div><?php endif; ?>

                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title" required placeholder="Titre">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" required placeholder="description">
                </div>

                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </section>
    </main>
</body>

</html>