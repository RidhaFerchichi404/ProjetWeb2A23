<?php
include "../../config.php";
    class SecteurC{
        public
        function listsecteur(){
            $sql="SELECT * FROM secteur_activite";
            $db=config::getConnexion();
            try{
                $list = $db->query($sql);
                return $list;
            }
            catch(Exception $e){
                die("message error".$e->getMessage());
            }
        }

        public function suppsecteur($id){
            $sql="DELETE FROM secteur_activite WHERE id= :id";
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
        public function addsecteur($sec)
        {
            $sql="INSERT INTO secteur_activite (id,nom,email,type,nb_entreprises,region,exigence_formation) VALUES (NULL,:nom,:email,:type,:nb_entreprises,:region,:exigence_formation)";
            $db=config::getConnexion();
            try{
                $req=$db->prepare($sql);
                $req->execute([
                    "nom"=>$sec->getnom(),
                    "email"=>$sec->getemail(),
                    "type"=>$sec->gettype(),
                    "nb_entreprises"=>$sec->getnb_entreprise(),
                    "region"=>$sec->getregion(),
                    "exigence_formation"=>$sec->getexigence(),
                ]);
            }
            catch(Exception $e){
                die('error ajout'.$e->getMessage());
            } 
        }
        public function updatesecteur($sec, $id)
        {
            try {
                $db = config::getConnexion();
                $query = $db->prepare(
                    'UPDATE secteur_activite SET 
                        nom = :nom, 
                        email = :email, 
                        type = :type, 
                        nb_entreprises = :nb_entreprises,
                        region = :region,
                        exigence_formation = :exigence_formation
                    WHERE id = :id'
                );
                $query->execute([
                    'id' => $id,
                    'nom' => $sec->getnom(),
                    'email' => $sec->getemail(),
                    'type' => $sec->gettype(),
                    'nb_entreprises' => $sec->getnb_entreprise(),
                    'region' => $sec->getregion(),
                    'exigence_formation' => $sec->getexigence()
                ]);
                echo $query->rowCount() . " records UPDATED successfully <br>";
                } 
                catch (PDOException $e) {
                    echo "Erreur: " . $e->getMessage();
                }
            }
            function showsecteur($id)
            {
                $sql = "SELECT * from secteur_activite where id = $id";
                $db = config::getConnexion();
                try {
                    $query = $db->prepare($sql);
                    $query->execute();

                    $sec = $query->fetch();
                    return $sec;
                } catch (Exception $e) {
                    die('Error: ' . $e->getMessage());
                }
            }
            function afficheentreprise($idsecteur)
            {
                $sql = "SELECT * from entreprise where secteur = :id";
                $db = config::getConnexion();
                try {
                    $query = $db->prepare($sql);
                    $query->execute(['id'=>$idsecteur]);
                    $sec = $query->fetch();
                    return $sec;
                } catch (Exception $e) {
                    die('Error: ' . $e->getMessage());
                }
            }
    }
?>