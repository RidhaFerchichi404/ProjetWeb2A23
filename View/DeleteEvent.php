<?php
include "../Controller/EventC.php";
    if (isset($_POST['idEvent'])) {
        $evC = new EventC();
        $evC->deleteEvent($_POST['idEvent']);
        header('Location: ListEvents.php');
        exit(); 
    } else {
        echo "Error: idEvent is not set.";
    }
?>