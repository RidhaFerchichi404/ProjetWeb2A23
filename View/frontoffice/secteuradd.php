<?php
session_start();

// Vérifiez si l'adresse e-mail est stockée dans la session
if (isset($_SESSION['email'])) {
    // Récupérez l'adresse e-mail de la session
    $email = $_SESSION['email'];

    $pdo = new PDO('mysql:host=localhost;dbname=careerhub', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   

    // Requête préparée pour récupérer le nom et le téléphone de l'utilisateur en fonction de l'adresse e-mail
    $query = "SELECT   email FROM user WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Récupération des données de l'utilisateur
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
    
        $email= $row['email'];
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
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Events</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="job-list.php" class="dropdown-item active">Event List</a>
                        </div>
                    </div>
                    
                </div>
                <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Post A Job<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Secters list</h1>
                <nav aria-label="breadcrumb">
                    
                </nav>
            </div>
        </div>
        <!-- Header End -->


        <!-- Jobs Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0" >
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
                            <input type="text" class="form-control" id="region" name="region" placeholder="Enter region here">
                            <div id="lieuError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="exigence_formation" class="form-label">Training requirement :</label>
                            <textarea class="form-control" id="exigence_formation" name="exigence_formation" rows="3" placeholder="Enter desccription here"></textarea>
                            <div id="exigenceError"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">ADD</button>
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
                </div>
            </div>
        </div>
        <!-- Jobs End -->


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