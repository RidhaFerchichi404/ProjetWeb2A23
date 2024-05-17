<?php
include "../../config.php"; // Inclure le fichier de connexion à la base de données

// Vérifier si l'ID de la formation à supprimer est passé en paramètre
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Connexion à la base de données avec PDO
        $connexion = new PDO('mysql:host=localhost;dbname=careerhub', 'root', '');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête de suppression avec un paramètre lié
        $sql = "DELETE FROM training_part WHERE id = :id";
        $statement = $connexion->prepare($sql);

        // Exécuter la requête de suppression en liant la valeur du paramètre
        $statement->execute(array('id' => $id));

        // Rediriger vers la page de liste des formations après la suppression
        header("Location: list.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "ID de la formation non spécifié.";
}
?>