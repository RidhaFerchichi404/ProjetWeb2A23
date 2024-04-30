<?php
//require_once "../config.php";
include "../Controller/CandidatureC.php";

// Create CandidatureC object
$candidatureC = new CandidatureC();

// Check if id_candidature is set in the URL

    // Call the supprimerCandidature function
    $candidatureC->supprimerCandidature($_GET['id_candidature']);
    
    // Redirect to listcandidature.php after deletion
    
header("Location: listcandidature.php?id_offre=" . $_GET['id_offre']);    
 

?>
