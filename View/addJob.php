<?php
    include "../Controller/JobC.php";
    include "../Model/Job.php";
    $error = "";
    $job = null;
    $jobC = new JobC();
    if(isset($_POST["job_title"]) 
    && isset($_POST["company_name"]) 
    && isset($_POST["company_description"]) 
    && isset($_POST["company_website"])
    && isset($_POST["job_description"])
    && isset($_POST["job_requirements"])
    && isset($_POST["salary"])
<<<<<<< HEAD
    && isset($_POST["location"])
    && isset($_POST["deadline_date"])){
=======
    && isset($_POST["location"])){
>>>>>>> 3103e848a4578e384e8d2ce0071c5fc9abb8c944
        if(!empty($_POST["job_title"])
        && !empty($_POST["company_name"])
        && !empty($_POST["company_description"])
        && !empty($_POST["company_website"])
        && !empty($_POST["job_description"])
        && !empty($_POST["job_requirements"])
        && !empty($_POST["salary"])
<<<<<<< HEAD
        && !empty($_POST["location"])
        && !empty($_POST["deadline_date"])){
=======
        && !empty($_POST["location"])){
>>>>>>> 3103e848a4578e384e8d2ce0071c5fc9abb8c944
            $job = new Job(null
            ,$_POST["job_title"]
            ,$_POST["company_name"]
            ,$_POST["company_description"]
            ,$_POST["company_website"]
            ,$_POST["job_description"]
            ,$_POST["job_requirements"]
            ,$_POST["salary"]
            ,$_POST["location"]
<<<<<<< HEAD
            ,$_POST["deadline_date"] 
=======
>>>>>>> 3103e848a4578e384e8d2ce0071c5fc9abb8c944
            );
            
            $jobC->addJob($job);
            header('Location:ListJob2.php');
        }
        else{
            $error = "Missing info"; 
        }
     }
<<<<<<< HEAD
     $email = isset($_POST["email"]) ? $_POST["email"] : null;

=======
>>>>>>> 3103e848a4578e384e8d2ce0071c5fc9abb8c944
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        input[type="reset"] {
            background-color: #f44336;
        }

        input[type="reset"]:hover {
            background-color: #da190b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 8px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Job</h1>
        <form action="" method="POST" onsubmit="return validateForm()">
            <table>
                <tr>
                    <td><label for="job_title">Job Title:</label></td>
                    <td><input type="text" name="job_title" id="job_title" maxlength="50" required></td>
                </tr>
                <tr>
                    <td><label for="company_name">Company Name:</label></td>
                    <td><input type="text" name="company_name" id="company_name" maxlength="50" required></td>
                </tr>
                <tr>
                    <td><label for="company_description">Company Description:</label></td>
                    <td><input type="text" name="company_description" id="company_description" maxlength="255"></td>
                </tr>
                <tr>
                    <td><label for="company_website">Company Website:</label></td>
                    <td><input type="text" name="company_website" id="company_website" maxlength="255"></td>
                </tr>
                <tr>
                    <td><label for="job_description">Job Description:</label></td>
                    <td><input type="text" name="job_description" id="job_description" maxlength="255"></td>
                </tr>
                <tr>
                    <td><label for="job_requirements">Job Requirements:</label></td>
                    <td><input type="text" name="job_requirements" id="job_requirements" maxlength="255"></td>
                </tr>
                <tr>
                    <td><label for="salary">Salary:</label></td>
                    <td><input type="text" name="salary" id="salary" maxlength="50"></td>
                </tr>
                <tr>
                    <td><label for="location">Location:</label></td>
                    <td><input type="text" name="location" id="location" maxlength="50"></td>
                </tr>
                <tr>
<<<<<<< HEAD
                    <td><label for="deadline_date">Deadline Date:</label></td>
                    <td><input type="date" name="deadline_date" id="deadline_date"></td>
                </tr>
                <tr>
=======
>>>>>>> 3103e848a4578e384e8d2ce0071c5fc9abb8c944
                    <td colspan="2" align="center">
                        <input type="submit" value="Save">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </form>
    </div>
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
<<<<<<< HEAD
=======


<!--<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Offer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-top: 50px;
            
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        label {
            font-weight: bold;
            background-image: url('img/about-3.jpg'); /* Add your background image URL here */
            background-repeat: no-repeat;
            background-size: cover;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            width: 100%;
            margin-bottom: 10px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn {
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: bold;
        }
    </style>

    
    <link href="img/favicon.ico" rel="icon">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  
    <link href="css/bootstrap.min.css" rel="stylesheet">

  
    <link href="css/style.css" rel="stylesheet">
 
 <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <h1 class="m-0 text-primary">CareerHub</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.html" class="nav-item nav-link">Home</a>
            <a href="about.html" class="nav-item nav-link">About</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Jobs</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="job-offers.html" class="dropdown-item active">Find a Job</a>
                    <a href="post-job.html" class="dropdown-item">List a Job</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="category.html" class="dropdown-item">Job Category</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404</a>
                </div>
            </div>
            <a href="contact.html" class="nav-item nav-link">Contact</a>
        </div>
    </div>
</nav>

</head>
<body>

<div class="container" >
    <h2>Post a Job Offer</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="job_title" style="background-image: url('label_background_job_title.png')">Job Title:</label>
            <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter the job title" required>
        </div>

        <div class="form-group">
            <label for="company_name" style="background-image: url('label_background_company_name.png')">Company Name:</label>
            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter the company name" required>
        </div>

        <div class="form-group">
            <label for="company_description" style="background-image: url('label_background_company_description.png')">Company Description:</label>
            <textarea class="form-control" id="company_description" name="company_description" rows="4" placeholder="Enter the company description" required></textarea>
        </div>

        <div class="form-group">
            <label for="company_website" style="background-image: url('label_background_company_website.png')">Company Website:</label>
            <input type="url" class="form-control" id="company_website" name="company_website" placeholder="Enter the company website" required>
        </div>

        <div class="form-group">
            <label for="job_description" style="background-image: url('label_background_job_description.png')">Job Description:</label>
            <textarea class="form-control" id="job_description" name="job_description" rows="4" placeholder="Enter the job description" required></textarea>
        </div>

        <div class="form-group">
            <label for="job_requirements" style="background-image: url('label_background_job_requirements.png')">Job Requirements:</label>
            <textarea class="form-control" id="job_requirements" name="job_requirements" rows="4" placeholder="Enter the job requirements" required></textarea>
        </div>

        <div class="form-group">
            <label for="salary" style="background-image: url('label_background_salary.png')">Salary:</label>
            <input type="number" class="form-control" id="salary" name="salary" placeholder="Enter the salary" required>
        </div>

        <div class="form-group">
            <label for="location" style="background-image: url('label_background_location.png')">Location:</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Enter the location" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mr-2">Post Job Offer</button>
            
            <button type="button" class="btn btn-secondary" onclick="cancel()">Cancel</button>
        </div>
    </form>
</div>

<script>
    function cancel() {
        window.location.href = "job-offers.html"; // Redirect to the cancel page
    }
</script>

</body>
</html> -- >

>>>>>>> 3103e848a4578e384e8d2ce0071c5fc9abb8c944
