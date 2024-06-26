<?php
include "../../controller/JobC.php";
include "../../model/Job.php";
require_once "../../config.php";

// Function to update job details
function updateJob($jobData)
{
    $error = "";
    $JobC = new JobC();

    // Handle form submission
    if (
        isset($jobData["id"]) &&
        isset($jobData["job_title"]) &&
        isset($jobData["company_name"]) &&
        isset($jobData["company_description"]) &&
        isset($jobData["company_website"]) &&
        isset($jobData["job_description"]) &&
        isset($jobData["job_requirements"]) &&
        isset($jobData["salary"]) &&
        isset($jobData["location"])
        && isset($jobData["deadline_date"])
        && isset($jobData["view_counter"])
    ) {
        // Check if form fields are not empty
        if (
            !empty($jobData['id']) &&
            !empty($jobData['job_title']) &&
            !empty($jobData["company_name"]) &&
            !empty($jobData["company_description"]) &&
            !empty($jobData["company_website"]) &&
            !empty($jobData["job_description"]) &&
            !empty($jobData["job_requirements"]) &&
            !empty($jobData["salary"]) &&
            !empty($jobData["location"])
            && !empty($jobData["deadline_date"])
            && !empty($jobData["view_counter"])
        ) {
            // Create a new job object
            $job = new Job(
                $jobData['id'],
                $jobData['job_title'],
                $jobData['company_name'],
                $jobData['company_description'],
                $jobData['company_website'],
                $jobData['job_description'],
                $jobData['job_requirements'],
                $jobData['salary'],
                $jobData['location'],
                $jobData['deadline_date'],
                $jobData['view_counter']

            );

            // Update the job in the database
            $JobC->updateJob($job, $jobData["id"]);
            header('Location:ListBack.php');
            exit(); // Ensure script execution stops after redirection
        } else {
            $error = "Missing information";
        }
    }
    return $error;
}

// Extract the 'id' parameter from the URL
$id = $_GET['id'] ?? null;

// Fetch the job details based on the 'id' parameter
if ($id) {
    $jobC = new JobC();
    $job = $jobC->getJobById($id);
}

// Call the updateJob function when the form is submitted
$error = updateJob($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CareerHub</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: blue;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: blue;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: lightblue;
        }

        .error {
            color: red;
            margin-bottom: 20px;
        }
        /* Add this CSS to your existing styles */
.navbar {
    z-index: 1000; /* Ensure the navbar stays on top */
}

.content {
    margin-top: 70px; /* Adjust this value based on your navbar height */
}

.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

form {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%; /* Full width */
    max-width: 600px; /* Limit width for better readability */
}

    </style>

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
                    <a href="ListBack.php" class="nav-item nav-link active"><i class="fa fa-chart-bar me-2"></i>Jobs</a>
                    <a href="table.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forums</a>
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
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Entreprise</a>
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
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Worldwide Sales</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="worldwide-sales"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Salse & Revenue</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="salse-revenue"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">UPDATE</h6>
                    </div>
                    <div class="table-responsive">
                    <div class="form-container">
                <form method="POST" action="" class="bg-secondary text-center rounded p-4" onsubmit="return validateForm()">
                    <h1>Update Job</h1>
                    <?php if (!empty($error)) {
                        echo "<p class='error'>$error</p>";
                    } ?>
                    <?php if ($job) { ?>
                        <!-- Populate form fields with job details -->
                        <label for="id">ID:</label>
                        <input type="text" value="<?php echo $job['id']; ?>" id="id" name="id" readonly>

                        <label for="job_title">Job Title:</label>
                        <input type="text" value="<?php echo $job['job_title']; ?>" id="job_title" name="job_title">

                        <label for="company_name">Company Name:</label>
                        <input type="text" value="<?php echo $job['company_name']; ?>" id="company_name" name="company_name">

                        <label for="company_description">Company Description:</label>
                        <input type="text" value="<?php echo $job['company_description']; ?>" id="company_description" name="company_description">

                        <label for="company_website">Company Website:</label>
                        <input type="text" value="<?php echo $job['company_website']; ?>" id="company_website" name="company_website">

                        <label for="job_description">Job Description:</label>
                        <input type="text" value="<?php echo $job['job_description']; ?>" id="job_description" name="job_description">

                        <label for="job_requirements">Job Requirements:</label>
                        <input type="text" value="<?php echo $job['job_requirements']; ?>" id="job_requirements" name="job_requirements">

                        <label for="salary">Salary:</label>
                        <input type="text" value="<?php echo $job['salary']; ?>" id="salary" name="salary">

                        <label for="location">Location:</label>
                        <input type="text" value="<?php echo $job['location']; ?>" id="location" name="location">
                        
                        <label for="deadline_date">deadline date:</label>
                        <input type="date" value="<?php echo $job['deadline_date']; ?>" id="deadline_date" name="deadline_date">

                        <label for="view_counter">view counter:</label>
                        <input type="text" value="<?php echo $job['view_counter']; ?>" id="view_counter" name="view_counter" readonly>

                        <input type="submit" value="Submit">
                    <?php } ?>
                </form>
            </div>
                    </div>
                </div>
            </div>
         
            <!-- Recent Sales End -->


            

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
    <script>
        function validateForm() {
            var jobTitle = document.getElementById('job_title').value;
            var companyName = document.getElementById('company_name').value;
            var company_description = document.getElementById('company_description').value;
            var company_website = document.getElementById('company_website').value;
            var job_description = document.getElementById('job_description').value;
            var job_requirements = document.getElementById('job_requirements').value;
            var salary = document.getElementById('salary').value;
            var location = document.getElementById('location').value;

            if (jobTitle.trim() === '' || companyName.trim() === '' || company_description.trim() === ''  || company_website.trim() === '' || job_description.trim() === '' || job_requirements.trim() === '' || location.trim() === '' ) {
                alert('Fields are required');
                return false;
            }

            if (isNaN(parseFloat(salary)) || !isFinite(salary) || parseFloat(salary) <= 0) {
                alert('Salary must be a positive number');
                return false;
            }

            return true; 
        }
    </script>
</body>

</html>