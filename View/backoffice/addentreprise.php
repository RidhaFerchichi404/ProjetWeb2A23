<?php
include "../../controller/EntrepriseC.php";
include "../../model/Entreprise.php";
$error = null;
$emp = null;

if (
    isset($_POST['nom']) &&
    isset($_POST['email']) &&
    isset($_POST['doc']) &&
    isset($_POST['location']) &&
    isset($_POST['secteur'])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST['email']) &&
        !empty($_POST['doc']) &&
        !empty($_POST['location']) &&
        !empty($_POST['secteur'])
    ) {
        $ent= new Entreprise(
            null,
            $_POST['nom'],
            $_POST['email'],
            $_POST['doc'],
            $_POST['location'],
            $_POST['secteur']
        );
        $entC = new EntrepriseC();
        $entC->addentreprise($ent);
        header('Location: listentreprise.php');
        exit(); // Assurer que le script s'arrête après la redirection
    } else {
        $error = "missing info";
    }
}
?>