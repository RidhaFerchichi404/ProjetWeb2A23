<?php
    include "../Controller/EventC.php";
    include "../Model/Event.php";
    $error = null;
    $ev = null;
    if(isset($_POST["NameEv"])
    && isset($_POST["OrgEv"])
    && isset($_POST["ThemeEv"])
    && isset($_POST["DateEv"])
    && isset($_POST["LieuEv"])){
        if(!empty($_POST["NameEv"])
        && !empty($_POST["OrgEv"])
        && !empty($_POST["ThemeEv"])
        && !empty($_POST["DateEv"])
        && !empty($_POST["LieuEv"])){
            $ev = new Event(null,
            $_POST["NameEv"],
            $_POST["OrgEv"],
            $_POST["ThemeEv"],
            new DateTime($_POST["DateEv"]),
            $_POST["LieuEv"]);
            //var_dump($_POST["DateEv"]); // testing
            $evC = new EventC();
            $evC->addEvent($ev);
            echo "added succesfully !!";
            header('Location:List.php');
        }else{
            $error = "Missing info";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Events management</title>
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
                <a href="List.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>TheBestEvents</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                </div>
                <div class="navbar-nav w-100">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Events management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="Index.php" class="dropdown-item active">Add an Event</a>
                            <a href="List.php" class="dropdown-item">List of Events</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Blank Start -->

                    <div class="col-md-6 text-center">
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-secondary rounded h-100 p-4">
                                <h6 class="mb-4">Add an Event</h6>
                                <form action="" method="POST" id="AddForm">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="NameEv" id="NameEv"
                                        placeholder="name@example.com">
                                    <label for="floatingInput">Event name</label>
                                    <span class="mb-4" id="nameError" class="error"></span>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="OrgEv" id="OrgEv"
                                        placeholder="Password">
                                    <label for="floatingPassword">Organiser</label>
                                    <span class="mb-4" id="orgError" class="error"></span>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="ThemeEv" id="ThemeEv"
                                        placeholder="Type here">
                                    <label for="floatingInput">Theme of the event</label>
                                    <span class="mb-4" id="themeError" class="error"></span>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="DateEv" id="DateEv">
                                    <label for="floatingInput">Date of the Event</label>
                                    <span class="mb-4" id="dateError" class="error"></span>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="LieuEv" id="LieuEv">
                                    <label for="floatingInput">Location of the event</label>
                                    <span class="mb-4" id="lieuError" class="error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <script src="AddFormValidator.js"></script>
                            </div>
                        </div>
                    </div>
                
        
            <!-- Blank End -->
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