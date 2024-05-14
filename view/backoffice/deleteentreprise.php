<?php
    include "../../controller/EntrepriseC.php";
    if(isset($_GET['id'])){
        $empC=new EntrepriseC();
        $empC->suppentreprise($_GET['id']);
        header('location:listentreprise.php');
        exit();
    }else{
        echo "error: id is not set.";
    }
?>