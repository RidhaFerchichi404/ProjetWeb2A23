<?php
include "../../controller/userC.PHP";
include_once "../../config.PHP";


$userC = new UserC();

session_start();

$error = null;

if (
  isset($_POST['email']) &&
  isset($_POST['password']) 
) {
  
  if(empty($_POST['email'])||empty($_POST['password']))
  {
    $error = "fields are empty";
  }
  else
  {
    
  $user =$userC->checkloginExist($_POST['email'],$_POST['password']);

  if($user)
  {
    $_SESSION['email'] = $_POST['email'];
    if($user['role']=="Admin")
    {
        $_SESSION['name'] = $user['name'];
        setcookie('name', $user['name'], time() + (86400 * 30), "/");
        header('Location: ../backoffice/tables.php');
    }
    else {
        $_SESSION['name'] = $user['name'];
        setcookie('name', $user['name'], time() + (86400 * 30), "/");
        header('Location:pageuser.php');}
  }
  else {
    $error = "account doesnt exist";
  }  
}
  
  if($error != null)
  {
    echo "<script>alert('".$error."')</script>";
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

    <!-- Custom Styles -->
    <style>
        /* Add your custom styles here */

        body {
            font-family: 'Heebo', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: #007bff;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 0.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .card-footer {
            background-color: transparent;
            border-top: 1px solid #dee2e6;
            padding-top: 0.5rem;
        }

        .btn {
            border-radius: 8px;
            color: blue;
            
        }
        /* Custom styles for sign-in form */
#signin-form {
    max-width: 400px; /* Adjust the maximum width as needed */
    margin: auto; /* Center the form horizontally */
}

#signin-form label {
    font-size: 1.2rem; /* Increase label font size */
}

#signin-form .form-control {
    font-size: 1.2rem; /* Increase input field font size */
    padding: 1.5rem; /* Increase padding around input fields */
}

#signin-form button {
    font-size: 1.2rem; /* Increase button font size */
    padding: 1.2rem 2rem; /* Increase padding around the button */
}

    </style>
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
                    
                    <a href="in.php" class="nav-item nav-link"></a>
                </div>
                <a href="in.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Sign In</a>
            </div>
        </nav>
        <!-- Navbar End -->

        <main class="main-content  mt-0">
            <section>
                <div class="page-header min-vh-75">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                                <div class="card card-plain mt-8">
                                    <div class="card-header pb-0 text-left bg-transparent">
                                        <h3 class="btn bg-gradient-info btn-lg w-100 mt-4 mb-0" align="center">Welcome back</h3>
                                        <p class="mb-0" align="center">Enter your email and password to sign in</p>
                                    </div>
                                    <div class="card-body">
                                    <form id="signin-form" role="form text-left" method="post" enctype="multipart/form-data" action="" autocomplete="on"> 
                                      <label for="email">Email</label>
                                      <div class="mb-3">
                                          <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                      </div>
                                      <label for="password">Password</label>
                                      <div class="mb-3">
                                          <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                      </div>
                                      <div class="text-center">
                                          <button type="submit" class="btn bg-gradient-info btn-lg w-100 mt-4 mb-0">Sign in</button>
                                      </div>
                                  </form>

                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-0 text-sm mx-auto">
                                            Don't have an account?
                                            <a href="up.php" class="btn  w-100 mt-4 mb-0">Sign up</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

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
