<?php
// Include config.php
require_once "../config.php";
// Check if id_offre is set in the URL
if (isset($_GET['id_offre'])) {
    $id_offre = $_GET['id_offre'];

    // Get PDO connection
    $pdo = config::getConnexion();

    // Define SQL query to select candidatures filtered by id_offre
    $sql = "SELECT id_candidature, cv FROM candidature WHERE id_offre = :id_offre";

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':id_offre', $id_offre);

        // Execute the query
        $stmt->execute();

        // Fetch all rows
        $candidatureImages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Candidature List</title>
    <style>
        .fullscreen {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            overflow: auto;
        }

        .fullscreen img {
            display: block;
            margin: auto;
            max-width: 80%;
            max-height: 80%;
            padding-top: 10%;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="text-center">Candidature List</h4>
        </div>
        <div class="card-body">
            <table class="table text-center">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php if (isset($candidatureImages)): ?>
                    
                    <?php foreach ($candidatureImages as $image): ?>
                        <tr>
                            <td><?php echo $image['id_candidature']; ?></td>
                            <td>
                                <a href="#" class="show-fullscreen">
                                    <img src="./image/<?php echo $image['cv']; ?>" width="100px" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="DeleteCandidature.php?id_candidature=<?php echo $image['id_candidature']; ?>&id_offre=<?php echo $id_offre; ?>" class="btn btn-danger">Delete</a>
                                <a href="updateCandidature.php?id=<?php echo $image['id_candidature']; ?>&id_offre=<?php echo $id_offre; ?>" class="btn btn-danger">Update</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>

<div class="fullscreen" id="fullscreen">
    <span class="close-fullscreen" style="position: fixed; top: 10px; right: 10px; cursor: pointer; color: #fff; font-size: 24px;">&times;</span>
    <img src="" alt="Fullscreen Image">
</div>

<script>
    const fullscreen = document.getElementById('fullscreen');
    const closeFullscreen = document.querySelector('.close-fullscreen');

    document.querySelectorAll('.show-fullscreen').forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault();
            const imgSrc = event.target.parentElement.querySelector('img').src;
            fullscreen.querySelector('img').src = imgSrc;
            fullscreen.style.display = 'block';
        });
    });

    closeFullscreen.addEventListener('click', () => {
        fullscreen.style.display = 'none';
    });
</script>

</body>
</html>
