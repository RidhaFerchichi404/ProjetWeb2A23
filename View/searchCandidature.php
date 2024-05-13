<?php
require_once "../config.php";
include "../controller/JobC.php";
include "../model/Job.php";
require_once "../controller/CandidatureC.php";

    $jobC = new JobC();
    // Traitement du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset ($_POST[ 'id_offre']) && isset ($_POST[ 'search'])) {
        $id = $_POST [' id_offre'];
        $list = $jobC->list_candidature($id);
        }
    }
    $jobs = $jobC->list_job() ;
?>

<!DOCTYPE html>
    <head>
        <title>search candidature</title>
    </head>
    <body>
        <h1>search candidature by job</h1>
        <form action="" method="POST">
        <label for="id_offre" > Select Job :</label>
        <select name="id_offre" id="id_offre">
            <?php
            foreach ($jobs as $job) {
            echo '<option value="'. $job ['id'] . '">' . $job ['job_title'] . $job ['company_name'] . $job ['company_description'] . $job ['company_website'] . $job ['job_description'] . $job ['job_requirements'] . $job ['salary'] . $job ['location'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Rechercher" name="search">
        </form>

        <?php if (isset($list)) { ?>
        <br>
        <h2>Candidatures correspondants au job sélectionné :</h2>
        <ul>
            <?php foreach ($list as $candidature) { ?>
                <li><?= $candidature['cv'] ?>  dt</li>
            <?php } ?>
        </ul>
        <?php } ?>
    </body>
</html>

