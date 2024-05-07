<?php 
class train {
    private ?int $id_training = null;
    private string $name;
    private DateTime $date;
    private string $adress;
    private ?int $price = null;
    private string $time;
    private string $description;
    private string $photo;
    
    public function __construct($name, $date, $adress,  $price, $time, $description, $photo) {
        $this->name = $name;
        $this->date = $date;
        $this->adress = $adress;
        $this->price = $price;
        $this->time = $time;
        
        $this->description = $description;
        $this->photo = $photo;
        
    }

  
    public function getid_training() {
        return $this->id_training;
    }
    public function getname() {
        return $this->name;
    }
    public function getdate(): DateTime {
        return $this->date;
    }
    public function getadress() {
        return $this->adress;
    }
    public function getprice() {
        return $this->price;
    }
    public function gettime() {
        return $this->time;
    }
    public function getdescription(){
        return $this->description;
    }
    public function getphoto() {
        return $this->photo;
    }
   
   
    
    public function setname($name) {
        $this->name = $name;
    }
    public function setdate($date) {
        $this->date = new DateTime ($date);
    }
    public function setadress($adress) {
        $this->adress = $adress;
    }
    public function setprice($price) {
        $this->price = $price;
    }
    public function settime($time) {
        $this->time = ($time);
    }
   
    public function setdescription($description) {
        $this->description = $description;
    }
    public function setphoto($photo) {
        $this->photo = $photo;
    }
   
   
}

?>