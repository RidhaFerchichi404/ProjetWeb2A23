<?php
class Candidature{
    private ?int $id_candidature = null;
    private ?string $cv = null; 
    private ?int $id_offre = null;  

    public function __construct($id_candidature = null, $cv = null, $id_offre = null) {
        $this->id_candidature = $id_candidature;
        $this->cv = $cv;
        $this->id_offre = $id_offre;
        
    }

    // Getter method for id_candidature
    public function getIdCandidature(): ?int {
        return $this->id_candidature;
    }

    // Setter method for id_candidature
    public function setIdCandidature(?int $id_candidature): void {
        $this->id_candidature = $id_candidature;
    }

    // Getter method for cv
    public function getCv(): ?string {
        return $this->cv;
    }

    // Setter method for cv
    public function setCv(?string $cv): void {
        $this->cv = $cv;
    }

    // Getter method for id_offre
    public function getIdOffre(): ?int {
        return $this->id_offre;
    }

    // Setter method for id_offre
    public function setIdOffre(?int $id_offre): void {
        $this->id_offre = $id_offre;
    }

    
}
?>
