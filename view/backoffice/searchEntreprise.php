<?php
include '../../Controller/SecteurC.php';
include '../../Controller/EntrepriseC.php';
include '../../model/Entreprise.php';
include '../../model/secteur.php';
$secteurC= new SecteurC();
if($_SERVER["REQUEST_METHOD"]=="POST")
    if(isset($_POST['secteur']) && isset($_POST['search'])){
    $idsecteur=$_POST['secteur'];
    $list=$secteurC->afficheentreprise($idsecteur);
    }
    $secteurs=$secteurC->listsecteur();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>search de entreprise</title>
</head>
<body>
    <h1>search de entreprise par secteur</h1>
    <form action="" method="POST">
    <label value="secteur">Sélectionnez un secteur</label>
    <select name="secteur" id="secteur">
        <?php
        foreach ($secteurs as $secteur) {
            echo "<option value=\"" . $secteur['id'] . "\">" . $secteur['nom'] . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="rechercher">
</form>
<?php if (isset($list)) {?>
    <br>
    <h2>Entreprise correspondants au genre selectionne :</h2>
    <ul>
        <?php foreach ($list as $entreprise){ ?>
            <li><?= $entreprise['nom'] ?> - <?=$entreprise['email'] ?> dt</li>
        <?php } ?>
        </ul>
        <?php } ?>
</body>
</html>

