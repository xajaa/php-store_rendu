<?php
require_once __DIR__ . '/classes/Categories.php';
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/functions/uploadImage.php';

$fileInputName = "fileInput"; 
$targetDirectory = "uploads/"; 

// Vérifier si le formulaire a été soumis et si un fichier a été téléchargé
if(isset($_POST["submit"]) && !empty($_FILES[$fileInputName]["name"])) {
    // Appeler la fonction uploadImage et capturer la réponse
    $productId = 1; // Remplacez ceci par l'ID du produit approprié
    $uploadResult = uploadImage($fileInputName, $targetDirectory, $productId);

    // Vérifier le résultat du téléchargement
    if($uploadResult["success"]) {
        // Le téléchargement a réussi, vous pouvez enregistrer le produit dans la base de données avec le chemin de l'image
        $imageFilePath = $uploadResult["filePath"];
        // Code pour enregistrer le produit dans la base de données avec $imageFilePath
    } else {
        // Le téléchargement a échoué, afficher le message d'erreur
        echo "<p style='color: white; background-color: red;'>Erreur: " . $uploadResult["message"] . "</p>";
    }
}
?>

<main>
    <h1>Nouveau produit</h1>

    <?php if (isset($_GET['error'])) { ?>
    <p style="color: white; background-color: red;">
        Erreur: <?php echo intval($_GET['error']); ?>
    </p>
    <?php } ?>

    <?php
    $categoriesDb = new Categories();
    $categories = $categoriesDb->findAll();
    ?>

    <form action="add-product-process.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" />
        </div>
        <div>
            <label for="price">Prix :</label>
            <input type="text" name="price" id="price" />
        </div>
        <div>
            <label for="fileInput">Image :</label>
            <input type="file" name="fileInput" id="fileInput" />
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div>
            <select name="category" id="category">
                <option value="0">--- Choisissez une catégorie ---</option>
                <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category['id']; ?>">
                    <?php echo $category['name']; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div>
            <input type="submit" name="submit" value="Enregistrer" />
        </div>
    </form>
</main>

<?php require_once __DIR__ . '/layout/footer.php'; ?>
