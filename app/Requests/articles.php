<?php

require_once '/app/config/mysql.php';

// Je crée une fonction afin de récupérer un article en fonction de son ID
function findOneArticleByTitle(string $title): bool|array
{
    global $db;
    $sql = $db->prepare("SELECT * FROM articles WHERE title = :title");
    $sql->execute([
        'title' => $title
    ]);

    return $sql->fetch();
}

function createArticle ($title, $description)
{



}