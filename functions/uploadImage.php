<?php
function uploadImage($fileInputName, $targetDirectory, $productId) {
    $response = array("success" => false, "message" => "");

    $fileName = basename($_FILES[$fileInputName]["name"]);
    $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Générer un nom de fichier unique en ajoutant un timestamp
    $uniqueFileName = $productId . '_' . time() . '.' . $imageFileType;
    $targetFile = $targetDirectory . $uniqueFileName;

    // Vérifier si le fichier est une image
    $check = getimagesize($_FILES[$fileInputName]["tmp_name"]);
    if($check === false) {
        $response["message"] = "Le fichier n'est pas une image.";
        return $response;
    }

    // Vérifier si un fichier avec le même nom existe déjà
    if (file_exists($targetFile)) {
        $response["message"] = "Désolé, un fichier avec le même nom existe déjà.";
        return $response;
    }

    // Vérifier la taille du fichier
    if ($_FILES[$fileInputName]["size"] > 500000) {
        $response["message"] = "Désolé, le fichier est trop volumineux.";
        return $response;
    }

    // Autoriser certains formats de fichiers
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $response["message"] = "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        return $response;
    }

    // Déplacer le fichier téléchargé vers le répertoire cible avec le nom unique
    if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
        $response["success"] = true;
        $response["message"] = "Le fichier " . htmlspecialchars($fileName) . " a été téléchargé.";
        $response["filePath"] = $targetFile;
    } else {
        $response["message"] = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
    }

    return $response;
}
?>
