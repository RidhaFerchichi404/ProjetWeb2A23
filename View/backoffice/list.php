<?php
// Inclure le fichier de connexion à la base de données
include "../../config.php";
$pdo = config::getConnexion();

// Handling status update requests
if (isset($_GET['action'], $_GET['id']) && in_array($_GET['action'], ['accepted', 'refused'])) {
    $stmt = $pdo->prepare("UPDATE training_part SET status = ? WHERE id = ?");
    $stmt->execute([$_GET['action'], $_GET['id']]);
    header("Location: list.php"); // Redirect to avoid re-submission
    exit;
}

// Fetch participants from the database
$query = "SELECT * FROM training_part";
$stmt = $pdo->query($query);
$participants = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Training</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="Training.php" class="dropdown-item">add training</a>
                            <a href="listTraining.php" class="dropdown-item">training list</a>
                            <a href="list.php" class="dropdown-item">list of participants</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Entreprise</a>
                        <div class="dropdown-menu bg-transparent border-0 ">
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


    <!-- Content Start -->
<div class="content">
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="col-md-12 text-center">
                <h3>List of Training Participants</h3>
                <!-- Barre de recherche -->
                <form method="GET" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by Name or Phone" name="search">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </form>

                <!-- Formulaire de filtrage -->
                <form method="GET" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Filter by Name" name="name_filter">
                        <input type="text" class="form-control" placeholder="Filter by Phone" name="phone_filter">
                        <button class="btn btn-outline-secondary" type="submit" id="filter-button"><i class="bi bi-funnel"></i> Filter</button>
                    </div>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">CV</th>
                            <th scope="col">Upload</th>
                            <th scope="col">Lettre</th>
                            <th scope="col">ID Training</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Actions 2</th>
                            <th scope="col">Actions 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Traitement de la recherche
                        $search = isset($_GET['search']) ? $_GET['search'] : '';

                        // Construction de la requête SQL
                        $sql = "SELECT * FROM training_part";
                        $params = [];

                        if (!empty($search)) {
                            $sql .= " WHERE name LIKE ? OR phone LIKE ? OR id = ?";
                            $params = ["%$search%", "%$search%", $search];
                        }

                        // Pagination
                        $limit = 4; // Nombre d'enregistrements par page
                        $total_rows = $stmt->rowCount(); // Nombre total d'enregistrements

                        // Calcul du nombre total de pages
                        $total_pages = ceil($total_rows / $limit);

                        // Détermination de la page actuelle
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $offset = ($page - 1) * $limit;

                        // Construction de la requête SQL avec la pagination
                        $sql .= " LIMIT $limit OFFSET $offset";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($params);

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['cv'] . "</td>";
                            echo "<td>" . $row['upload'] . "</td>";
                            echo "<td>" . $row['lettre'] . "</td>";
                            echo "<td>" . $row['training_id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['status'] ?? 'Pending') . "</td>";

                            echo "<td>";
                            echo "<a href='editF.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'><i class='fas fa-edit'></i></a>";
                            echo "<a href='deleteF.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger ms-2'><i class='fas fa-trash'></i></a>";
                            
                            echo "</td>";
                            echo "<td>";
                            echo "<a href='?action=accepted&id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Accept</a>";
                            echo "<a href='?action=refused&id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Refuse</a>";
                            echo "<td>";
                            echo "<a href='smsA.php?id=" . $row['id'] . "' class='btn btn-sm btn-success ms-2'>Accepter Notif</a>";
                            echo "<a href='smsR.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning ms-2'>Refuser Notif</a>";

                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Pagination links -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php

                        // Lien vers la page précédente
                        if ($page > 1) {
                            echo "<li class='page-item'><a class='page-link' href='?search=$search&page=" . ($page - 1) . "'>Previous</a></li>";
                        }

                        // Liens des pages
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?search=$search&page=" . $i . "'>$i</a></li>";
                        }

                        // Lien vers la page suivante
                        if ($page < $total_pages) {
                            echo "<li class='page-item'><a class='page-link' href='?search=$search&page=" . ($page + 1) . "'>Next</a></li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
    <!-- Content End -->



           
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0/dist/js/bootstrap.bundle.min.js"></script>
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