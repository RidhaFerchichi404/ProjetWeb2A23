<?php
    include "../../controller/JobC.php";
    include "../../model/Job.php";
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
    && isset($_POST["location"])
    && isset($_POST["deadline_date"])){
        if(!empty($_POST["job_title"])
        && !empty($_POST["company_name"])
        && !empty($_POST["company_description"])
        && !empty($_POST["company_website"])
        && !empty($_POST["job_description"])
        && !empty($_POST["job_requirements"])
        && !empty($_POST["salary"])
        && !empty($_POST["location"])
        && !empty($_POST["deadline_date"])){
            $job = new Job(null
            ,$_POST["job_title"]
            ,$_POST["company_name"]
            ,$_POST["company_description"]
            ,$_POST["company_website"]
            ,$_POST["job_description"]
            ,$_POST["job_requirements"]
            ,$_POST["salary"]
            ,$_POST["location"]
            ,$_POST["deadline_date"]
            );
            
            $jobC->addJob($job);
            header('Location:ListJob2.php');
        }
        else{
            $error = "Missing info"; 
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
         $query = "SELECT   nom , location FROM entreprise WHERE email = :email";
         $stmt = $pdo->prepare($query);
         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
         $stmt->execute();
     
         // Récupération des données de l'utilisateur
         if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             
         
             $nom= $row['nom'];
             $location= $row['location'];
         } 
     }
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
                    <td><input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo htmlspecialchars($nom); ?>" readonly></td>
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
                    <td><input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($location); ?>" readonly></td>
                </tr>
                <tr>
                    <td><label for="deadline_date">deadline date:</label></td>
                    <td><input type="date" name="deadline_date" id="deadline_date" maxlength="50"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Save">
                        <input type="reset" value="Reset">
                        <button colspan="2" align="center" class="btn btn-primary"><a href="pageuser.php" >Back to list</a></button>

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



