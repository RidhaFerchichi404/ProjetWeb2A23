<?php
// Vérifier si un fichier a été téléchargé
if (isset($_FILES['photo'])) {
    // Répertoire de destination pour le téléchargement du fichier
    $uploadDir = 'C:\Users\Rami\Desktop\front\View\img';

    // Informations sur le fichier téléchargé
    $fileName = $_FILES['photo']['name'];
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $fileSize = $_FILES['photo']['size'];
    $fileError = $_FILES['photo']['error'];

    // Vérifier s'il n'y a pas d'erreur lors du téléchargement
    if ($fileError === UPLOAD_ERR_OK) {
        // Déplacer le fichier téléchargé vers le répertoire de destination
        $destination = $uploadDir . $fileName;
        if (move_uploaded_file($fileTmpName, $destination)) {
            // Le fichier a été téléchargé avec succès
            echo "Téléchargement réussi !";
        } else {
            // Une erreur s'est produite lors du déplacement du fichier
            echo "Erreur lors du déplacement du fichier !";
        }
    } else {
        // Une erreur s'est produite lors du téléchargement du fichier
        echo "Erreur lors du téléchargement du fichier !";
    }
} else {
    // Aucun fichier n'a été téléchargé
    echo "Aucun fichier n'a été téléchargé !";
}
?>