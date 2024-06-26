<?php
require_once "../../config.php";
class EntrepriseC{
    public function listentreprise(){
        $sql="SELECT * FROM entreprise";
        $db=config::getConnexion();
        try{
            $list = $db->query($sql);
            return $list;
        }
        catch(Exception $e){
            die("message error".$e->getMessage());
        }
    }
    
    public function suppentreprise($id){
        $sql="DELETE FROM entreprise WHERE id= :id";
        $db=config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindParam(':id',$id);
        try{
            $req->execute();
        }
        catch(Exception $e){
            die("Message error=".$e->getMessage());
        }
    }
    public function addentreprise($sec)
    {
        $sql="INSERT INTO entreprise (id,nom,email,doc,location,secteur) VALUES (NULL,:nom,:email,:doc,:location,:secteur)";
        $db=config::getConnexion();
        try{
            $req=$db->prepare($sql);
            $req->execute([
                "nom"=>$sec->getnom(),
                "email"=>$sec->getemail(),
                "doc"=>$sec->getdoc(),
                "location"=>$sec->getlocation(),
                "secteur"=>$sec->getsecteur(),
            ]);
        }
        catch(Exception $e){
            die('error ajout'.$e->getMessage());
        } 
    }
    public function updateentreprise($sec, $id)
    {
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE entreprise SET 
                nom = :nom, 
                email = :email, 
                doc = :doc, 
                location = :location,
                secteur = :secteur
            WHERE id = :id'
        );
        $query->execute([
            'id' => $id,
            'nom' => $sec->getnom(),
            'email' => $sec->getemail(),
            'doc' => $sec->getdoc(),
            'location' => $sec->getlocation(),
            'secteur' => $sec->getsecteur(),
        ]);
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
    }
        function showentreprise($id)
        {
            $sql = "SELECT * from entreprise where id = $id";
            $db = config::getConnexion();
            try 
            {
                $query = $db->prepare($sql);
                $query->execute();
                $sec = $query->fetch();
                return $sec;
            } 
            catch (Exception $e)
            {
                die('Error: ' . $e->getMessage());
            }
        }

        public function countent() {
            try {
                $db = config::getConnexion();
                $query = $db->query("SELECT COUNT(*) AS total_entreprises FROM entreprise");
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result['total_entreprises'];
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        
        // Method to fetch jobs for the current page
        public function paginateent($offset, $limit) {
            try {
                $db = config::getConnexion();
                $query = $db->prepare("SELECT * FROM entreprise LIMIT :limit OFFSET :offset");
                $query->bindParam(':limit', $limit, PDO::PARAM_INT);
                $query->bindParam(':offset', $offset, PDO::PARAM_INT);
                $query->execute();
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        function searchent($search){
            $requete = "SELECT * FROM entreprise WHERE CONCAT(id, nom, email,doc,location,secteur) LIKE '%$search%'";
            $db = config::getConnexion();
            try {
            $querry = $db->prepare($requete);
            $querry->execute();
            $result = $querry->fetchAll();
            return $result ;
            } catch (PDOException $e) {
                echo "Error: " .$e->getMessage();
            }
        }

}
?>
