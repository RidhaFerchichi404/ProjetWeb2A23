<?php
include '../../Controller/CommentaireC.php';
include '../../Model/commentaire.php';

$id_sujet = isset($_GET['id_sujet']) ? $_GET['id_sujet'] : null;
$subC = new CommentaireC();

if (isset($_POST['id_poste'], $_POST['id_utilisateur'], $_POST['text'])) {
    $id_poste = $_POST['id_poste'];
    $id_utilisateur = $_POST['id_utilisateur'];
    $text = $_POST['text'];

    $commentaire = new commentaire(null, $id_poste, $id_utilisateur, $text);
    
    if ($subC->addCommentaire($commentaire)) {
        header("Location:detailsforum.php?id_sujet=$id_sujet");
        exit();
    } else {
        echo "Failed to add comment.";
    }
} else {
    echo "Missing information";
}
?>
