<?php

function checkLoggedIn() {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
        header('Location: login.php');
        exit();
    }
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
}
?>
