<?php 
class train {
    private ?int $id = null;
    private string $name;
    
    private ?int $phone;
    private ?int $cv ;
    private string $upload;
    private string $lettre;
   
    
    public function __construct($name, $phone, $cv,  $upload, $lettre) {
        $this->name = $name;
        $this->phone = $phone;
        $this->cv = $cv;
        $this->upload = $upload;
        $this->lettre = $lettre;
        
       
        
    }

  
   
    public function getname() {
        return $this->name;
    }
    public function getphone() {
        return $this->phone;
    }
    public function getcv() {
        return $this->cv;
    }
    public function getupload(){
        return $this->upload;
    }
    public function getlettre() {
        return $this->lettre;
    }
   
   
    
    public function setname($name) {
        $this->name = $name;
    }
    public function setphone($phone) {
        $this->phone = $phone;
    }
    public function setcv($cv) {
        $this->cv = $cv;
    }
    public function setupload($upload) {
        $this->upload = $upload;
    }
    public function setlettre($lettre) {
        $this->lettre = ($lettre);
    }
   
   
   
}

?>