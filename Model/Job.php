<?php
    class Job{
        private ?int $id = null;
        private ?string $job_title = null; 
        private ?string $company_name = null;  
        private ?string $company_description = null;
        private ?string $company_website = null; 
        private ?string $job_description = null;  
        private ?string $job_requirements = null;
        private ?float $salary = null; 
        private ?string $location = null;  


        public function __construct($a = null,$b,$c,$d,$e,$f,$g,$h,$i) {
            $this->id = $a;
            $this->job_title = $b;
            $this->company_name = $c;
            $this->company_description = $d;
            $this->company_website = $e;
            $this->job_description = $f;
            $this->job_requirements = $g;
            $this->salary = $h;
            $this->location = $i;
        }

        // Getter method for id
    public function getId(): ?int {
        return $this->id;
    }

    // Setter method for id
    public function setId(?int $id): void {
        $this->id = $id;
    }

    // Getter method for job_title
    public function getJobTitle(): ?string {
        return $this->job_title;
    }

    // Setter method for job_title
    public function setJobTitle(?string $job_title): void {
        $this->job_title = $job_title;
    }

    // Getter method for company_name
    public function getCompanyName(): ?string {
        return $this->company_name;
    }

    // Setter method for company_name
    public function setCompanyName(?string $company_name): void {
        $this->company_name = $company_name;
    }

    // Getter method for company_description
    public function getCompanyDescription(): ?string {
        return $this->company_description;
    }

    // Setter method for company_description
    public function setCompanyDescription(?string $company_description): void {
        $this->company_description = $company_description;
    }

    // Getter method for company_website
    public function getCompanyWebsite(): ?string {
        return $this->company_website;
    }

    // Setter method for company_website
    public function setCompanyWebsite(?string $company_website): void {
        $this->company_website = $company_website;
    }

    // Getter method for job_description
    public function getJobDescription(): ?string {
        return $this->job_description;
    }

    // Setter method for job_description
    public function setJobDescription(?string $job_description): void {
        $this->job_description = $job_description;
    }

    // Getter method for job_requirements
    public function getJobRequirements(): ?string {
        return $this->job_requirements;
    }

    // Setter method for job_requirements
    public function setJobRequirements(?string $job_requirements): void {
        $this->job_requirements = $job_requirements;
    }

    // Getter method for salary
    public function getSalary(): ?float {
        return $this->salary;
    }

    // Setter method for salary
    public function setSalary(?float $salary): void {
        $this->salary = $salary;
    }

    // Getter method for location
    public function getLocation(): ?string {
        return $this->location;
    }

    // Setter method for location
    public function setLocation(?string $location): void {
        $this->location = $location;
    }

        
    }
?>