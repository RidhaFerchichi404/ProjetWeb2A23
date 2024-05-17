<?php


    include "../../controller/JobC.php";
    $jobC = new JobC();
// Check if the job ID is provided in the URL
if (isset($_GET['id'])) {
    // Get the job ID from the URL
    $jobId = $_GET['id'];

    // Increment the view counter for the job offer
    $jobC->incrementViewCounter($jobId);

    // Fetch job details
}
   

                    // Include config.php only if it's not already included
                    if (!class_exists('config')) {
                        include "../../config.php";
                    }
                    
                    // Initialize jobDetails array
                    $jobDetails = [];
                
                    // Check if id_offre is set in the URL
                    if(isset($_GET['id'])) {
                        $id_offre = $_GET['id'];
                
                        // Get PDO connection
                        $pdo = config::getConnexion();
                
                        // Define SQL query to select job details by id_offre
                        $sql = "SELECT * FROM offres_emploi WHERE id = :id";
                
                        try {
                            // Prepare the SQL statement
                            $stmt = $pdo->prepare($sql);
                
                            // Bind the parameter
                            $stmt->bindParam(':id', $id_offre);
                
                            // Execute the query
                            $stmt->execute();
                
                            // Fetch the job details
                            $jobDetails = $stmt->fetch(PDO::FETCH_ASSOC);
                        } catch(PDOException $e) {
                            // Handle errors
                            echo "Error: " . $e->getMessage();
                        }
                    }
                    
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JobEntry - Job Portal Website Template</title>
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
            color: blue; /* Green text color */
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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Events</a>
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
                <h1 class="display-3 text-white mb-3 animated slideInDown">Jobs</h1>
                <nav aria-label="breadcrumb">
                    
                </nav>
            </div>
        </div>
        <!-- Header End -->

        <!-- Content Start -->

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
