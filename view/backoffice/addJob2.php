<?php
include "../../controller/JobC.php";
include "../../model/Job.php";

$error = "";

// Démarrer la session
session_start();
    

    // Connexion à la base de données
    if(isset($_GET['id'])) {
        // Récupérer l'ID de l'URL
        $entreprise_id = $_GET['id'];
    
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=careerhub', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Récupération des informations de l'entreprise en fonction de l'ID
        $query = "SELECT nom, location FROM entreprise WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $entreprise_id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Récupération des données de l'entreprise
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nom = $row['nom'];
            $location = $row['location'];
        }
    }

    // Récupération des données de l'utilisateur
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $nom = $row['nom'];
        $location = $row['location'];
    }


// Traitement du formulaire d'ajout d'emploi
if (isset($_POST["job_title"]) && isset($_POST["company_description"]) && isset($_POST["company_website"])
    && isset($_POST["job_description"]) && isset($_POST["job_requirements"]) && isset($_POST["salary"])
    && isset($_POST["deadline_date"])) {

    if (!empty($_POST["job_title"]) && !empty($_POST["company_description"]) && !empty($_POST["company_website"])
        && !empty($_POST["job_description"]) && !empty($_POST["job_requirements"]) && !empty($_POST["salary"])
        && !empty($_POST["deadline_date"])) {

        // Création d'un nouvel objet Job
        $job = new Job(
            null,
            $_POST["job_title"],
            $nom,
            $_POST["company_description"],
            $_POST["company_website"],
            $_POST["job_description"],
            $_POST["job_requirements"],
            $_POST["salary"],
            $location,
            $_POST["deadline_date"]
        );

        // Ajout de l'emploi à la base de données
        $jobC = new JobC();
        $jobC->addJob($job);

        // Redirection vers la liste des emplois
        header('Location:ListBack.php');
    } else {
        $error = "Missing information";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: calc(100% / 3); /* One-third width */
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 20px;
        }
        form {
            width: 600px; /* Adjust width as needed */
            padding: 40px; /* Increase padding for spacing */
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
    </style>

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
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        
                  
                </div>
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
                            <a href="Secteur_activite.html" class="dropdown-item">Secteur d'activite</a>
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
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        
                    </div>
                </div>
            </nav>


           


           

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Salse</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                    <div class="form-container">


                    
<body>
                        
    <div class="container">
        
        <h1>Add New Job</h1>
        <div class="container">
        <form action="" method="POST"  class="p-4 rounded bg-light">
    <h1 class="mb-4 text-center">Add New Job</h1>
    <div class="mb-3 row">
        <label for="job_title" class="col-sm-3 col-form-label text-sm-end">Job Title <span class="text-danger">*</span>:</label>
        <div class="col-sm-9">
            <input type="text" name="job_title" id="job_title" maxlength="50" class="form-control" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="company_name" class="col-sm-3 col-form-label text-sm-end">Company Name <span class="text-danger">*</span>:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php if(isset($nom)) echo htmlspecialchars($nom); ?>" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="company_description" class="col-sm-3 col-form-label text-sm-end">Company Description:</label>
        <div class="col-sm-9">
            <input type="text" name="company_description" id="company_description" maxlength="255" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="company_website" class="col-sm-3 col-form-label text-sm-end">Company Website:</label>
        <div class="col-sm-9">
            <input type="text" name="company_website" id="company_website" maxlength="255" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="job_description" class="col-sm-3 col-form-label text-sm-end">Job Description:</label>
        <div class="col-sm-9">
            <input type="text" name="job_description" id="job_description" maxlength="255" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="job_requirements" class="col-sm-3 col-form-label text-sm-end">Job Requirements:</label>
        <div class="col-sm-9">
            <input type="text" name="job_requirements" id="job_requirements" maxlength="255" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="salary" class="col-sm-3 col-form-label text-sm-end">Salary:</label>
        <div class="col-sm-9">
            <input type="text" name="salary" id="salary" maxlength="50" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="location" class="col-sm-3 col-form-label text-sm-end">Location:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="location" name="location" value="<?php if(isset($location)) echo htmlspecialchars($location); ?>" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="deadline_date" class="col-sm-3 col-form-label text-sm-end">deadline date:</label>
        <div class="col-sm-9">
            <input type="date" name="deadline_date" id="deadline_date" maxlength="50" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-3"></div>
        <div class="col-sm-9 text-center">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </div>
</form>
</div>
    </div>

    <script>
        function validateForm() {
            var jobTitle = document.getElementById('job_title').value;
            var companyName = document.getElementById('company_name').value;
            var company_description = document.getElementById('company_description').value;
            var company_website = document.getElementById('company_website').value;
            var job_description = document.getElementById('job_description').value;
            var job_requirements = document.getElementById('job_requirements').value;
            var salary = document.getElementById('salary').value;
            var location = document.getElementById('location').value;

            if (jobTitle.trim() === '' || companyName.trim() === '' || company_description.trim() === ''  || company_website.trim() === '' || job_description.trim() === '' || job_requirements.trim() === '' || location.trim() === '' ) {
                alert('Fields are required');
                return false;
            }

            if (isNaN(parseFloat(salary)) || !isFinite(salary) || parseFloat(salary) <= 0) {
                alert('Salary must be a positive number');
                return false;
            }

            return true; 
        }
    </script>
</body>
            </div>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            

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
        <!-- Content End -->


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
