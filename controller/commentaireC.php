<?php

require '../../config.php';

class CommentaireC
{
    public function getCommentsBySubject($subject_id) {
        $sql = "SELECT * FROM commentaire WHERE id_sujet = :subject_id";
        $db = Config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":subject_id", $subject_id);
            $stmt->execute();
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function getCommentaire($id)
    {
        $sql = "SELECT * FROM commentaire WHERE id_commentaire = :id";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            $commentaire = $query->fetch();
            return $commentaire;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listCommentaires()
    {
        $sql = "SELECT * FROM commentaire";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteCommentaire($id)
    {
        $sql = "DELETE FROM commentaire WHERE id_commentaire = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addCommentaire($commentaire)
    {
        
        $sql = "INSERT INTO commentaire (id_commentaire,id_sujet,id_utilisateur,text) VALUES (NULL,:id_sujet,:id_utilisateur,:text)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_sujet' => $commentaire->getid_Sujet(),
                'id_utilisateur' => $commentaire->getid_Utilisateur(),
                'text' => $commentaire->getText()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showCommentaire($id)
    {
        $sql = "SELECT * FROM commentaire WHERE id_commentaire = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $commentaire = $query->fetch();
            return $commentaire;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateCommentaire($commentaire, $id)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare("UPDATE commentaire SET id_sujet = :id_sujet, id_utilisateur = :id_utilisateur, text = :text WHERE id_commentaire = :id");
            $query->execute([
                'id' => $id,
                'id_sujet' => $commentaire->getIdSujet(),
                'id_utilisateur' => $commentaire->getIdUtilisateur(),
                'text' => $commentaire->getText()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

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
