<?php
require_once __DIR__ . 'ImageUpload.php';
require_once __DIR__ . 'Database.php';
class ProductService {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function associateImageWithProduct($productId, $imagePath) {
        try {
            // Préparation de la requête SQL pour mettre à jour le chemin de l'image du produit
            $sql = "UPDATE product SET cover = :imagePath WHERE id = :productId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':imagePath', $imagePath);
            $stmt->bindParam(':productId', $productId);
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {

            return false; 
        }
    }
    
}


if ($imageFilePath !== false) {
    $productService->associateImageWithProduct($productId, $imageFilePath);
    echo "L'image a été associée avec succès au produit.";
} else {
    echo "Une erreur s'est produite lors du téléchargement de l'image.";
}
?>
