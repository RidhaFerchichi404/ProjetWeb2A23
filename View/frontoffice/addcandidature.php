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
              
                header('Location:ListJob2.php');
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
    <title>CareerHub</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Custom CSS for job information display */
        .job-info-title {
            font-size: 35px;
            margin-bottom: 20px;
            color:blue; /* Green text color */
        }
        .job-info-card {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
            
        }
        .job-info-card .card-title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .job-info-card .card-text {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .upload-form {
            max-width: 400px;
            margin: auto;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">CareerHub</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="pageuser.php" class="nav-item nav-link">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">entreprises</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="secteuradd.php" class="dropdown-item active">Secteur add</a>
                            <a href="secteurlist.php" class="dropdown-item">Secteur list</a>
                            <a href="entrepriselist.php" class="dropdown-item">Entreprise list</a>
                            <a href="entrepriseadd.php" class="dropdown-item">Entreprise add</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Jobs</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="ListJob2.php" class="dropdown-item active">Job List</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Forums</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="listforum.php" class="dropdown-item active">Forums List</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Training</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="trainingF.php" class="dropdown-item active">Training List</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Events</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="job-list.php" class="dropdown-item active">Event List</a>
                        </div>
                    </div>
                    
                </div>
                <a href="addJob.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Post A Job<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Job List</h1>
                <nav aria-label="breadcrumb">
                    
                </nav>
            </div>
        </div>
        <!-- Header End -->

        <!-- Content Start -->
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Upload Your CV</h1>

        <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="job-info-card card">
                    <div class="card-body">
                        
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
                        <form action="addcandidature.php?id_offre=<?php echo $_GET['id_offre']; ?>" method="post" class="form-control" enctype="multipart/form-data">
                                <input type="file" class="form-control" name="choosefile" id="">
                                <div class="col-6 m-auto">
                                    <button type="submit" name="btn_img" class="btn btn-outline-success m-4">Submit</button>
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

<div class="container-fluid bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            
            <div class="col-md-4">
                <h5 class="text-white mb-3">Quick Links</h5>
                <ul class="list-unstyled mb-0">
                    <li><a class="text-white-50" href="#">About Us</a></li>
                    <li><a class="text-white-50" href="#">Contact Us</a></li>
                    <li><a class="text-white-50" href="#">Our Services</a></li>
                    <li><a class="text-white-50" href="#">Privacy Policy</a></li>
                    <li><a class="text-white-50" href="#">Terms & Condition</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="text-white mb-3">Contact</h5>
                <p class="text-white-50"><i class="fa fa-map-marker-alt me-2"></i>Pôle Technologique - El Ghazala, Ariana, Tunisia</p>
                <p class="text-white-50"><i class="fa fa-phone-alt me-2"></i>+216 56 414 539</p>
                <p class="text-white-50"><i class="fa fa-envelope me-2"></i>CareerHub@gmail.com</p>
            </div>
            <div class="col-md-4">
                <h5 class="text-white mb-3">Languages</h5>
                <div class="language-bar">
   <ul>
      <li><a href="#" class="active">Frensh</a></li>
      <li><a href="#">Arabic</a></li>
   </ul>
</div>
            </div>
        </div>
    </div>
    <hr class="bg-white my-3">
    <div class="container text-center ">
            &copy; <a class="border-bottom" href="#">2024</a>, All Rights Reserved.
            Created By <a class="border-bottom" href="https://htmlcodex.com">CareerHub</a>
            </div>
</div>
<!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>