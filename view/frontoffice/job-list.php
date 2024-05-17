<?php
    include_once "../../controller/EventC.php";
    include "../../model/Event.php";
    
    $error = "";
    $evC = new EventC();
    $list = $evC->ListEvents();


    // Pagination variables
$eventsPerPage = 4;
$totalEvents = count($list);
$totalPages = ceil($totalEvents / $eventsPerPage);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $eventsPerPage;
$events = array_slice($list, $offset, $eventsPerPage);

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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Events</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="job-list.php" class="dropdown-item active">Event List</a>
                        </div>
                    </div>
                </div>
                <a href="addJob.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Post A Job<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Events List</h1>
                <nav aria-label="breadcrumb">
                    
                </nav>
            </div>
        </div>
        <!-- Header End -->

        <!-- Search Start -->
        <form method="POST" action="">
                <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
                    <div class="container">
                        <div class="row g-2">
                            <div class="col-md-10">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <input type="text" id="search" name="search" class="form-control border-0" placeholder="Keyword" />
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select border-0" name="search_option">
                                            <option selected disabled>Choose search</option>
                                            <option value="1">Event</option>
                                            <option value="2">Organizateur</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" name="submit" class="btn btn-dark border-0 w-100">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_option"])) {
    if (!empty($_POST["search"]) && !empty($_POST["search_option"])) {
        $listS = null;
        $sEv = null;       
        $searchOption = $_POST["search_option"];       
        if ($searchOption == 1) {
            $listS = $evC->searchEventByName($_POST["search"]);
            if ($listS) {
                foreach ($listS as $sEv) {
                    $participantsLeft = $evC->CountPlacesLeft($sEv['idEvent']);
        ?>
                    <!-- Render each search result -->
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3"><?= $sEv['nomEvent']; ?></h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $sEv['lieuEvent']; ?></span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?= $sEv['dateEvent']; ?></span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?= $sEv['orgEvent']; ?></span>
                                    <span class="text-truncate me-0"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $sEv['NbPart']; ?></span>
                                    <span class="text-truncate me-0"><i class="fa fa-user text-primary me-2"></i><?= $participantsLeft; ?> Participants Left</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                } else {
                    echo "No event found.";
                }
            }else if($searchOption == 2){
                $listS = $evC->searchEventByOrganizer($_POST["search"]);
                if ($listS) {
                    foreach ($listS as $sEv) {
                        $participantsLeft = $evC->CountPlacesLeft($sEv['idEvent']);
            ?>
                        <!-- Render each search result -->
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3"><?= $sEv['nomEvent']; ?></h5>
                                        <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $sEv['lieuEvent']; ?></span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?= $sEv['dateEvent']; ?></span>
                                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?= $sEv['orgEvent']; ?></span>
                                        <span class="text-truncate me-0"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $sEv['NbPart']; ?></span>
                                        <span class="text-truncate me-0"><i class="fa fa-user text-primary me-2"></i><?= $participantsLeft; ?> Participants Left</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
            } 
        } else {
            echo "No event found.";
        }
    }
}
    }
    ?>


        <!-- Search End -->

        <!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">The Best Events</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                        <h6 class="mt-n1 mb-0">Featured</h6>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <?php
                    $list2 = $evC->ListEventsWithPlacesLeft();
                    $eventsPerPage = 4;
                    $totalEvents = count($list2);
                    $totalPages = ceil($totalEvents / $eventsPerPage);
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($currentPage - 1) * $eventsPerPage;
                    $eventsToDisplay = array_slice($list2, $offset, $eventsPerPage);

                    foreach ($eventsToDisplay as $Event) :
                        if ($Event['placesLeft'] === 0) {
                            $evC->deleteEventOnZero($Event['idEvent']);
                        } else {
                    ?>
                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3"><?= $Event['nomEvent']; ?></h5>
                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $Event['idEvent']; ?></span>
                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $Event['lieuEvent']; ?></span>
                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?= $Event['dateEvent']; ?></span>
                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?= $Event['orgEvent']; ?></span>
                                            <span class="text-truncate me-0"><i class="fa fa-user text-primary me-2"></i><?= $Event['placesLeft']; ?> Participants Left</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <form action="Participation.php" method="post">
                                                <input type="hidden" name="idEvent" value="<?= isset($Event['idEvent']) ? $Event['idEvent'] : '' ?>">
                                                <button class="btn btn-primary" type="submit">Participate Now </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    endforeach;
                    ?>
                </div>
            </div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?= $i ?>" class="<?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

        <!-- Jobs End -->


        <!-- Footer Start -->
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