<?php
    class Event{
        private ?int $idEvent = null;
        private ?string $nomEvent = null;
        private ?string $orgEvent = null;
        private ?string $themeEvent = null;
        private ?DateTime $dateEvent = null;
        private ?string $lieuEvent = null;

        public function __construct($a = null,$b,$c,$d,$e,$f){
            $this->idEvent = $a;
            $this->nomEvent = $b;
            $this->orgEvent = $c;
            $this->themeEvent = $d;
            $this->dateEvent = $e;
            $this->lieuEvent = $f;
        }

        public function getId(){
            return $this->idEvent;
        }

        public function getNomEvent(){
            return $this->nomEvent;
        }

        public function getOrganisteur(){
            return $this->orgEvent;
        }

        public function getTheme(){
            return $this->themeEvent;
        }

        public function getDate(){
            return $this->dateEvent;
        }

        public function getLieu(){
            return $this->lieuEvent;
        }

        public function setNomEvenet($a){
            $this->nomEvent = $a;
        }

        public function setOrganisateur($b){
            $this->organisateurEvent = $b;
        }

        public function setTheme($c){
            $this->themeEvent = $c;
        }

        public function setDate($d){
            $this->dateEvent = $d;
        }

        public function setLieu($e){
            $this->lieuEvent = $e;
        }
    }
?>