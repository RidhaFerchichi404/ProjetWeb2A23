<?php
    include "../Controller/EventC.php";
    $evC = new EventC();
    $evC->deleteEvent($_GET['idEvent']);
    header('Location:ListEvents.php');
?>