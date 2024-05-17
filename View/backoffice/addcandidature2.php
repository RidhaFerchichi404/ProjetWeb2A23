<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xamppx\htdocs\TEST_MYCRUD1\PHPMailer-master\src\Exception.php';
require 'C:\xamppx\htdocs\TEST_MYCRUD1\PHPMailer-master\src\PHPMailer.php';
require 'C:\xamppx\htdocs\TEST_MYCRUD1\PHPMailer-master\src\SMTP.php';
require 'C:\xamppx\htdocs\TEST_MYCRUD1\config.php';

    // Include config.php only if it's not already included
    if (!class_exists('config')) {
        include "../../config.php";
    }

    // Initialize jobDetails array
    $jobDetails = [];

    // Check if id_offre is set in the URL
    if(isset($_GET['id_offre'])) {
        $id_offre = $_GET['id_offre'];

        // Get PDO connection
        $pdo = config::getConnexion();

        // Define SQL query to select job details by id_offre
        $sql = "SELECT * FROM offres_emploi WHERE id = :id_offre";

        try {
            // Prepare the SQL statement
            $stmt = $pdo->prepare($sql);

            // Bind the parameter
            $stmt->bindParam(':id_offre', $id_offre);

            // Execute the query
            $stmt->execute();

            // Fetch the job details
            $jobDetails = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            // Handle errors
            echo "Error: " . $e->getMessage();
        }
    }
    session_start();

    // Vérifiez si l'adresse e-mail est stockée dans la session
    if (isset($_SESSION['email'])) {
        // Récupérez l'adresse e-mail de la session
        $email = $_SESSION['email'];
    
        $pdo = new PDO('mysql:host=localhost;dbname=careerhub', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
       
    
        // Requête préparée pour récupérer le nom et le téléphone de l'utilisateur en fonction de l'adresse e-mail
        $query = "SELECT  email FROM user WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    
        // Récupération des données de l'utilisateur
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $email = $row['email'];
        } 
    }
    if(isset($_POST['btn_img']) ) {
        // Get the id_offre from the URL parameters
        $id_offre = isset($_GET['id_offre']) ? $_GET['id_offre'] : null;

        // Check if id_offre is not null
        if ($id_offre !== null) {
            // Include the config file
                
            // Get PDO connection
            $pdo = config::getConnexion();
                
            // Define SQL query to insert image
            $sql = "INSERT INTO `candidature` (`cv`, `id_offre`) VALUES (:filename, :id_offre )";
                
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
                    // Create a new PHPMailer instance
                $mail = new PHPMailer();
    
                // Set the SMTP server details
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = 'aichasmaoui22@gmail.com';
                $mail->Password = 'vmeh dryk xqsf vldf';
    
                // Set the email details
                $mail->setFrom('webreverso2a28@gmail.com', 'CareerHub');
                $mail->addAddress( htmlspecialchars($email));
                $mail->Subject = 'Candidature Recorded';
                $mail->Body = 'Your candidature has been recorded successfully.';
    
                // Send the email
            if ($mail->send()) {
              
                header('Location:ListBack.php');
            } else {
                echo 'Delivery confirmation email failed to send';
            }
            
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
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Custom CSS for job information display */
        .job-info-title {
            font-size: 28px;
            margin-bottom: 20px;
            color: blue; /* Green text color */
        }
        .job-info-card {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: grey;
        }
        .job-info-card .card-title {
            font-size: 24px;
            margin-bottom: 10px;
            color: black;
        }
        .job-info-card .card-text {
            font-size: 16px;
            margin-bottom: 5px;
            color: black;
        }
        .upload-form {
            max-width: 400px;
            margin: auto;
            margin-top: 30px;
        }
        .btn-submit {
            background-color: blue; /* Red background color */
            border-color: black; /* Red border color */
        }
        .btn-submit:hover {
            background-color: blue; /* Darker red background color on hover */
            border-color: black; /* Darker red border color on hover */
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="tables.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>CareerHub</h3>
                </a>
                
                <div class="navbar-nav w-100">
                    <a href="tables.php" class="nav-item nav-link "><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="ListBack.php" class="nav-item nav-link active"><i class="fa fa-chart-bar me-2"></i>Jobs</a>
                    <a href="table.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forums</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Events</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="ListP.php" class="dropdown-item">List of participants</a>
                            <a href="Listridha.php" class="dropdown-item">List of events</a>
                       
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Training</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="Training.php" class="dropdown-item">add training</a>
                            <a href="listTraining.php" class="dropdown-item">training list</a>
                            <a href="list.php" class="dropdown-item">list of participants</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Entreprise</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="Secteur_activite.php" class="dropdown-item">Secteur d'activite</a>
                            <a href="listsecteur.php" class="dropdown-item">list Secteur</a>
                            <a href="entreprise.php" class="dropdown-item">entreprise</a>
                            <a href="listentreprise.php" class="dropdown-item">list entreprise</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        
                    </div>
                    <div class="nav-item dropdown">
                        
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" >
                            </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
      
<!-- Content Start -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="job-info-card card">
                <div class="card-body">
                <h1 class="text-center mb-5">Upload CV</h1>

                    <?php if (!empty($jobDetails)) : ?>
                        <h2 class="job-info-title">Job Details :</h2>
                        <h2 class="card-title"><?php echo isset($jobDetails['job_title']) ? $jobDetails['job_title'] : ''; ?></h2>
                        <p class="card-text">Company: <?php echo isset($jobDetails['company_name']) ? $jobDetails['company_name'] : ''; ?></p>
                        <p class="card-text">Website: <?php echo isset($jobDetails['company_website']) ? $jobDetails['company_website'] : ''; ?></p>
                        <p class="card-text">Description: <?php echo isset($jobDetails['job_description']) ? $jobDetails['job_description'] : ''; ?></p>
                        <p class="card-text">Requirements: <?php echo isset($jobDetails['job_requirements']) ? $jobDetails['job_requirements'] : ''; ?></p>
                        <p class="card-text">Salary: <?php echo isset($jobDetails['salary']) ? $jobDetails['salary'] : ''; ?></p>
                        <p class="card-text">Location: <?php echo isset($jobDetails['location']) ? $jobDetails['location'] : ''; ?></p>
                    <?php endif; ?>
                    <hr>
                    <div class="upload-form">
                        <form action="addcandidature2.php?id_offre=<?php echo $_GET['id_offre']; ?>" method="post" class="form-control" enctype="multipart/form-data">
                            <input type="file" class="form-control" name="choosefile" id="">
                            <div class="col-6 m-auto">
                            <button type="submit" name="btn_img" class="btn btn-submit m-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content End -->
            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>