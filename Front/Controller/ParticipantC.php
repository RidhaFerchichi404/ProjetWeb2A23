<?php
    include_once "../config.php";
    class ParticipantC{
        public function ListParticipants(){
            $sql = "SELECT * FROM participant";
            $db = config::getConnexion();
            //echo "connection successful !! ";
            try{
                $list = $db->query($sql);
                return $list;
            }catch(Exception $e){
                die('error de lister les Participants !!'. $e->getMessage());
            }
        }

        public function deleteParticipant($idPart){
            $sql = "DELETE FROM participant WHERE idPart = :idPart ";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":idPart", $idPart);
            try{
                $req->execute();
            }
            catch(Exception $e){
                die('error de suppression du participant !! '. $e->getMessage());
            }
        }

       /* public function addParticipant($pr,$idEvent){
            //var_dump($ev); // testing
            $sql = "INSERT INTO participant VALUES(NULL,:nomPart,:agePart,:emailPart,:idEvent)";
            $db = config::getConnexion();
            try{
                $req = $db->prepare($sql);
                $req->execute([
                    ":nomPart" => $pr->getNomPart(),
                    ":agePart" => $pr->getAgePart(),
                    ":emailPart" => $pr->getEmailPart(),
                    ":idEvent" => $idEvent
                ]);
            }
            catch(Exception $e){
                die('error d ajout du participant !! '. $e->getMessage());
            }
        }*/

        public function addParticipant($pr, $idEvent){
            try {
                $sql = "INSERT INTO participant VALUES (null,:nomPart, :agePart, :emailPart, :idEvent)";
                $db = config::getConnexion();
                $req = $db->prepare($sql);
        
                // Bind parameters
                $req->bindParam(":nomPart", $nomPart);
                $req->bindParam(":agePart", $agePart);
                $req->bindParam(":emailPart", $emailPart);
                $req->bindParam(":idEvent", $idEvent);
        
                // Set parameter values
                $nomPart = $pr->getNomPart();
                $agePart = $pr->getAgePart();
                $emailPart = $pr->getEmailPart();
        
                // Execute the query
                $req->execute();
        
                // Check if the query was successful
                if ($req->rowCount() > 0) {
                    // Participant added successfully
                    return true;
                } else {
                    // Participant not added
                    return false;
                }
            } catch (PDOException $e) {
                // Handle database errors
                echo 'Error adding participant: ' . $e->getMessage();
                return false;
            } catch (Exception $e) {
                // Handle other errors
                echo 'Error adding participant: ' . $e->getMessage();
                return false;
            }
        }
        
        

        public function getParticipantById($idPart){
            $sql = "SELECT * FROM participant WHERE idPart = :idPart";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":idPart", $idPart);
            try{
                $req->execute();
                return $req->fetch(PDO::FETCH_ASSOC);
            }
            catch(Exception $e){
                die('error de retrait des données !! '. $e->getMessage());
            }
        }
    }

    
?>