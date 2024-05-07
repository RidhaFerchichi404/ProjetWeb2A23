<?php
// Assuming you have a MySQL database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = ''; // No password by default
$dbName = 'webapp';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data



$name=$_POST['name'];
  $phone=$_POST['phone'];
 $email=$_POST['email'];
$password=$_POST['password'];
 $address=$_POST['address'];
$role=$_POST['role'];



// Insert data into database
$sql = "INSERT INTO webapp (name, phone , email ,password ,address, role) VALUES ('$name', '$phone','$email','$password','$address','$role')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
