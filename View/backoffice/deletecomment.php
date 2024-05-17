<?php
/* require_once '../config.php';
require_once '../controller/commentaireC.php';

$pdo = Config::getConnexion();
$commentaireC = new commentaireC($pdo);

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $commentId = $_GET['delete'];
    $commentaireC->deleteCommentaire($commentId);
    
    // Redirection vers la page précédente (backcom.php)
    header("Location: backcom.php");
    exit;
} */
include '../../controller/commentaireC.php';
$commentaireC = new commentaireC();
$commentaireC->deleteCommentaire($_GET["id_commentaire"]);
header('Location:backcom.php');

?>