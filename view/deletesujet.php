<?php
include '../controller/sujetc.php';
$sujetC = new sujetC();
$sujetC->deletesujet($_GET["id_sujet"]);
header('Location:back.php');
?>