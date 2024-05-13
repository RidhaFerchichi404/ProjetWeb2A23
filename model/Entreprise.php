<?php
class Entreprise{
    private ?int $id= null;
    private ?string $nom= null;
    private ?string $email= null;
    private ?string $doc= null;
    private ?string $location= null;
    private ?int $secteur= null;

    public function __construct($a=null,$b,$c,$d,$e,$f)
    {
        $this->id=$a;
        $this->nom=$b;
        $this->email=$c;
        $this->doc=$d;
        $this->location=$e;
        $this->secteur=$f;
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
    public function getdoc(){
        return $this->doc;
    }
    public function getlocation(){
        return $this->location;
    }
    public function getsecteur(){
        return $this->secteur;
    }

    public function setnom($a)
    {
        $this->nom=$a;
    }
    public function setdoc($a)
    {
        $this->doc=$a;
    }
    public function setlocation($a)
    {
        $this->location=$a;
    }
    public function setemail($a)
    {
        $this->email=$a;
    }
    public function setsecteur($a)
    {
        $this->secteur=$a;
    }
}

?>