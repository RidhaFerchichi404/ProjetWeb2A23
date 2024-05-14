<?php
    include "../../controller/SecteurC.php";
    if(isset($_GET['id'])){
        $empC=new SecteurC();
        $empC->suppsecteur($_GET['id']);
        header('location:listsecteur.php');
        exit();
    }else{
        echo "error: id is not set.";
    }
?>