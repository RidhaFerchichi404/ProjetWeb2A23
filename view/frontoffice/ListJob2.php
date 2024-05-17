<?php
// listJob2.php

// Include JobC.php and create an instance of JobC class
include "../../controller/JobC.php";
$jobC = new JobC();

// Define the number of jobs per page
$limit = 3;

// Get the current page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for SQL query
$offset = ($page - 1) * $limit;

// Fetch total number of jobs
$totalJobs = $jobC->countJobs();

// Calculate total number of pages
$totalPages = ceil($totalJobs / $limit);

// Fetch jobs for the current page
$jobs = $jobC->paginateJobs($offset, $limit);

// Rest of your HTML and PHP code for displaying jobs and pagination
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
                <a href="addJob.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Post A Job<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Job List</h1>
                <nav aria-label="breadcrumb">
                    
                </nav>
            </div>
            <form method="POST" action="" style="display: flex;">
    <input id="myInput" onkeyup="myFunction()" type="text" name="search" placeholder="Search..." style="border-radius: 4px 0 0 4px;"> <!-- Added border-radius for rounded corners -->
    <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0 10px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search" style="width: 24px; height: 24px;">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </button>
</form>
        </div>

        <!-- Header End -->

        <!-- Jobs Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Jobs</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                                <h6 class="mt-n1 mb-0">Featured</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="full-time-tab" class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                                <h6 class="mt-n1 mb-0">Full Time</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="part-time-tab" class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                                <h6 class="mt-n1 mb-0">Part Time</h6>
                            </a>
                        </li>
                    </ul>
                       
               
                    <table border="1" align="center" width="70%">
                    <?php foreach ($jobs as $jobOffer) : ?>
                        <!-- Display each job item here -->
                        <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="img/Job.jpg" alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                        
                                            <h5 class="mb-3"><?= $jobOffer['job_title']; ?></h5>
                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $jobOffer['location']; ?></span>
                                            <span class="job-description text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?= $jobOffer['job_description']; ?></span>
                                            <span class="text-truncate me-3"><i class="far fa-money-bill-alt text-primary me-2"></i><?= $jobOffer['salary']; ?></span>
                                            <span class="text-truncate me-0"><i class="fas fa-globe text-primary me-2"></i><?= $jobOffer['company_website']; ?></span>
                                           
                                        </div>
                                    </div>
                                    <?php $idOffre = $jobOffer['id']; ?>

                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                        <?php
                                        // Get the deadline date of the job offer from the database
                                        $deadlineDate = new DateTime($jobOffer['deadline_date']);
                                        // Get the current date
                                        $currentDate = new DateTime();
                                        echo '<a class="btn btn-primary me-3" href="view_job.php?id=' . $idOffre . '">View</a>';

                                        // Check if the deadline date has passed
                                        if ($currentDate > $deadlineDate) {
                                            // If the deadline date has passed, display a message
                                            echo '<button class="btn btn-danger">Expired</button>';
                                        } else {
                                            // If the deadline date is still valid, display the "Apply Now" button
                                            echo '<a class="btn btn-primary" href="addcandidature.php?id_offre=' . $idOffre . '" >Apply Now</a>';
                                        }
                                        ?>
                                    </div>
</div>

                                </div>
                            
                        </div>
                    <?php endforeach; ?>

                    <!-- Pagination links -->
                    <div class="pagination">
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
        <!-- Jobs End -->
<!-- Suggested job offers section -->
<div class="container mt-5">
    <h2 class="mb-4">Suggested Job Offers for you</h2>
    <div class="row">
        <?php
        // Fetch suggested job offers
        $suggestedJobOffers = $jobC->getSuggestedJobOffers();

        // Display suggested job offers
        foreach ($suggestedJobOffers as $suggestedJob) {
            ?>
                     <!-- Display each job item here -->
                     <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="img/Job.jpg" alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                        
                                            <h5 class="mb-3"><?= $suggestedJob['job_title']; ?></h5>
                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= $suggestedJob['location']; ?></span>
                                            <span class="job-description text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?= $suggestedJob['job_description']; ?></span>
                                            <span class="text-truncate me-3"><i class="far fa-money-bill-alt text-primary me-2"></i><?= $suggestedJob['salary']; ?></span>
                                            <span class="text-truncate me-0"><i class="fas fa-globe text-primary me-2"></i><?= $suggestedJob['company_website']; ?></span>
                                           
                                        </div>
                                    </div>
                                    <?php $idOffre = $jobOffer['id']; ?>

                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                        <?php
                                        // Get the deadline date of the job offer from the database
                                        $deadlineDate = new DateTime($jobOffer['deadline_date']);
                                        // Get the current date
                                        $currentDate = new DateTime();
                                        echo '<a class="btn btn-primary me-3" href="view_job.php?id=' . $idOffre . '">View</a>';

                                        // Check if the deadline date has passed
                                        if ($currentDate > $deadlineDate) {
                                            // If the deadline date has passed, display a message
                                            echo '<button class="btn btn-danger">Expired</button>';
                                        } else {
                                            // If the deadline date is still valid, display the "Apply Now" button
                                            echo '<a class="btn btn-primary" href="addcandidature.php?id_offre=' . $idOffre . '" >Apply Now</a>';
                                        }
                                        ?>
                                    </div>
</div>

                                </div>
                            
                        </div>
            <?php
        }
        ?>
    </div>
</div>

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
    <script>
    function myFunction() {
    var input, filter, jobItems, i, txtValue;
    input = document.getElementsByName("search")[0];
    filter = input.value.toUpperCase();
    jobItems = document.getElementsByClassName("job-item");

    // Loop through all job items, and hide/show those that match the search query
    for (i = 0; i < jobItems.length; i++) {
        txtValue = jobItems[i].textContent || jobItems[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            jobItems[i].style.display = "";
        } else {
            jobItems[i].style.display = "none";
        }
    }
}
// Function to filter jobs based on description
function filterJobs(description) {
    var jobItems = document.getElementsByClassName("job-item");

    for (var i = 0; i < jobItems.length; i++) {
        var jobDescription = jobItems[i].querySelector('.job-description').textContent.trim();

        if (description === 'Full Time' && jobDescription === 'Full Time') {
            jobItems[i].style.display = "";
        } else if (description === 'Part Time' && jobDescription === 'Part Time') {
            jobItems[i].style.display = "";
        } else {
            jobItems[i].style.display = "none";
        }
    }
}

// Add event listeners to "Full Time" and "Part Time" tabs
document.getElementById('full-time-tab').addEventListener('click', function() {
    filterJobs('Full Time');
});

document.getElementById('part-time-tab').addEventListener('click', function() {
    filterJobs('Part Time');
});



</script>
</body>

</html>

