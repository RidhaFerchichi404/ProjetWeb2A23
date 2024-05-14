<?php

class Commentaire
{
    private ?string $id_commentaire = null;
    private ?string $id_sujet = null;
    private ?string $id_utilisateur = null;
    private ?string $text = null;
    
    public function getIdCommentaire()
    {
        return $this->id_commentaire;
    }

    public function setIdSujet($id_sujet)
    {
        $this->id_sujet = $id_sujet;
    }

    public function getIdSujet()
    {
        return $this->id_sujet;
    }

    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    

    public function __construct($id_commentaire = null, $id_sujet = null, $id_utilisateur = null, $text = null)
    {
        $this->id_commentaire = $id_commentaire;
        $this->id_sujet = $id_sujet;
        $this->id_utilisateur = $id_utilisateur;
        $this->text = $text;
    }
}

?>
