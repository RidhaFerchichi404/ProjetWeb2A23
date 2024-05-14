<?php
include '"../../Controller/sujetC.php';
include '"../../Model/sujet.php';
$error=null;
$sub=null;
if (isset($_POST['id_utilisateur']) && isset($_POST['titre']) && isset($_POST['contenue'])) {
   if (!empty($_POST['id_utilisateur']) && !empty($_POST['titre']) && !empty($_POST['contenue'])) {
    
    $currentDate = date("Y-m-d");

    $sub = new sujet(null,
       $_POST['id_utilisateur'],
       $_POST['titre'],
       //new DateTime($_POST['date_creation']),
       $_POST['contenue'],
       $currentDate);
       
       $subC = new SujetC();
       $subC->addsujet($sub);
      
       header('Location:table.php');
    }
   else {
       $error="Missing information";
   }
}
?>