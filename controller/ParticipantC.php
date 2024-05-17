<?php
include "../../config.php";
include "../../Model/Participant.php";

class ParticipantC{
        public function ListParticipants(){
            $sql = "SELECT * FROM participant GROUP BY IdEvent";
            $db = config::getConnexion();
            try{
                $list = $db->query($sql);
                return $list;
            }catch(Exception $e){
                die('error de lister les events !!'. $e->getMessage());
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
                die('error de suppression !! '. $e->getMessage());
            }
        }

        public function addParticipant($pr,$idEvent){
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
                die('error d ajout !! '. $e->getMessage());
            }
        }

        public function updatePart($pr,$id,$idE){
            try{
                $db = config::getConnexion();
                $sql = "UPDATE participant SET idPart = :idPart 
                    , nomPart = :nomPart
                    , agePart = :agePart
                    , emailPart = :emailPart 
                    , idEvent = :idEvent WHERE idPart = :idPart";
                $req = $db->prepare($sql);
                $req->bindValue(":idPart", $id);
                $req->execute([
                    "idPart"=>$pr->getIdPart(),
                    "nomPart"=>$pr->getNomPart(),
                    "agePart"=>$pr->getAgePart(),
                    "emailPart"=>$pr->getEmailPart(),
                    "idEvent"=>$idE
                ]);
                echo $req->rowCount() . " records UPDATED successfully <br>";
            }
            catch(Exception $e){
                die('error de modification !! '. $e->getMessage());
            }
        }

        public function getParticipantsByEventId($idEvent){
            $sql = "SELECT * FROM participant WHERE idEvent = :idEvent";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":idEvent", $idEvent); 
            try{
                $req->execute();
                return $req->fetchAll(PDO::FETCH_ASSOC); 
            }
            catch(Exception $e){
                die('Error retrieving data: ' . $e->getMessage());
            }
        }

        public function getParticipantsByPartId($idPart){
            $sql = "SELECT * FROM participant WHERE idPart = :idPart";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":idPart", $idPart); 
            try{
                $req->execute();
                return $req->fetch(PDO::FETCH_ASSOC); 
            }
            catch(Exception $e){
                die('Error retrieving data: ' . $e->getMessage());
            }
        }
        
    }

    
?>