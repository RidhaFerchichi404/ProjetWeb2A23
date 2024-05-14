<?php
include_once '../../Controller/SecteurC.php';
include_once '../../Controller/EntrepriseC.php';
require_once '../../model/Entreprise.php';
require_once '../../model/secteur.php';
$secteurC= new SecteurC();
if($_SERVER["REQUEST_METHOD"]=="POST")
    if(isset($_POST['secteur']) && isset($_POST['search'])){
    $idsecteur=$_POST['secteur'];
    $list=$secteurC->afficheentreprise($idsecteur);
    var_dump($list);
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
    <?php foreach ($list as $entreprise) { ?>
     <tr>
            <td><?= $entreprise['id']; ?></td>
            <td><?= $entreprise['nom']; ?></td>
            <td><?= $entreprise['email']; ?></td>
            <td><?= $entreprise['doc']; ?></td>
            <td><?= $entreprise['location']; ?></td>
            <td><?= $entreprise['secteur']; ?></td>
            <td><form action="updateentreprise.php" method="post">
                <!-- Hidden field to pass the sector ID -->
                <input type="hidden" name="id" value="<?php echo $entreprise['id']; ?>">
                <button type="submit" class="btn btn-danger">Update</button>
                </form>
            </td>
                <td><a href="deleteentreprise.php?id=<?php echo $entreprise['id']; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php } ?>
    </ul>
<?php } ?>
</body>
</html>

