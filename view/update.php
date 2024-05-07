<?php
include '../Controller/commentaireC.php';
include '../Model/commentaire.php';

// Création d'une instance du contrôleur des événements
$commentaireC = new commentaireC();

// Création d'une instance de la classe Event
$commentaire = null;

if (isset($_GET['id_commentaire'])){
    $current_id = $_GET['id_commentaire'];
}

if (
     
    isset($_POST['id_utilisateur']) && 
    isset($_POST['text'])
) {
    if (
        
        !empty($_POST["id_utilisateu"]) &&
        !empty($_POST["contenue"])
    ) {
       
        
        $commentaire = new commentaire(
            $current_id_sujet,
        
            $_POST['text'],
            //new DateTime($_POST['date_creation']),
            
        );

        $sujetC->updatesujet($sujet, $current_id);
        header('Location:update_comment.php');
    } else {
        $error = "Missing information";
    }
}
?>