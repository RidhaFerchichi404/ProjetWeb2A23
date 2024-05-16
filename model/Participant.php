<?php 
    class Participant{
        private ?int $idPart = null;
        private ?string $nomPart = null;
        private ?int $agePart = null;
        private ?string $emailPart = null;
        private ?int $idEvent = null;

        public function __construct($a = null,$b,$c,$d){
            $this->idPart = $a;
            $this->nomPart = $b;
            $this->agePart = $c;
            $this->emailPart = $d;
        }

        public function getIdPart(){
            return $this->idPart;
        }

        public function getNomPart(){
            return $this->nomPart;
        }

        public function getAgePart(){
            return $this->agePart;
        } 

        public function getEmailPart(){
            return $this->emailPart;
        }


        public function setIdPart($a){
            $this->idPart = $a;
        }

        public function setNomPart($a){
            $this->nomPart = $a;
        }

        public function setAgePart($a){
            $this->agePart = $a;
        }

        public function setEmailPart($a){
            $this->emailPart = $a;
        }

    }
?>