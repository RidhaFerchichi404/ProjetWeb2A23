<?php
include "../cnx.php";



class partC {
    public function list() {
        $sql = "SELECT * FROM training_part";
        $db = cnx::getConnexion();
        try {
            $List = $db->query($sql);
            return $List;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function Delete($id) {
        $sql = "DELETE FROM training_part WHERE id = :id";
        $db = cnx::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(":id", $id);
        try {
            $req->execute();
        }
        catch (Exception $e) {
            die("Error: ". $e->getMessage());
        }
    }

    public function traitement($_POST) {
        $sql = "INSERT INTO training_part (name, phone, cv, upload, lettre) VALUES (:name, :phone, :cv, :upload, :lettre)";
        $db = cnx::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->execute([
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'cv' => $_POST['cv'],
                'upload' => $_POST['upload'],
                'lettre' => $_POST['lettre']
            ]);
            
        } catch (Exception $e) {
            die("Error Adding: " . $e->getMessage());
        }
    }


    public function getpart($id) {
        $sql = "SELECT * FROM training_part WHERE id = :id";
        $db = cnx::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(":id", $id);
        try {
            $req->execute();
            return $req->fetch();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    
    public function edit($id) {
        $sql = "UPDATE training_part SET name=:name, phone=:phone, cv=:cv, upload=:upload, lettre=:lettre WHERE id=:id";
        $db = cnx::getConnexion();
        $req = $db->prepare($sql);
        try {
            $req->execute([
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'cv' => $_POST['cv'],
                'upload' => $_POST['upload'],
                'lettre' => $_POST['lettre']
            ]);
            return true;
        } catch (Exception $e) {
            die("Error Updating: " . $e->getMessage());
            return false;
        }
    }
}
     
   
?>