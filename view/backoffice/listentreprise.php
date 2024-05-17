<?php
include "../../controller/EntrepriseC.php";
//include "../../config.php";
$entC=new EntrepriseC();
$list=$entC->listentreprise();

$limit = 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if (isset($_POST['submit-search'])) {
    $search = $_POST['search'];
    $list = $entC->searchent($search);
    $totalJobs = count($list);
}else {
    // Fetch paginated data if the search form is not submitted
    $offset = ($page - 1) * $limit;
    $totalJobs = $entC->countent();
    $list = $entC->paginateent($offset, $limit);
}
$totalPages = ceil($totalJobs / $limit);

/*// Handling status update requests
$pdo=config::getConnexion();
if (isset($_GET['action status'], $_GET['id']) && in_array($_GET['action status'], ['accepted', 'refused'])) {
    $stmt = $pdo->prepare("UPDATE entreprise SET status = ? WHERE id = ?");
    $stmt->execute([$_GET['action status'], $_GET['id']]);
    header("Location: listentreprise.php"); // Redirect to avoid re-submission
    exit;
}*/
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
                    <a href="table.php" class="nav-item nav-link "><i class="fa fa-keyboard me-2"></i>Forums</a>
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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Entreprise</a>
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

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-8 offset-md-2 text-center">
                    <form class="search-form" action="" method="POST">
                        <input type="text" id="search-box" name="search" placeholder="search here...">
                        <button type="submit" name="submit-search"><i class="fas fa-search"></i> Search</button>
                    </form>
                    <h3>List Entreprises</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id entreprise</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">date of creation</th>
                                    <th scope="col">location</th>
                                    <th scope="col">secteur</th>
                                    <th scope="col">status</th>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                                <?php foreach ($list as $entreprise) { ?>
                                    <tr>
                                        <td><?= $entreprise['id']; ?></td>
                                        <td><?= $entreprise['nom']; ?></td>
                                        <td><?= $entreprise['email']; ?></td>
                                        <td><?= $entreprise['doc']; ?></td>
                                        <td><?= $entreprise['location']; ?></td>
                                        <td><?= $entreprise['secteur']; ?></td>
                                        <td><?= $entreprise['status']; ?></td>
                                        <td>
                                        <form action="mailA.php" method="post">
                                            <input type="hidden" name="id" value="<?= $entreprise['id']; ?>">
                                            <input type="hidden" name="email" value="<?= $entreprise['email']; ?>">
                                            <button type="submit" class="btn btn-success">Accept</button>
                                        </form>
                                        
                                        <form action="mailR.php" method="post">
                                            <input type="hidden" name="id" value="<?= $entreprise['id']; ?>">
                                            <input type="hidden" name="email" value="<?= $entreprise['email']; ?>">
                                        </form>
                                            <button class="btn btn-danger">Refuse</button>
                                        </td>
                                        <td>
                                            <form action="updateentreprise.php" method="post">
                                                <!-- Hidden field to pass the sector ID -->
                                                <input type="hidden" name="id" value="<?php echo $entreprise['id']; ?>">
                                                <button type="submit" class="btn btn-danger">Update</button>
                                            </form>
                                        </td>
                                        <td><a href="deleteentreprise.php?id=<?php echo $entreprise['id']; ?>" class="btn btn-danger">Delete</a></td>

                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="pagination mt-4 d-flex justify-content-center">
                            <?php if ($page > 1) : ?>
                                <a href="?page=<?= $page - 1 ?>" class="btn btn-primary">Previous</a>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <a href="?page=<?= $i ?>" class="btn btn-primary <?= $page == $i ? 'active' : '' ?>"><?= $i ?></a>
                            <?php endfor; ?>
                            <?php if ($page < $totalPages) : ?>
                                <a href="?page=<?= $page + 1 ?>" class="btn btn-primary">Next</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blank End -->


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