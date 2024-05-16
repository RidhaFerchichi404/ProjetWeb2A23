<?php

include '../../controller/ParticipantC.php';

$error = "";
$Pr = null;
$PrC = new ParticipantC();
if (
    isset($_POST["idPart2"]) &&
    isset($_POST["nomPart2"]) &&
    isset($_POST["agePart2"]) &&
    isset($_POST["emailPart2"]) &&
    isset($_POST["idEventPart2"])
) {
    if (
        !empty($_POST["idPart2"])&&
        !empty($_POST["nomPart2"]) &&
        !empty($_POST["agePart2"]) &&
        !empty($_POST["emailPart2"]) &&
        !empty($_POST["idEventPart2"]) 
    ) {
        $Pr = new Participant($_POST["idPart2"],$_POST["nomPart2"],$_POST["agePart2"],$_POST["emailPart2"]);
        $PrC->updatePart($Pr,$_POST["idPart2"],$_POST["idEventPart2"]);
        header('Location:ListP.php');
    } else
        $error = "Missing information";
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
                            <a href="Events.php" class="dropdown-item">Add an Event</a>
                            <a href="AddParticipant.php" class="dropdown-item">Add a participant</a>
                            <a href="List.php" class="dropdown-item">List of Events</a>
                            <a href="ListP.php" class="dropdown-item">List of participants</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Blank Start -->
            <?php echo $error; ?>
            <?php
                if (isset($_POST['idPart'])) {
                    $Pr = $PrC->getParticipantsByPartId($_POST['idPart']);
                    var_dump($Pr);
            ?>
        <div class="container-fluid pt-4 px-4">
            <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 text-center">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Update the Participant</h6>
                            <form action="" method="POST" id="UpdatePForm">
                            <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="idPart2" id="idPart2" value="<?= $Pr['idPart'] ?? ''; ?>">
                                    <label for="floatingInput">Participant id</label>
                                    <span class="mb-4" id="idPError" class="error"></span>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="nomPart2" id="nomPart2" value="<?= $Pr['nomPart'] ?? ''; ?>">
                                    <label for="floatingInput">Participant name</label>
                                    <span class="mb-4" id="nameError" class="error"></span>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="agePart2" id="agePart2" value="<?= $Pr['agePart'] ?? ''; ?>">
                                    <label for="floatingPassword">Age of Participant</label>
                                    <span class="mb-4" id="ageError" class="error"></span>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="emailPart2" id="emailPart2" value="<?= $Pr['emailPart'] ?? ''; ?>">
                                    <label for="floatingInput">Email of participant</label>
                                    <span class="mb-4" id="emailError" class="error"></span>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="idEventPart2" id="idEventPart2" value="<?= $Pr['idEvent'] ?? ''; ?>">
                                    <label for="floatingInput">id of The event for participant</label>
                                    <span class="mb-4" id="idEError" class="error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button class="btn btn-primary" action="ListP.php">Back to list</button>
                            </form>
                                
                            <?php
                                }
                            ?>
                            <script src="UpdatePFormValidator.js"></script>
                        </div>
                    </div>
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