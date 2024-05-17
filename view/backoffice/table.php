<?php 
include "../../controller/sujetC.php";

$c = new sujetC();
$tab = $c->listsujet();
require __DIR__ . '/../../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Initialize UserC instance
function getCurrentUser() 
    {
        $log = new Logger('getCurrentUser');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/getCurrentUser.log', Logger::INFO));
        session_start(); // Démarrer la session

        // Vérifier si l'utilisateur est connecté
        if(isset($_SESSION['name'])) { 

            
            // Si l'utilisateur est connecté, récupérer les informations de l'utilisateur à partir de la session
            $name = $_SESSION['name'];
            $log->info('IN SESSION', ['user name' => $name]);

            $sql = "SELECT * FROM user WHERE name = :name";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->bindValue(':name', $name);
                $query->execute();
                $user =  $query->fetch();
                $log->info('IN SESSION', ['user' => $user]);
                return $user;
            } catch (Exception $e) {
                $log->error('NO USER', ['message' =>$e->getMessage()]);
                die('Error:' . $e->getMessage());
            }
        } else {
            $log->error('NO USER');
            // Si l'utilisateur n'est pas connecté, retourner null ou un message d'erreur
            return null;
        }
    }
    $log = new Logger('tables');
    $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/tables.log', Logger::INFO));

// Initialize variables
$logged = ""; // Default to empty string
// $list = null;
$userPhoto = "";
// Check if the user is logged in
if (isset($_COOKIE['name'])) {
    // If user's name is stored in cookie, retrieve it
    $logged = $_COOKIE['name'];
    
} elseif (isset($_SESSION['name'])) {
    // If user's name is stored in session, retrieve it and set cookie
    $logged = $_SESSION['name'];
    setcookie('name', $_SESSION['name'], time() + (86400 * 30), "/");
} else {
    // If user is not logged in, redirect to login page
    header("location: in.php");
    exit; // Terminate script execution after redirection
}


// Get the current user's information
$currentUser = getCurrentUser();
$log->info('Current user log', ['currentUser' => $currentUser]);

// Check if the current user exists
if ($currentUser) {
    $log->info('Current user exists', ['currentUser' => $currentUser]);
    // If the current user exists, get the photo path
    $userPhoto = $currentUser['photo'];
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
                
                <div class="navbar-nav w-100">
                    <a href="tables.php" class="nav-item nav-link "><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="ListBack.php" class="nav-item nav-link "><i class="fa fa-chart-bar me-2"></i>Jobs</a>
                    <a href="table.php" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>Forums</a>
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
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" id="myInput" onkeyup="myFunction()" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        
                    </div>
                    <div class="nav-item dropdown">
                        
                    </div>


                    <div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <!-- Display user's photo dynamically -->
        <img class="rounded-circle me-lg-2" src="<?php echo $userPhoto; ?>" alt="" style="width: 40px; height: 40px;">
        <span class="d-none d-lg-inline-flex">
            <?php echo $logged; ?>
            
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
        <a href="profile_user.php" class="dropdown-item">My Profile</a>
        <a href="../frontoffice/in.php" class="dropdown-item">Log Out</a>
    </div>
</div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h2 class="mb-4 text-center">FORUM LIST</h2>
                            <a href="ajouterforum.php" type="button" class="btn btn-outline-success m-2 center-button">ADD FORUM</a>
                            <div class="table-responsive">
                            <?php
                                

                                ?>
                                <table class="table" id="table">
                                    <thead>
                                        <tr>
                                            <th id="idsujetHeader" >subject Id</th>
                                            <th >user Id</th>
                                            <th >Title</th>
                                            <th >Content</th>
                                            <th class="sortable" >creation date</th>
                                            <th >Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                        foreach ($tab as $sujet) {
                                            ?>
                                   
                                             <tr>
                                                <td><?= $sujet['id_sujet']; ?></td>
                                                <td><?= $sujet['id_utilisateur']; ?></td>
                                                <td><?= $sujet['titre']; ?></td>
                                                <td><?= $sujet['contenue']; ?></td>
                                                <td><?= $sujet['date_creation']; ?></td>
                                                <td><a href="update_forum.php?id=<?= $sujet['id_sujet']; ?>" type="button" class="btn btn-outline-warning m-2">Update</a></td>
                                                <td><a href="deletesujet.php?id_sujet=<?= $sujet['id_sujet']; ?>" type="button" class="btn btn-outline-danger m-2">Delete</a></td>
                                                <td><a href="backcom.php?id_sujet=<?=$sujet['id_sujet'];?>" type="button" class="btn btn-outline-danger m-2">voir les commentaires</a></td>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
            <!-- Table End -->
            
            <!-- Back to Top Button -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>
        <!-- Content End -->

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

    <!-- Custom Script -->
    <script src="js/main.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.0/classic/ckeditor.js"></script>

</body>
</html>

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    document.addEventListener("DOMContentLoaded", function () {
        const headers = document.querySelectorAll(".sortable");

        function sortByColumn(columnIndex) {
            const tableBody = document.querySelector("tbody");
            const rows = Array.from(tableBody.querySelectorAll("tr"));
            const isAscending = headers[columnIndex].classList.toggle("asc");

            rows.sort((rowA, rowB) => {
                const valueA = rowA.cells[columnIndex].textContent.trim();
                const valueB = rowB.cells[columnIndex].textContent.trim();

                if (columnIndex === 0) {
                    // If the column is the ID column, parse the values as integers for numeric sorting
                    return isAscending ? parseInt(valueA) - parseInt(valueB) : parseInt(valueB) - parseInt(valueA);
                } else if (columnIndex === 1) {
                    // If the column is the date column, convert the dates to objects for comparison
                    return isAscending
                        ? new Date(valueA) - new Date(valueB)
                        : new Date(valueB) - new Date(valueA);
                }

                return isAscending
                    ? valueA.localeCompare(valueB)
                    : valueB.localeCompare(valueA);
            });

            rows.forEach((row) => tableBody.appendChild(row));
        }


        headers.forEach((header, index) => {
            header.addEventListener("click", () => sortByColumn(index));
        });
    });
    </script>
