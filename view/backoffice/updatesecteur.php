<?php
include '../../Controller/SecteurC.php';
include '../../model/secteur.php';
$error = "";

// create employe
$sec = null;

// create an instance of the controller
$secC = new SecteurC();
if (
    isset($_POST['id']) &&
    isset($_POST['nom']) &&    
    isset($_POST['email'])&&
    isset($_POST['type'])&&
    isset($_POST['nb_entreprises']) &&
    isset($_POST['region'])&&
    isset($_POST['exigence_formation'])
) {
    if (
        !empty($_POST['id']) &&
        !empty($_POST['nom']) &&
        !empty($_POST['email']) &&
        !empty($_POST['type']) &&
        !empty($_POST['nb_entreprises'])&&
        !empty($_POST['region'])&&
        !empty($_POST['exigence_formation'])
    ) {
        $sec = new Secteur(
            $_POST['id'],
            $_POST['nom'],
            $_POST['email'],
            $_POST['type'],
            $_POST['nb_entreprises'],
            $_POST['region'],
            $_POST['exigence_formation']);
        $secC->updatesecteur($sec, $_POST["id"]);
        header('Location:listsecteur.php');
    } else
        $error = "Missing information";
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
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>CareerHub</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
                    <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
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
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <button class="btn btn-primary"><a href="listsecteur.php" class="text-white">Back to list</a></button>
            <hr>
            <div id="error">
                <?php echo $error; ?>
            </div>
            <?php
            if (isset($_POST['id'])) {
                $sec = $secC->showsecteur($_POST['id']);
                if ($sec) {
            ?>
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-6 text-center">
                                <form id="formupdate" action="" method="POST">
                                <div class="mb-3">
                                    <label for="id" class="form-label">Id Secteur:</label>
                                    <input type="text" class="form-control" id="id" name="id" value="<?php echo $sec['id']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $sec['nom']; ?>">
                                    <div id="nameError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $sec['email']; ?>">
                                    <div id="emailError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="type">Type:</label>
                                    <input type="text" class="form-control" id="type" name="type" value="<?php echo $sec['type']; ?>">
                                    <div id="typeError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="nb_entreprises">Companys number:</label>
                                    <input type="text" class="form-control" id="nb_entreprises" name="nb_entreprises" value="<?php echo $sec['nb_entreprises']; ?>">
                                    <div id="nbError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="region">Region:</label>
                                    <input type="text" class="form-control" id="region" name="region" value="<?php echo $sec['region']; ?>">
                                    <div id="regionError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="exigence_formation">Training requirement:</label>
                                    <input type="text" class="form-control" id="exigence_formation" name="exigence_formation" value="<?php echo $sec['exigence_formation']; ?>">
                                    <div id="exigenceError"></div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    else{
                        echo "Sector not found!";
                    }}
                    ?>
                    <script>
                        var formElement = document.getElementById("formupdate");
                        var nameElement = document.getElementById("nom");
                        var typeElement = document.getElementById("type");
                        var nbElement = document.getElementById("nb_entreprises");
                        var emailElement = document.getElementById("email");
                        var lieuElement = document.getElementById("region");
                        var exigenceElement = document.getElementById("exigence_formation");

                        formElement.addEventListener("submit", function(event){
                            var isValid = validateForm();
                            if(isValid) {
                                return true;
                            } else {
                                event.preventDefault();
                                return false;
                            }
                        });

                        function validateForm(){
                            var nameValue = nameElement.value;
                            var typeValue = typeElement.value;
                            var nbValue = nbElement.value;
                            var emailValue = emailElement.value; 
                            var lieuValue = lieuElement.value;
                            var exigenceValue = exigenceElement.value;
                            
                            var nameError = document.getElementById("nameError");
                            var typeError = document.getElementById("typeError");
                            var nbError = document.getElementById("nbError");
                            var emailError = document.getElementById("emailError");
                            var lieuError = document.getElementById("lieuError");
                            var exigenceError = document.getElementById("exigenceError");

                            var patternName = /^[a-zA-Z]+$/;
                            var patternType = /^[a-zA-Z]+$/;
                            var patternnb = /^\d+$/;
                            var patternLieu = /^[a-zA-Z]+$/;
                            var patternemail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            var patternexigence = /^[a-zA-Z]+$/;

                            var isValid = true; 

                            if(!nameValue.match(patternName)){
                                nameError.innerHTML = "Name incorrect";
                                nameElement.style.borderColor = "red";
                                isValid = false; 
                            } else {
                                nameError.innerHTML = "";
                                nameElement.style.borderColor = "green"; 
                            }

                            if(!typeValue.match(patternType)){
                                typeError.innerHTML = "type incorrect";
                                typeElement.style.borderColor = "red";
                                isValid = false;
                            } else {
                                typeError.innerHTML = "";
                                typeElement.style.borderColor = "green"; 
                            }
                            if(!nbValue.match(patternnb)){
                                nbError.innerHTML = "nombre d'entreprise incorrect merci de saisir que des chiffres";
                                nbElement.style.borderColor = "red";
                                isValid = false;
                            } else {
                                nbError.innerHTML = "";
                                nbElement.style.borderColor = "green"; 
                            }

                            if(!emailValue.match(patternemail)){
                                emailError.innerHTML = "email incorrect ";
                                emailElement.style.borderColor = "red";
                                isValid = false;
                            } else {
                                emailError.innerHTML = "";
                                emailElement.style.borderColor = "green"; 
                            }

                            if(!lieuValue.match(patternLieu)){
                                lieuError.innerHTML = "Lieu incorrect";
                                lieuElement.style.borderColor = "red";
                                isValid = false;
                            } else {
                                lieuError.innerHTML = "";
                                lieuElement.style.borderColor = "green"; 
                            }
                            if(!exigenceValue.match(patternexigence)){
                                exigenceError.innerHTML = "exigence formation incorrect";
                                exigenceElement.style.borderColor = "red";
                                isValid = false;
                            } else {
                                exigenceError.innerHTML = "";
                                exigenceElement.style.borderColor = "green"; 
                            }
                            return isValid;
                        }
                    </script>
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