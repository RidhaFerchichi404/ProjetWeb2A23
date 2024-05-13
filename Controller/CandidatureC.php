<?php
    //require_once "../config.php";
    include "../controller/JobC.php";
    include "../model/Candidature.php";

    class candidatureC {

		public function afficherCandidature($id_offre){
			$sql = "SELECT * FROM candidature WHERE id_offre = :id_offre";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute(['id_offre' => $id_offre]);
				$candidatureList = $query->fetchAll();
				return $candidatureList;
			}
			catch(Exception $e){
				die("Message error = ". $e->getMessage());
			}
		}
		

		
		
		public function supprimerCandidature($id_candidature) {
	
			// Define SQL query to delete candidature
			$sql = "DELETE FROM candidature WHERE id_candidature = :id_candidature";
	
			// Get PDO connection
			$db = config::getConnexion();
	
			try {
				// Prepare and execute the SQL query
				$req = $db->prepare($sql);
				$req->bindValue(':id_candidature', $id_candidature);
				$req->execute();
			} catch(Exception $e) {
				// Handle exceptions
				die('Erreur: ' . $e->getMessage());
			}
		}


		public function ajouterCandidature($candidature)
{
    $sql = "INSERT INTO candidature (id_candidature, cv, id_offre) 
            VALUES (:id_candidature, :cv, :id_offre)";
    
    $db = config::getConnexion();
    
    try {
        // Check if the id_offre exists in the offres_emploi table
        $offreExistQuery = $db->prepare("SELECT id FROM offres_emploi WHERE id = :id_offre");
        $offreExistQuery->execute(['id_offre' => $candidature->getid_offre()]);
        $offreExists = $offreExistQuery->fetchColumn();

        if ($offreExists) {
            // If the id_offre exists, proceed with inserting the candidature
            $query = $db->prepare($sql);
            $query->execute([
                'id_candidature' => $candidature->getIdCandidature(),
                'cv' => $candidature->getCv(),
                'id_offre' => $candidature->getIdOffre(),
            ]);
        } else {
            // If the id_offre doesn't exist, handle the error (e.g., display an error message)
            echo "Error: The specified job offer ID does not exist.";
        }
    } catch (Exception $e) {
        echo 'Erreur: ' . $e->getMessage();
    }
}

		
		
		function modifierCandidature($candidature, $id_candidature){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE candidature SET 
						cv= :cv,
					WHERE id_candidature= :id_candidature'
				);
				$query->execute([
					'cv' => $candidature->getcontenu(),
					'id_candidature' => $id_candidature
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

	}


?>