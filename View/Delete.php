<?php
    include "../Controller/JobC.php";
    $jobC = new JobC();
    $jobC->deleteJob($_GET['id']);
    header('Location:ListBack.php');
?>