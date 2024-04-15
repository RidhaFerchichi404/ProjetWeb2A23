<?php
include "../controller/sujetC.php";

$c = new sujetC();
$tab = $c->listsujet();

?>

<center>
    <h1>List of sujets</h1>
    <h2>
        <a href="forum.php">Add sujet</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id sujet</th>
        <th>id utilisateur</th>
        <th>titre</th>
        <th>contenue</th>
        <th>date creation</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $sujet) {
        ?>
        <tr>
            <td>

                <?= $sujet['id_sujet']; ?>
            </td>
            <td>
                <?= $sujet['id_utilisateur']; ?>
            </td>
            <td>
                <?= $sujet['titre']; ?>
            </td>
            <td>
                <?= $sujet['contenue']; ?>
            </td>
            <td>
                <?= $sujet['date_creation']; ?>
            </td>
            <td align="center">
                <form method="POST" action="updatesujet.php">
                    <a href="update_forum.php?id=<?= $sujet['id_sujet']; ?>">Update</a>
                    <input type="hidden" value=<?PHP echo $sujet['id_sujet']; ?> name="id_sujet">
                </form>
            </td>
            <td>
                <a href="deletesujet.php?id_sujet=<?php echo $sujet['id_sujet']; ?>">Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>