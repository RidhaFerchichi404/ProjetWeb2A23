<?php

include "../Controller/JobC.php";
include "../Model/Job.php";

$error = "";
$job = null;
$JobC = new JobC();
$Jobs = $JobC->ListJob();


if (
    isset($_POST["id"]) &&
    isset($_POST["job_title"]) &&
    isset($_POST["company_name"]) &&
    isset($_POST["company_description"]) &&
    isset($_POST["company_website"]) &&
    isset($_POST["job_description"]) &&
    isset($_POST["job_requirements"]) &&
    isset($_POST["salary"]) &&
    isset($_POST["location"])
) {
    if (
        !empty($_POST['id']) &&
        !empty($_POST['job_title']) &&
        !empty($_POST["company_name"]) &&
        !empty($_POST["company_description"]) &&
        !empty($_POST["company_website"]) &&
        !empty($_POST["job_description"]) &&
        !empty($_POST["job_requirements"]) &&
        !empty($_POST["salary"]) &&
        !empty($_POST["location"])
    ) {
        $job = new Job(
            $_POST['id'],
            $_POST['job_title'],
            $_POST['company_name'],
            $_POST['company_description'],
            $_POST['company_website'],
            $_POST['job_description'],
            $_POST['job_requirements'],
            $_POST['salary'],
            $_POST['location']
        );
        $JobC->updateJob($job, $_POST["id"]);
        header('Location:ListJob2.php');
    } else {
        $error = "Missing information";
    }
   
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Job</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Modify Job</h1>
    <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
   
    <form method="post" action="" id="subjectForm">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" readonly><br>
        
        <label for="job_title">Job Title:</label>
        <input type="text" id="job_title" name="job_title"><br>
        
        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name"><br>
        
        <label for="company_description">Company Description:</label>
        <input type="text" id="company_description" name="company_description"><br>
        
        <label for="company_website">Company Website:</label>
        <input type="text" id="company_website" name="company_website"><br>
        
        <label for="job_description">Job Description:</label>
        <input type="text" id="job_description" name="job_description"><br>
        
        <label for="job_requirements">Job Requirements:</label>
        <input type="text" id="job_requirements" name="job_requirements"><br>
        
        <label for="salary">Salary:</label>
        <input type="text" id="salary" name="salary"><br>
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location"><br>
        
        <input type="submit" value="Submit">
    </form>
    <script>
        function populateForm(Job) {
            document.getElementById('id').value = Job['id'];
            document.getElementById('job_title').value = Job['job_title'];
            document.getElementById('company_name').value = Job['company_name'];
            document.getElementById('company_description').value = Job['company_description'];
            document.getElementById('company_website').value = Job['company_website'];
            document.getElementById('job_description').value = Job['job_description'];
            document.getElementById('job_requirements').value = Job['job_requirements'];
            document.getElementById('salary').value = Job['salary'];
            document.getElementById('location').value = Job['location'];
        }
    </script>
</body>
</html>


