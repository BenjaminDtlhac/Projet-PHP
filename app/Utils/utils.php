<?php 

function checkAdmin(): void
{
    if (empty($_SESSION['user']) || !in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {
        $_SESSION['messages']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
    
        // On redirige vers la page de login
        header("Location: /login.php");
        exit(302);
    }
}