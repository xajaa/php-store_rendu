<?php
require_once __DIR__ . '/classes/Products.php';
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/functions/checkLogin.php';

checkLoggedIn();

?>

<h1>Bienvenue</h1>

<?php
$productsDb = new Products();
$products = $productsDb->findAll();
var_dump($products);
?>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

<main>
    <h1>Nouveau produit</h1>

    <!-- Votre formulaire ici -->

    <?php

    if (isset($imageFilePath) && !empty($imageFilePath)) {
        echo "<img src='{$imageFilePath}' alt='Image du produit'>";
    } else {
        echo "Aucune image disponible";
    }
    ?>
</main>
<?php
require_once __DIR__ . '/classes/Products.php';
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/functions/checkLogin.php';

checkLoggedIn();

// Supposons que $imageFilePath contienne le chemin de l'image à afficher

?>

<h1>Bienvenue</h1>

<?php
$productsDb = new Products();
$products = $productsDb->findAll();
var_dump($products);
?>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

<main>
    <h1>Nouveau produit</h1>

    <!-- Votre formulaire ici -->

    <?php

    if (isset($imageFilePath) && !empty($imageFilePath)) {
        echo "<img src='{$imageFilePath}' alt='Image du produit'>";
    } else {
        echo "Aucune image disponible";
    }
    ?>
</main>
