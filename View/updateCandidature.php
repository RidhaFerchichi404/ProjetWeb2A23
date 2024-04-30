<?php
// Include config.php
require_once "../config.php";

// Check if id is set in the URL
if (isset($_GET['id'])) {
    $id_candidature = $_GET['id'];

    // Get PDO connection
    $pdo = config::getConnexion();

    // Define SQL query to select candidature
    $sql = "SELECT id_candidature, cv FROM candidature WHERE id_candidature = :id_candidature";

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':id_candidature', $id_candidature);

        // Execute the query
        $stmt->execute();

        // Fetch the candidature
        $candidature = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}

// Check if the form is submitted
if(isset($_POST['btn_img'])) {
    // Get file details
    $filename = $_FILES["choosefile"]["name"];
    $tempfile = $_FILES["choosefile"]["tmp_name"];
    $folder = "image/".$filename;

    // Check if file name is not empty
    if($filename == "") {
        echo "<div class='alert alert-danger' role='alert'><h4 class='text-center'>Blank not Allowed</h4></div>";
    } else {
        try {
            // Prepare the SQL statement
            $stmt = $pdo->prepare(
                'UPDATE candidature SET 
                cv = :cv
                WHERE id_candidature = :id_candidature'
            );
            $stmt->execute([
                'cv' => $filename,
                'id_candidature' => $id_candidature
            ]);

            // Move the uploaded file to the folder
            move_uploaded_file($tempfile, $folder);

            // Redirect to listcandidature.php
            header("Location: listcandidature.php?id_offre=" . $_GET['id_offre']);
            exit();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
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
    <title>Update Candidature</title>
</head>
<body>

    <div class="alert alert-secondary" role="alert">
        <h4 class="text-center">Update Candidature</h4>
    </div>
    <div class="container col-12 m-5">
        <div class="col-6 m-auto">

            <!-- Display the image -->
            <img src="./image/<?php echo $candidature['cv']; ?>" width="100px" alt="Current Image">

            <form action="" method="post" class="form-control" enctype="multipart/form-data">
                <input type="file" class="form-control" name="choosefile" id="">
                <div class="col-6 m-auto">
                    <button  type="submit" name="btn_img" class="btn btn-outline-success m-4">Submit</button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
