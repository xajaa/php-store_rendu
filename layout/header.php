<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue !</title>
    <link rel="stylesheet" href="/assets/css/index.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="/categories.php">Catégories</a></li>
                <li><a href="/add-category.php">Nouvelle catégorie</a></li>
                <li><a href="/add-product.php">Nouveau produit</a></li>
                <?php
                session_start();
                if (isset($_SESSION['user_id'])) {
                    echo '<li><a href="/logout.php">Déconnexion</a></li>';
                } else {
                    echo '<li><a href="/login.php">Connexion</a></li>';
                    echo '<li><a href="/register.php">Inscription</a></li>';
                }
                ?>
            </ul>
        </nav>
        <?php
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
        ?>
        <div class="notification">
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php
        unset($_SESSION['message']);
        } ?>
    </header>
</body>

</html>
