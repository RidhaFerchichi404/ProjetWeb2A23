<?php

require '../config.php';

class sujetC
{

    public function getSujet($id)
    {
        $sql = "SELECT * FROM sujet WHERE id_sujet = $id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            $voyage = $query->fetch();
            return $voyage;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listsujet()
    {
        $sql = "SELECT * FROM sujet";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletesujet($ide)
    {
        $sql = "DELETE FROM sujet WHERE id_sujet = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addsujet($sujet)
    {
        $sql = "INSERT INTO sujet VALUES (NULL, :idu, :titre, :contenue, :date)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idu' => $sujet->getid_utilisateur(),
                'titre' => $sujet->gettitre(),
                'contenue' => $sujet->getcontenu(),
                'date' => $sujet->getDateCreation(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showsujet($id)
    {
        $sql = "SELECT * from sujet where id_sujet = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $sujet = $query->fetch();
            return $sujet;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatesujet($sujet, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare("UPDATE sujet SET id_utilisateur = :id_utilisateur, titre = :titre, contenue = :contenue, date_creation = :date_creation WHERE id_sujet = :id");
            $query->execute([
                'id' => $id, 
                'id_utilisateur' => $sujet->getid_utilisateur(),
                'titre' => $sujet->gettitre(),
                'contenue' => $sujet->getcontenu(),
                'date_creation' => $sujet->getDateCreation()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
            echo($e);
        }
    }
}
