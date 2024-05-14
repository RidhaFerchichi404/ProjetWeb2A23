<?php

require '../config.php';

class CommentaireC
{

    public function getCommentaire($id)
    {
        $sql = "SELECT * FROM commentaire WHERE id_commentaire = :id";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
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
        $sql = "INSERT INTO commentaire (id_sujet, id_utilisateur, text) VALUES (:id_sujet, :id_utilisateur, :text)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_sujet' => $commentaire->getIdSujet(),
                'id_utilisateur' => $commentaire->getIdUtilisateur(),
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
            $query->execute(['id' => $id]);
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
