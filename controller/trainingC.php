<?php
include "../cnx.php";

class trainingC {
    public function listTraining() {
        $sql = "SELECT * FROM training";
        $db = cnx::getConnexion();
        try {
            $List = $db->query($sql);
            return $List;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM training WHERE id_training = :id";
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

    public function traitement($postData) {
        $nom = $postData['name'];
        $date = $postData['date_line'];
        $adresse = $postData['adress'];
        $prix = $postData['prix'];
        $time = $postData['time'];
        $description = $postData['description'];
        $photo = $postData['photo'];

        $sql = "INSERT INTO training (nom, date, adress, price, time, description, photo) VALUES (:nom, :date, :adresse, :prix, :time, :description, :photo)";
        $db = cnx::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->execute([
                'nom' => $nom,
                'date' => $date,
                'adresse' => $adresse,
                'prix' => $prix,
                'time' => $time,
                'description' => $description,
                'photo' => $photo
            ]);
            
        } catch (Exception $e) {
            die("Error Adding: " . $e->getMessage());
        }
    }


    public function gettrainingByID($id_training) {
        $sql = "SELECT * FROM training WHERE id_training = :id";
        $db = cnx::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(":id", $id_training);
        try {
            $req->execute();
            return $req->fetch();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    
    public function edit($id_training) {
        $nom = $_POST['nom'];
        $date = $_POST['date'];
        $adresse = $_POST['adresse'];
        $prix = $_POST['prix'];
        $description = $_POST['description'];
        $photo = $_POST['photo'];

        $sql = "UPDATE training SET nom=:nom, date=:date, adress=:adresse, price=:prix, description=:description, photo=:photo WHERE id_training=:id";       
        $db = cnx::getConnexion();
        $req = $db->prepare($sql);
        try {
            $req->execute([
                'nom' => $nom,
                'date' => $date,
                'adresse' => $adresse,
                'prix' => $prix,
                'description' => $description,
                'photo' => $photo
            ]);
            return true;
        } catch (Exception $e) {
            die("Error Updating: " . $e->getMessage());
            return false;
        }
    }
}
?>