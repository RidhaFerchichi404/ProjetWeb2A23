<?php
require __DIR__ . '/../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include "../../config.php";
class UserC
{
    function adduser($user)
{
    $log = new Logger('adduser');
    $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/adduser.log', Logger::INFO));

    $sql = "INSERT INTO user (name, phone, email, password, address, role, photo)
            VALUES (:name, :phone, :email, :password, :address, :role, :photo)";
    // Log the SQL query
    $db = config::getConnexion();
    try {
        // Hash the password
        $hashedPassword = password_hash($user->getpassword(), PASSWORD_DEFAULT);
        
        // Handle file upload
        $photo = $this->handleUploadedFile('photo');
        
        // Prepare and execute the SQL query
        $query = $db->prepare($sql);
        $query->execute([
            'name' => $user->getname(),
            'phone' => $user->getphone(),
            'email' => $user->getemail(),
            'password' => $hashedPassword, // Store hashed password
            'address' => $user->getAddress(),
            'role' => $user->getRole(),
            'photo' => $photo, // add photo to the database
        ]);

        $log->info('THE BEFORE');
        // If the user is successfully added, send a notification email
        if ($query) {
            $log->info('IS GOING TO SEND MAIL FCT', ['query_before' => $query]);
            $this->sendNotificationEmail($user->getemail());
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
// Method to send notification email
private function sendNotificationEmail($email)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    $log = new Logger('sendnotif');
    $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/sendnotif.log', Logger::INFO));
    $log->info('MAIL FUNCTION INIT', ['init' => $email]);

    // Set up SMTP for Gmail
    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'aichasmaoui22@gmail.com'; // Your Gmail address
    $mail->Password = 'vmeh dryk xqsf vldf'; // Your Gmail password

    // Set up email content
    $mail->setFrom('webreverso2a28@gmail.com', 'CareerHub'); // Sender's email address and name
    $mail->addAddress($email); // Recipient's email address
    $mail->Subject = 'Welcome to Our Website'; // Email subject
    $mail->Body = 'Thank you for signing up on our website!'; // Email body

    
    $log->info('THE MAIL ITSELF', ['mail' => $mail]);

    try {
        $log->info('SENDING MAIL');
        $mail->send();
        $log->info('MAIL SENT');
    }
    catch(Exception $e)
    {
        $log->error('MAIL NOT SENT:', ['error' => $e->getMessage()]);
    }
    // Send the email
}
    function list() //affichage de produit
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $service = $query->fetch();
            $res = [];
            for ($x = 0; $service; $x++) {
                $res[$x] = $service;
                $service = $query->fetch();
            }
            return $res;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function researcherParName($name) 
    {
        $sql = "SELECT * FROM user where name = :name";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':name', $name);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function checkloginExist($email, $password)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':email', $email);
            $query->execute();
            $user = $query->fetch();
    
            if ($user) {
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Password is correct, return the user record
                    return $user;
                } else {
                    // Password is incorrect
                    return false;
                }
            } else {
                // User with the provided email does not exist
                return false;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    function delete($name)
    {
        $sql = "DELETE FROM user WHERE name = :name";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':name', $name);

        try {
            $req->execute();
            return true;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
            return false;
        }
    }

    
    

    function update($user, $id)
    {
        try {

            $db = config::getConnexion();
            $photo = $this->handleUploadedFile('photo'); // handle file upload

            $query = $db->prepare(
                'UPDATE user SET    
                  name = :name,              
                  phone = :phone,
                  email = :email,
                  password = :password,
                  address = :address,
                  role = :role,
                  photo = :photo
                WHERE id = :id'
            );
            $query->execute([
                'id' => $id,
                'name' => $user->getname(),
                'phone' => $user->getphone(),
                'email' => $user->getemail(),
                'password' => $user->getpassword(),
                'address' => $user->getAddress(),
                'role' => $user->getRole(),
                'photo' => $photo,
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    private function handleUploadedFile($inputName)
    {
        if (empty($_FILES[$inputName]['name'])) {
            return null;
        }
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES[$inputName]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES[$inputName]["tmp_name"]);
        if($check === false) {
            throw new Exception("File is not an image.");
        }
        // Check file size
        if ($_FILES[$inputName]["size"] > 500000) {
            throw new Exception("File is too large.");
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            throw new Exception("Only JPG, JPEG, PNG & GIF files are allowed.");
        }
        if (!move_uploaded_file($_FILES[$inputName]["tmp_name"], $target_file)) {
            throw new Exception("Error uploading file.");
        }
        return $target_file;
    }

    function getCurrentUser() 
    {
        $log = new Logger('getCurrentUser');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/getCurrentUser.log', Logger::INFO));
        session_start(); // Démarrer la session

        // Vérifier si l'utilisateur est connecté
        if(isset($_SESSION['name'])) { 

            
            // Si l'utilisateur est connecté, récupérer les informations de l'utilisateur à partir de la session
            $name = $_SESSION['name'];
            $log->info('IN SESSION', ['user name' => $name]);

            $sql = "SELECT * FROM user WHERE name = :name";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->bindValue(':name', $name);
                $query->execute();
                $user =  $query->fetch();
                $log->info('IN SESSION', ['user' => $user]);
                return $user;
            } catch (Exception $e) {
                $log->error('NO USER', ['message' =>$e->getMessage()]);
                die('Error:' . $e->getMessage());
            }
        } else {
            $log->error('NO USER');
            // Si l'utilisateur n'est pas connecté, retourner null ou un message d'erreur
            return null;
        }
    }
    
    public function countUsers() {
        try {
            $db = config::getConnexion();
            $query = $db->query("SELECT COUNT(*) AS total_users FROM user");
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total_users'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    // Method to fetch users for the current page
    public function paginateUsers($offset, $limit) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare("SELECT * FROM user LIMIT :limit OFFSET :offset");
            $query->bindParam(':limit', $limit, PDO::PARAM_INT);
            $query->bindParam(':offset', $offset, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



// search letssss go
  public function searchUsers($search, $offset, $limit) {
    try {
        $db = config::getConnexion();
        // Using parameterized query to avoid SQL injection
        $query = $db->prepare("SELECT * FROM user WHERE name LIKE :search LIMIT :offset, :limit");
        $query->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        // Calculate the total offset
        $totalOffset = (int)$offset * (int)$limit;  
        $query->bindValue(':offset', $totalOffset, PDO::PARAM_INT);
        $query->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the error gracefully, e.g., log it or present a user-friendly message
        error_log("Error searching users: " . $e->getMessage());
        // Return some default or empty value, or rethrow the exception for higher-level handling
        return [];
    }
}






}
?>