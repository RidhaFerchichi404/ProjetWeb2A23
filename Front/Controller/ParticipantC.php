<?php
    class ParticipantC{
        public function ListParticipants(){
            $sql = "SELECT * FROM participant";
            $db = config::getConnexion();
            //echo "connection successful !! ";
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