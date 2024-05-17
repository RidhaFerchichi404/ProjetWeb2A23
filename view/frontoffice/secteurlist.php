<?php
include "../../controller/SecteurC.php";
$secC=new SecteurC();
$list=$secC->listsecteur();
// Check if the search form is submitted
$limit = 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if (isset($_POST['submit-search'])) {
    $search = $_POST['search'];
    $list = $secC->searchsec($search);
    $totalJobs = count($list);
}else {
    // Fetch paginated data if the search form is not submitted
    $offset = ($page - 1) * $limit;
    $totalJobs = $secC->countsec();
    $list = $secC->paginatesec($offset, $limit);
}
$totalPages = ceil($totalJobs / $limit);
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
        <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-white rounded align-items-center justify-content-center mx-0">
            <div class="col-md-6 text-center">
            <form class="search-form" action="" method="POST">
                         <input type="text" id="search-box" name="search" placeholder="search here...">
                         <button type="submit" name="submit-search"><i class="fas fa-search"></i> Search</button>
                    </form>
                <h3> Sectors List</h3>
                        <?php
                         foreach ($list as $secteur) {
                        ?> 
                        <div class="job-item p-4 mb-4">
                              <div class="row g-4">
                                 <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                  <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-4.jpg" alt="" style="width: 80px; height: 80px;">
                                  <div class="text-start ps-4">
                                        <h5 class="mb-3"><?= $secteur['nom']; ?></h5>
                                        <span class="text-truncate me-3"><i class="fas fa-globe text-primary me-2"></i><?= $secteur['email']; ?></span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?= $secteur['type']; ?></span>
                                        <span class="text-truncate me-3"><i class="far fa-building text-primary me-2"></i><?= $secteur['nb_entreprises']; ?></span>
                                        <span class="text-truncate me-0"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $secteur['region']; ?></span>
                                        <span class="text-truncate me-0"><i class="fas fa-graduation-cap text-primary me-2"></i><?= $secteur['exigence_formation']; ?></span>
                                        </div>
                                    </div>
                                        <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    </div>
                                </div>
                            </div>
                            <?php
                            } 
                            ?>
                        </table>
                        <div id="pagination">
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
        <!-- Job Detail End -->


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