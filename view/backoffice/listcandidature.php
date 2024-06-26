<?php
// Include config.php
require_once "../../config.php";
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
    <meta charset="utf-8">
    <title>Candidature List - CareerHub</title>
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
        .custom-card {
            background-color: grey; /* Grey background color */
        }
        .black-text {
            font-size: 28px;
    color: #000; /* Black color */
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
      
    <div class="container mt-5">
        <div class="custom-card">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center">Candidature List</h4>
            </div>
            <div class="card-body">
                <table class="table text-center">
                    <tr>
                        
                    
    <th class="black-text">CV</th>
    <th class="black-text">Actions</th>
                    </tr>
                    <?php if (isset($candidatureImages)): ?>
                        
                        <?php foreach ($candidatureImages as $image): ?>
                            <tr>
                                <td>
                                    <a href="#" class="show-fullscreen">
                                        <img src="../image/<?php echo $image['cv']; ?>" width="100px" alt="">
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

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
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

