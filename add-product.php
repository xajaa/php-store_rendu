<?php
require_once __DIR__ . '/classes/Categories.php';
require_once __DIR__ . '/classes/ImageUpload.php';
require_once __DIR__ . '/classes/ProductService.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/functions/checkLogin.php';

checkLoggedIn();

$fileInputName = "fileInput";
$targetDirectory = "uploads/";

if(isset($_POST["submit"]) && !empty($_FILES[$fileInputName]["name"])) {
    $database = new Database();
    $pdo = $database->getConnection();

    // Créer une instance de la classe ImageUpload avec le répertoire cible des téléchargements et la connexion PDO
    $imageUploader = new ImageUpload($targetDirectory, $pdo);

    // Appeler la méthode uploadImage et capturer le résultat
    $uploadResult = $imageUploader->uploadImage($fileInputName);

    if($uploadResult !== false) {
        $imageFilePath = $uploadResult;

        $productService = new ProductService($pdo);

        // Remplacez ceci par la logique appropriée pour récupérer l'ID du produit
        $productId = 1; 

        // Appeler la méthode associateImageWithProduct de ProductService pour associer l'image au produit dans la base de données
        $productService->associateImageWithProduct($productId, $imageFilePath);

        header("Location: add-product-success.php");
        exit();
    } else {
        $errorMessage = "Erreur: Une erreur s'est produite lors du téléchargement de l'image.";
    }
}
?>

<main>
    <h1>Nouveau produit</h1>

    <?php if (isset($errorMessage)) { ?>
    <p style="color: white; background-color: red;">
        <?php echo $errorMessage; ?>
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
