<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/ImageUpload.php';

class ProductService {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function associateImageWithProductFromForm($productId, $fileInputName, $targetDirectory) {
        // Créer une instance de la classe ImageUpload avec le répertoire cible des téléchargements
        $imageUploader = new ImageUpload($targetDirectory, $this->pdo);

        // Appeler la méthode uploadImage et capturer la réponse
        $imageFilePath = $imageUploader->uploadImage($fileInputName);

        // Vérifier le résultat du téléchargement
        if($imageFilePath !== false) {
            // Le téléchargement a réussi, associer l'image au produit dans la base de données
            return $this->associateImageWithProduct($productId, $imageFilePath);
        } else {
            // Le téléchargement a échoué, retourner false
            return false;
        }
    }

    private function associateImageWithProduct($productId, $imagePath) {
        try {
            // Préparation de la requête SQL pour mettre à jour le chemin de l'image du produit
            $sql = "UPDATE product SET cover = :imagePath WHERE id = :productId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':imagePath', $imagePath);
            $stmt->bindParam(':productId', $productId);
            
            $stmt->execute();

            return $stmt->rowCount() > 0; // Retourne true si au moins une ligne a été affectée
        } catch (PDOException $e) {
            return false; // Retourne false en cas d'erreur
        }
    }
}
?>
