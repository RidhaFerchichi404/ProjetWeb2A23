<?php
    // Include config.php only if it's not already included
    if (!class_exists('config')) {
        include "../config.php";
    }

    if(isset($_POST['btn_img'])) {
        // Get the id_offre from the URL parameters
        $id_offre = isset($_GET['id_offre']) ? $_GET['id_offre'] : null;

        // Check if id_offre is not null
        if ($id_offre !== null) {
            // Include the config file
            require_once "../config.php";
                
            // Get PDO connection
            $pdo = config::getConnexion();
                
            // Define SQL query to insert image
            $sql = "INSERT INTO `candidature` (`cv`, `id_offre`) VALUES (:filename, :id_offre)";
                
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
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':filename', $filename);
                    $stmt->bindParam(':id_offre', $id_offre); // Bind id_offre
                    
                    // Execute the query
                    $stmt->execute();
                    
                    // Move the uploaded file to the folder
                    move_uploaded_file($tempfile, $folder);
                    
                    echo "<div class='alert alert-success' role='alert'><h4 class='text-center'>Image uploaded</h4></div>";
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        } else {
            // Handle the case where id_offre is not passed
            echo "Error: No job ID specified.";
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
    <title>Upload Image</title>
</head>
<body>

    <div class="alert alert-secondary" role="alert">
        <h4 class="text-center">Upload Image</h4>
    </div>
    <div class="container col-12 m-5">
        <div class="col-6 m-auto">

            <form action="addcandidature.php?id_offre=<?php echo $_GET['id_offre']; ?>" method="post" class="form-control" enctype="multipart/form-data">
                <input type="file" class="form-control" name="choosefile"  id="">
                <div class="col-6 m-auto">
                    <button type="submit" name="btn_img" class="btn btn-outline-success m-4">Submit</button>
                </div>
            </form>
            

        </div>
    </div>

</body>
</html>
