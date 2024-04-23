<?php
include "../config.php";
class UserC
{
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
    function checkloginExist($email,$password){
        $sql = "SELECT * FROM user where email = :email AND password = :password";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':email', $email);
            $query->bindValue(':password', $password);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
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
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function adduser($user)
    {
        $sql = "INSERT INTO user (id  , name, phone,email,password,address,role,photo)
        VALUES (null  , :name, :phone,:email,:password,:address,:role,:photo)";
        $db = config::getConnexion();
        try {
            $photo = $this->handleUploadedFile('photo'); // handle file upload
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $user->getname(),
                'phone' => $user->getphone(),
                'email' => $user->getemail(),
                'password' => $user->getpassword(),
                'address' => $user->getAddress(),
                'role' => $user->getRole(),
                'photo' => $photo, // add photo to the database
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
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




}
?>