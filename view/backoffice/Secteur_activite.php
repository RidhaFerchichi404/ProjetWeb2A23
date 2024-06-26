
<?php
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
                        <a href="#" class="nav-link dropdown-toggle" >
                            </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-6 text-center">
                        <h3>Add Secteur</h3>
                        <form action="addsecteur.php" method="post" id="formadd">
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
                                <label for="type" class="form-label">Type :</label>
                                <input type="text" class="form-control" id="type" name="type" placeholder="Enter type here">
                                <div id="typeError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="nb_entreprises" class="form-label">Number of companys :</label>
                                <input type="text" class="form-control" id="nb_entreprises" name="nb_entreprises" placeholder="Enter number of companys here">
                                <div id="nbError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="region" class="form-label">Region :</label>
                                <input type="text" class="form-control" id="region" name="region" placeholder="Enter number of companys here">
                                <div id="lieuError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="exigence_formation" class="form-label">Training requirement :</label>
                                <textarea class="form-control" id="exigence_formation" name="exigence_formation" rows="3" placeholder="Enter desccription here"></textarea>
                                <div id="exigenceError"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                        <script>
                            var formElement = document.getElementById("formadd");
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
                                var patternexigence = /^[a-zA-Z ]+$/;
                    
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