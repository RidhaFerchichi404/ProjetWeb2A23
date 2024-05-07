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

        public function addParticipant($pr, $idEvent){
            $db = config::getConnexion();
            $sql = "INSERT INTO participant (nomPart, agePart, emailPart, idEvent) VALUES (:nomPart, :agePart, :emailPart, :idEvent)";
            try {
                $req = $db->prepare($sql);
                $req->bindValue(":nomPart", $pr->getNomPart());
                $req->bindValue(":agePart", $pr->getAgePart());
                $req->bindValue(":emailPart", $pr->getEmailPart());
                $req->bindValue(":idEvent", $idEvent);
                $req->execute();
                } catch (Exception $e) {
                echo 'Error adding participant !! ' . $e->getMessage();
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