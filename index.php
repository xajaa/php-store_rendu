<?php
require_once __DIR__ . '/classes/Products.php';
require_once __DIR__ . '/layout/header.php';
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
    // Supposons que $imageFilePath contient le chemin de l'image stockée dans la base de données
    // Si $imageFilePath contient le chemin absolu du fichier sur le serveur, vous pouvez simplement l'utiliser dans l'attribut src de l'élément img
    if (isset($imageFilePath) && !empty($imageFilePath)) {
        echo "<img src='{$imageFilePath}' alt='Image du produit'>";
    } else {
        echo "Aucune image disponible";
    }
    ?>
</main>
