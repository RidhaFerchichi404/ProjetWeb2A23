<?php
include '../../Controller/sujetC.php';
include '../../Model/sujet.php';

// Création d'une instance du contrôleur des événements
$sujetC = new SujetC();

// Création d'une instance de la classe Event
$sujet = null;

if (isset($_GET['id'])){
    $current_id = $_GET['id'];
}

if (
    isset($_POST['id_utilisateur']) && 
    isset($_POST['titre']) && 
    isset($_POST['contenue'])
) {
    if (
        !empty($_POST['id_utilisateur']) &&
        !empty($_POST["titre"]) &&
        !empty($_POST["contenue"])
    ) {
       
        $currentDate = date("Y-m-d");
        $sujet = new sujet(
            $current_id,
            $_POST['id_utilisateur'],
            $_POST['titre'],
            //new DateTime($_POST['date_creation']),
            $_POST['contenue'],
            $currentDate
        );

        $sujetC->updatesujet($sujet, $current_id);
        header('Location:table.php');
    } else {
        $error = "Missing information";
    }
}
?>