<?php
require_once __DIR__ . 'Database.php';
class ImageUpload {
    private $targetDirectory;

    public function __construct($targetDirectory) {
        $this->targetDirectory = $targetDirectory;
    }

    public function ImageUpload($fileInputName) {
        if(isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
            $imageFileType = strtolower(pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION));
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
            if(in_array($imageFileType, $allowedExtensions)) {
                $currentTimestamp = time();
                $uniqueFilename = $currentTimestamp . '_' . $_FILES[$fileInputName]['name'];
                $targetPath = $this->targetDirectory . $uniqueFilename;
                if(move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetPath)) {
                    return $targetPath;
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
}
?>
