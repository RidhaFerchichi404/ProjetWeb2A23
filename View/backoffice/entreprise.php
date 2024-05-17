
<?php
include '../../Controller/SecteurC.php';
$secteurC= new SecteurC();
if($_SERVER["REQUEST_METHOD"]=="POST")
    if(isset($_POST['secteur']) && isset($_POST['search'])){
    $idsecteur=$_POST['secteur'];
    $list=$secteurC->afficheentreprise($idsecteur);
    }
    $secteurs=$secteurC->listsecteur();


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
                    <div class="col-md-6 text-center">
                        <h3>Add entreprise</h3>
                        <form action="addentreprise.php" method="post" id="formadd">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Name :</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Enter name here">
                                <div id="nameError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email :</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                                <div id="emailError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="doc" class="form-label">date of creation :</label>
                                <input type="date" class="form-control" id="doc" name="doc" placeholder="Enter date of creation here">
                                <div id="docError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">location :</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Enter location here">
                                <div id="locError"></div>
                            </div>
                                <div class="mb-3">
                                <label value="secteur">Select secteur</label>
                                <select name="secteur" id="secteur">
                            </div>
                            <?php
                            foreach ($secteurs as $secteur) {
                                echo "<option value=\"" . $secteur['id'] . "\">" . $secteur['nom'] . "</option>";
                            }
                            ?>
                         </select>
                         <div>
                         <button type="submit" class="btn btn-primary">Add</button>
                         </div>
                        </form>
                        <script>
                        var formElement = document.getElementById("formadd");
                            var nameElement = document.getElementById("nom");
                            var docElement = document.getElementById("doc");
                            var locationElement = document.getElementById("location");
                            var emailElement = document.getElementById("email");
                    
                            formElement.addEventListener("submit", function(event){
                                var isValid = validateForm();
                                if(isValid) {
                                    return true;
                                } else {
                                    event.preventDefault();
                                    return false;
                                }
                            });
                            function validateForm() {
                                var nameValue = nameElement.value;
                                var docValue = docElement.value;
                                var emailValue = emailElement.value;
                                var locationValue = locationElement.value;

                                var nameError = document.getElementById("nameError");
                                var docError = document.getElementById("docError");
                                var emailError = document.getElementById("emailError");
                                var locationError = document.getElementById("locError");

                                var patternName = /^[a-zA-Z]+$/;
                                var patterndoc = /^\d{4}-\d{2}-\d{2}$/;
                                var patternLocation = /^[a-zA-Z0-9\s!"#$%&'()*+,-./:;<=>?@[\\\]^_`{|}~]*$/;
                                var patternemail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                                var isValid = true;

                                if (!nameValue.match(patternName)) {
                                    nameError.innerHTML = "Name incorrect";
                                    nameElement.style.borderColor = "red";
                                    isValid = false;
                                } else {
                                    nameError.innerHTML = "";
                                    nameElement.style.borderColor = "green";
                                }

                                if (!emailValue.match(patternemail)) {
                                    emailError.innerHTML = "Email incorrect";
                                    emailElement.style.borderColor = "red";
                                    isValid = false;
                                } else {
                                    emailError.innerHTML = "";
                                    emailElement.style.borderColor = "green";
                                }

                                if (!docValue.match(patterndoc)) {
                                    docError.innerHTML = "Date incorrect";
                                    docElement.style.borderColor = "red";
                                    isValid = false;
                                } else {
                                    var currentDate = new Date();
                                    var enteredDate = new Date(docValue);
                                    
                                    if (enteredDate >= currentDate) {
                                        docError.innerHTML = "Date must be before the current date";
                                        docElement.style.borderColor = "red";
                                        isValid = false;
                                    } else {
                                        docError.innerHTML = "";
                                        docElement.style.borderColor = "green";
                                    }
                                }
                                if (!locationValue.match(patternLocation)) {
                                    locationError.innerHTML = "Location incorrect";
                                    locationElement.style.borderColor = "red";
                                    isValid = false;
                                } else {
                                    locationError.innerHTML = "";
                                    locationElement.style.borderColor = "green";
                                }

                                return isValid;
                            }
                        </script>
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