<?php
    include "../config.php";
    class JobC{
        public function ListJob(){
            $sql = "SELECT * FROM offres_emploi";
            $db = config::getConnexion();
            try{
                $List = $db->query($sql);
                return $List;
            }
            catch(Exception $e){
                die("Message error = ". $e->getMessage());
            }
        }




        public function updateJob($job,$id){

            try {
                $db = config::getConnexion();
                $query = $db->prepare(
                    'UPDATE offres_emploi SET 
                    job_title = :job_title, 
                    company_name = :company_name, 
                    company_description = :company_description, 
                    company_website = :company_website
                    job_description = :job_description
                    job_requirements = :job_requirements
                    salary = :salary
                    location = :location
                WHERE id= :id'
                );
                $query->execute([
                    'id' => $job->getId(),
                'job_title' => $job->getJobTitle(),
                'company_name' => $job->getCompanyName(),
                'company_description' => $job->getCompanyDescription(),
                'company_website' => $job->getCompanyWebsite(),
                'job_description' => $job->getJobDescription(),
                'job_requirements' => $job->getJobRequirements(),
                'salary' => $job->getSalary(),
                'location' => $job->getLocation()
                ]);
                echo $query->rowCount() . " records UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        
        }
         
        
  
        public function deleteJob($id){
            $sql = "DELETE FROM offres_emploi where id = :id ";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":id", $id);
            try{
                $req->execute();
            }
            catch(Exception $e){
                die("Message error = ". $e->getMessage());
            }
        }
        public function addJob($job)
        {
            $sql = "INSERT INTO offres_emploi (job_title, company_name, company_description, company_website, job_description, job_requirements, salary, location) 
                    VALUES ( :job_title, :company_name, :company_description, :company_website, :job_description, :job_requirements, :salary, :location)";
            
            $db = config::getConnexion();
            
            try {
                $req = $db->prepare($sql);
                $req->execute([
                   # "id" => $job->getId(),
                    "job_title" => $job->getJobTitle(),
                    "company_name" => $job->getCompanyName(),
                    "company_description" => $job->getCompanyDescription(),
                    "company_website" => $job->getCompanyWebsite(),
                    "job_description" => $job->getJobDescription(),
                    "job_requirements" => $job->getJobRequirements(),
                    "salary" => $job->getSalary(),
                    "location" => $job->getLocation()
                ]);
            } catch(Exception $e) {
                die('Erreur lors de l\'ajout : ' . $e->getMessage());
            }
        }
       public function showJob($id)
    {
        $sql = "SELECT * from offres_emploi where id = :id ";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $job = $query->fetch();
            return $job;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
    
?>