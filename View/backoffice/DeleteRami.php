<?php
include "../../config.php"; // Inclure le fichier de connexion à la base de données


// Vérifier si l'ID de la formation à supprimer est passé en paramètre
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    

    // Préparer la requête de suppression
    $pdo = config::getConnexion();
    $sql = "DELETE FROM training WHERE id_training = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        // La requête de suppression s'est exécutée avec succès
        // Redirection vers la page de liste des formations après la suppression
        header("Location: listTraining.php");
        exit();
    } else {
        // La requête de suppression a échoué
        echo "Erreur lors de la suppression : " . $stmt->errorInfo()[2];
    }
    } else {
        // Si l'ID de la formation n'est pas spécifié
        echo "ID de la formation non spécifié.";
    }
    ?>
