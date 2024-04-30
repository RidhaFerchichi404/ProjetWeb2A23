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




        public function updateJob($job, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE offres_emploi SET 
                job_title = :job_title, 
                company_name = :company_name, 
                company_description = :company_description, 
                company_website = :company_website,
                job_description = :job_description,
                job_requirements = :job_requirements,
                salary = :salary,
                location = :location
                WHERE id= :id'
            );
            $query->execute([
                'id' => $id,
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
            echo "Error: " . $e->getMessage(); // Print error message
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
    // Inside JobC class
public function getJobById($id) {
    try {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT * FROM offres_emploi WHERE id = :id');
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



public function countJobs() {
    try {
        $db = config::getConnexion();
        $query = $db->query("SELECT COUNT(*) AS total_jobs FROM offres_emploi");
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total_jobs'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Method to fetch jobs for the current page
public function paginateJobs($offset, $limit) {
    try {
        $db = config::getConnexion();
        $query = $db->prepare("SELECT * FROM offres_emploi LIMIT :limit OFFSET :offset");
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
}
?>