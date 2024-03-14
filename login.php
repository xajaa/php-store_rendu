<?php
require_once __DIR__ . '/classes/User.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $user = new User();
    $loggedInUser = $user->login($login, $password);
    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['id'];
        $_SESSION['login'] = $loggedInUser['login'];
        header('Location: add-category.php');
        exit;
    } else {
        echo "Identifiants incorrects.";
    }
}
?>

<form action="login.php" method="post">
    <input type="text" name="login" placeholder="Login" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>

<?php require_once __DIR__ . '/layout/footer.php';
