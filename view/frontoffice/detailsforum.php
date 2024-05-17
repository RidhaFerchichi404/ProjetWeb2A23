<?php
include '../../Controller/CommentaireC.php';
include '../../Model/commentaire.php';

$error = null;
$sub = null;
$id_sujet = isset($_GET['id_sujet']) ? $_GET['id_sujet'] : null;

$subC = new CommentaireC();
$recentComments = $subC->getCommentsBySubject($id_sujet);

if (isset($_POST['id_utilisateur']) && isset($_POST['text'])) {
    if (!empty($_POST['id_utilisateur']) && !empty($_POST['text'])) {
        // Filter the comment text using the API
        $text = $_POST['text'];
        $filteredText = filterProfanity($text); // Call the filterProfanity function

        // Create the comment object
        $sub = new commentaire(
            null,
            $id_sujet,
            $_POST['id_utilisateur'],
            $filteredText
        );

        // Add the comment to the database
        $subC->addCommentaire($sub);

        header('Location: detailsforum.php?id_sujet=' . $id_sujet);
        exit();
    } else {
        $error = "Missing information";
    }
}


// Function to filter profanity using API
function filterProfanity($text)
{
    // Replace 'YOUR_API_KEY' with your actual API key
    $apiKey = '4FuizYoEXAWCwggxHxWhPQ==Mhlaxhv2DTS5q2nN';
    $url = 'https://api.api-ninjas.com/v1/profanityfilter?text=' . urlencode($text);
    $headers = array(
        'X-Api-Key: ' . $apiKey
    );

    // Initialize cURL session
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => $headers,
    ));

    // Execute the cURL request
    $response = curl_exec($curl);
    curl_close($curl);

    // Decode the JSON response
    $result = json_decode($response, true);

    if ($result && isset($result['censored'])) {
        return $result['censored'];
    } else {
        return $text; // Return original text if filtering fails
    }
}
session_start();

     // Vérifiez si l'adresse e-mail est stockée dans la session
     if (isset($_SESSION['email'])) {
         // Récupérez l'adresse e-mail de la session
         $email = $_SESSION['email'];
     
         $pdo = new PDO('mysql:host=localhost;dbname=careerhub', 'root', '');
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
        
     
         // Requête préparée pour récupérer le nom et le téléphone de l'utilisateur en fonction de l'adresse e-mail
         $query = "SELECT  id FROM user WHERE email = :email";
         $stmt = $pdo->prepare($query);
         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
         $stmt->execute();
     
         // Récupération des données de l'utilisateur
         if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             
             $id = $row['id'];
             
         } 
     }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CareerHub - Job Portal Website Template</title>
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
        <!-- Include CKEditor source file -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.0/classic/ckeditor.js"></script>

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
                <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Post A Job<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown"> Leave your comment</h1>
                <nav aria-label="breadcrumb">
                    
                </nav>
            </div>
        </div>
        <!-- Header End -->

        <div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Communicate with us</h1>
        <div class="row g-4">
        <?php if (!empty($recentComments)) { ?>
    <div class="job-item col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.1s">
        <h5>Recent Comments:</h5>
        <ul>
            <?php foreach ($recentComments as $comment) : ?>
                <?php $id_sujet = $comment['id_commentaire']; ?>
                <li><?php echo filterProfanity($comment['text']); ?></li>
                <form action="update_comment.php?id_commentaire=<?= $id_sujet ?>" method="post" style="display: inline;">
                    <input type="hidden" name="comment_id" value="<?= $comment['id_sujet']; ?>">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </form>
            <?php endforeach; ?>
        </ul>
    </div>
<?php } ?>

    </div>
</div>

   
        <!-- Job Detail Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row gy-5 gx-4">
                   
                    
                
                            

        
                    <div class="">
                        <h4 class="mb-4">Leave your comment here</h4>
                        <form action="" method="post">
                            <div class="row g-3">
                                <input type="hidden" name="id_poste" value="' . $post['id_sujet'] . '">
                                <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="id_utilisateur" name="id_utilisateur" value="<?php echo htmlspecialchars($id); ?>" readonly>
                                       
                                    <label for="id_utilisateur">ID</label>
                                </div>

                            <div class="col-12">
                                    
       
<!-- Replace the textarea with CKEditor -->
<textarea class="form-control" id="editor" name="text" rows="5" placeholder="Comment"></textarea>

<!-- Initialize CKEditor on the textarea -->
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Post</button>
            </div>
        </div>
    </form>
</div><br>
                            <div class="row g-3">
                                   
                            <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                           
                            <p><i class="fa fa-angle-right text-primary me-2"></i>Comment1</p>
                            <p><i class="fa fa-angle-right text-primary me-2"></i>Comment2</p>
                        </div>
                                   
                            </div>
                        </div>
                    </div>
        
                    <div class="col-lg-4">
                        <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                            <h4 class="mb-4">Détail of subjects</h4>
                            <p><i class="fa fa-angle-right text-primary me-2"></i>Title</p>

                            <p><i class="fa fa-angle-right text-primary me-2"></i>Content</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Job Detail End -->


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
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <?php
// Function to filter bad words using PurgoMalum API
function filterBadWords($text) {
    // API endpoint URL
    $url = 'https://www.purgomalum.com/service/containsprofanity?text=' . urlencode($text);

    // Make a GET request to the API
    $response = file_get_contents($url);

    // Check if the response contains profanity
    if ($response === 'true') {
        return true; // Text contains profanity
    } else {
        return false; // Text does not contain profanity
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted comment text
    $commentText = $_POST["text"];

    // Filter the comment text for bad words
    if (filterBadWords($commentText)) {
        echo "Your comment contains profanity. Please revise.";
    } else {
        // Proceed with submitting the comment
        echo "Your comment has been submitted successfully.";
        // Add code here to save the comment to your database or perform other actions
    }
}
?>

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