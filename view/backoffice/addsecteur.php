 <?php
include "../../controller/SecteurC.php";
include "../../model/secteur.php";
$error = null;
$emp = null;

if (
    isset($_POST['nom']) &&
    isset($_POST['email']) &&
    isset($_POST['type']) &&
    isset($_POST['nb_entreprises']) &&
    isset($_POST['region']) &&
    isset($_POST['exigence_formation'])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST['email']) &&
        !empty($_POST['type']) &&
        !empty($_POST['nb_entreprises']) &&
        !empty($_POST['region']) &&
        !empty($_POST['exigence_formation'])
    ) {
        $sec = new Secteur(
            null,
            $_POST['nom'],
            $_POST['email'],
            $_POST['type'],
            $_POST['nb_entreprises'], // Correction de la variable
            $_POST['region'],
            $_POST['exigence_formation']
        );
        $secC = new SecteurC();
        $secC->addsecteur($sec);
        // Rediriger immédiatement après l'ajout
        header('Location: listsecteur.php');
        exit(); // Assurer que le script s'arrête après la redirection
    } else {
        $error = "missing info";
    }
}
?>
