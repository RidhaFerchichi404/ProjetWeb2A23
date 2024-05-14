<?php
include '../Controller/CommentaireC.php'; // Inclure le fichier contenant la classe CommentaireC
include '../Model/commentaire.php';
$error = null;
$sub = null;

if (isset($_POST['id_sujet']) && isset($_POST['id_utilisateur']) && isset($_POST['text'])) {
    if (!empty($_POST['id_sujet']) && !empty($_POST['id_utilisateur']) && !empty($_POST['text'])) {

        $sub = new commentaire(
            null,
            $_POST['id_sujet'],
            $_POST['id_utilisateur'],
            $_POST['text']
        );
        
        $subC = new CommentaireC(); // Instanciation de la classe CommentaireC
        $subC->addCommentaire($sub); // Appel de la méthode addCommentaire

        header('Location: detailsforum.php');
        exit(); // Assurez-vous de terminer l'exécution du script après la redirection
    } else {
        $error = "Missing information";
    }
}
?>
