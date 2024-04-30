<?php
include "../../controller/EntrepriseC.php";
include "../../model/Entreprise.php";
$error = "";

// create employe
$ent = null;

// create an instance of the controller
$entC = new EntrepriseC();
if (
    isset($_POST['id']) &&
    isset($_POST['nom']) &&    
    isset($_POST['email'])&&
    isset($_POST['doc'])&&
    isset($_POST['location'])&&
    isset($_POST['secteur'])
) {
    if (
        !empty($_POST['id']) &&
        !empty($_POST['nom']) &&
        !empty($_POST['email']) &&
        !empty($_POST['doc']) &&
        !empty($_POST['location'])&&
        !empty($_POST['secteur'])
    ) {
        $ent = new Entreprise(
            $_POST['id'],
            $_POST['nom'],
            $_POST['email'],
            $_POST['doc'],
            $_POST['location'],
            $_POST['secteur']);
        $entC->updateentreprise($ent, $_POST["id"]);
        header('Location:listentreprise.php');
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
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="Secteur_activite.html" class="dropdown-item active">Secteur d'activite</a>
                            <a href="listsecteur.html" class="dropdown-item active">list Secteur</a>
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
            <button><a href="listentreprise.php">Back to list</a></button>
            <hr>
            <div id="error">
                <?php echo $error; ?>
            </div>
            <?php
            if (isset($_POST['id'])) {
                $ent = $entC->showentreprise($_POST['id']);
                if ($ent) {
            ?>
                <form id="formupdate" action=""  method="POST">
                    <table border="1" align="center">
                        <tr>
                            <td>
                                <label for="id">Id entreprise:
                                </label>
                            </td>
                            <td><input type="text" name="id" id="id" value="<?php echo $ent['id']; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <label for="nom">Name:
                                </label>
                            </td>
                                <td><input type="text" name="nom" id="nom" value="<?php echo $ent['nom']; ?>">
                                <div id="nameError"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email:
                                </label>
                            </td>
                            <td>
                                <input type="email" name="email" value="<?php echo $ent['email']; ?>" id="email">
                                <div id="emailError"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="doc">date of creation:
                                </label>
                            </td>
                            <td><input type="text" name="doc" id="doc" value="<?php echo $ent['doc']; ?>">
                            <div id="docError"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="location">location:
                                </label>
                            </td>
                            <td>
                                <input type="text" name="location" id="location" value="<?php echo $ent['location']; ?>">
                                <div id="locError"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="secteur">id secteur:
                                </label>
                            </td>
                            <td>
                                <input type="text" name="secteur" id="secteur" value="<?php echo $ent['secteur']; ?>">
                                <div id="SecError"></div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Update">
                            </td>
                            <td>
                                <input type="reset" value="Reset">
                            </td>
                        </tr>
                    </table>
                </form>
                    <?php
                    }
                    else{
                        echo "Sector not found!";
                    }}
                    ?>
                    <script>
                            var formElement = document.getElementById("formadd");
                            var nameElement = document.getElementById("nom");
                            var emailElement = document.getElementById("email");
                            var locationElement = document.getElementById("location");
                            var docElement = document.getElementById("doc");
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
                    
                                if(!nameValue.match(patternName)){
                                    nameError.innerHTML = "Name incorrect";
                                    nameElement.style.borderColor = "red";
                                    isValid = false; 
                                } else {
                                    var currentDate = new Date();
                                    var date = new Date(dateValue);
                                
                                    if (date >= currentDate) {
                                        dateError.innerHTML = "Date must be before the current date";
                                        dateElement.style.borderColor = "red";
                                        isValid = false;
                                    } else {
                                        dateError.innerHTML = "";
                                        dateElement.style.borderColor = "green";
                                    }
                                }
                                if(!docValue.match(patterndoc)){
                                    docError.innerHTML = "type incorrect";
                                    docElement.style.borderColor = "red";
                                    isValid = false;
                                } else {
                                    typeError.innerHTML = "";
                                    typeElement.style.borderColor = "green"; 
                                }
                                if(!emailValue.match(patternemail)){
                                    emailError.innerHTML = "email incorrect ";
                                    emailElement.style.borderColor = "red";
                                    isValid = false;
                                } else {
                                    emailError.innerHTML = "";
                                    emailElement.style.borderColor = "green"; 
                                }
                    
                                if(!locationValue.match(patternlocation)){
                                    locationError.innerHTML = "Lieu incorrect";
                                    locationElement.style.borderColor = "red";
                                    isValid = false;
                                } else {
                                    locationError.innerHTML = "";
                                    locationElement.style.borderColor = "green"; 
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