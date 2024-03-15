<?php
require_once __DIR__ . '/Database.php';

class ImageUpload {
    private $targetDirectory;
    private $pdo;

    public function __construct($targetDirectory, $pdo) {
        $this->targetDirectory = $targetDirectory;
        $this->pdo = $pdo;
    }

    public function uploadImage($fileInputName) {
        if(isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
            $imageFileType = strtolower(pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION));
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
            if(in_array($imageFileType, $allowedExtensions)) {
                $currentTimestamp = time();
                $uniqueFilename = $currentTimestamp . '_' . $_FILES[$fileInputName]['name'];
                $targetPath = $this->targetDirectory . $uniqueFilename;
                if(move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetPath)) {
                    $imageUrl = $this->getBaseUrl() . $uniqueFilename; // Construire l'URL de l'image
                    $this->insertImageNameIntoDatabase($imageUrl); // Insérer l'URL de l'image dans la base de données
                    return $imageUrl;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function insertImageNameIntoDatabase($imageUrl) {
        $sql = "INSERT INTO product (cover) VALUES (:imageUrl)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':imageUrl', $imageUrl);
        $stmt->execute();
    }

    private function getBaseUrl() {
        // Récupérer le protocole et le nom de domaine de l'URL actuelle
        $baseUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
        $baseUrl .= $_SERVER['HTTP_HOST'] . '/';
        return $baseUrl;
    }
}
?>
