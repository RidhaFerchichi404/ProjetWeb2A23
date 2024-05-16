<?php
include "../../controller/ParticipantC.php";
    if (isset($_POST['idPart'])) {
        $prC = new ParticipantC();
        $prC->deleteParticipant($_POST['idPart']);
        header('Location:ListP.php');
        exit(); 
    } else {
        echo "Error: idEvent is not set.";
    }
?>