<?php
session_start();

// Déconnexion de l'utilisateur en supprimant toutes les données de session
session_unset();
session_destroy();

// Redirection vers la page d'accueil ou toute autre page de votre choix
header("Location: /");
exit();
?>
