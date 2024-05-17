<?php
class sujet
{
    private ?string $id_sujet = null;
    private ?string $id_utilisateur= null ;
    private ?string $titre = null;
    private ?string $contenu = null;
    private ?string $date_creation = null;
    

    public function getid_sujet() {
        return $this->id_sujet;
    }

    public function setid_utilisateur($idu) {
        $this->id_utilisateur = $idu;
    }
    
    public function getid_utilisateur() {
        return $this->id_utilisateur;
    }

    public function settitre($t) {
        $this->titre = $t;
    }

    public function gettitre() {
        return $this->titre;
    }

    public function setcontenu($c) {
        $this->contenu = $c;
    }

    public function getcontenu() {
        return $this->contenu;
    }

    public function setdate_creation($d) {
        $this->date_creation = $d;
    }

    public function getDateCreation() {
        return $this->date_creation;
    }
    

    public function __construct($id_sujet = null, $idu, $t, $c, $d) {
        $this->id_sujet = $id_sujet;
        $this->id_utilisateur = $idu;
        $this->titre = $t;
        $this->contenu = $c;
        $this->date_creation = $d;
        
    }

   


}
