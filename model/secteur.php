<?php
class Secteur{
    private ?int $id= null;
    private ?string $nom= null;
    private ?string $email= null;
    private ?string $type= null;
    private ?string $nb_entreprises= null;
    private ?string $region= null;
    private ?string $exigence_formation= null;

    public function __construct($a=null,$b,$c,$d,$e,$f,$g)
    {
        $this->id=$a;
        $this->nom=$b;
        $this->email=$c;
        $this->type=$d;
        $this->nb_entreprises=$e;
        $this->region=$f;
        $this->exigence_formation=$g;
    }
    public function getid(){
        return $this->id;
    }
    public function getnom(){
        return $this->nom;
    }
    public function getemail(){
        return $this->email;
    }
    public function gettype(){
        return $this->type;
    }
    public function getnb_entreprise(){
        return $this->nb_entreprises;
    }
    public function getregion(){
        return $this->region;
    }
    public function getexigence(){
        return $this->exigence_formation;
    }

    public function setnom($a)
    {
        $this->nom=$a;
    }
    public function settype($a)
    {
        $this->type=$a;
    }
    public function setnb_entreprise($a)
    {
        $this->nb_entreprises=$a;
    }
    public function setemail($a)
    {
        $this->email=$a;
    }
    public function setregion($a)
    {
        $this->region=$a;
    }
    public function setexigence_formation($a)
    {
        $this->exigence_formation=$a;
    }
}

?>