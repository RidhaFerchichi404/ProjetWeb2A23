<?php
include "../../controller/EventC.php";
    if (isset($_POST['idEvent'])) {
        $evC = new EventC();
        $evC->deleteEvent($_POST['idEvent']);
        header('Location:Listridha.php');
        exit(); 
    } else {
        echo "Error: idEvent is not set.";
    }
?>