<?php
require_once __DIR__ . '/classes/User.php';

// Vérifier si la méthode de requête est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password === $confirmPassword) {
        $user = new User();
        if ($user->register($login, $password)) {
            // Rediriger vers la page précédente
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
        } else {
            echo "Une erreur s'est produite lors de l'inscription.";
        }
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }
}
?>

<form action="register.php" method="post">
    <input type="text" name="login" placeholder="Login" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>

<?php

?>
<?php require_once __DIR__ . '/layout/footer.php';