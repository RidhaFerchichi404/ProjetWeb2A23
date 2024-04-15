<?php
include "../config.php";

    class EventC{
        public function ListEvents(){
            $sql = "SELECT * FROM events";
            $db = config::getConnexion();
            //echo "connection successful !! ";
            try{
                $list = $db->query($sql);
                return $list;
            }catch(Exception $e){
                die('error de lister les events !!'. $e->getMessage());
            }
        }

        public function deleteEvent($idEvent){
            $sql = "DELETE FROM events WHERE idEvent = :idEvent ";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":idEvent", $idEvent);
            try{
                $req->execute();
            }
            catch(Exception $e){
                die('error de suppression !! '. $e->getMessage());
            }
        }

        public function addEvent($ev){
            //var_dump($ev); // testing
            $sql = "INSERT INTO events VALUES(NULL,:nomEv,:orgEv,:themeEv,:dateEv,:lieuEv)";
            $db = config::getConnexion();
            try{
                $req = $db->prepare($sql);
                $req->execute([
                    "nomEv"=> $ev->getNomEvent(),
                    "orgEv"=> $ev->getOrganisteur(),
                    "themeEv"=> $ev->getTheme(),
                    "dateEv"=> $ev->getDate()->format('Y/m/d'),
                    "lieuEv"=> $ev->getLieu()
                ]);
            }
            catch(Exception $e){
                die('error d ajout !! '. $e->getMessage());
            }
        }

        public function getEventById($idEvent){
            $sql = "SELECT * FROM events WHERE idEvent = :idEvent";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":idEvent", $idEvent);
            try{
                $req->execute();
                // Fetch the event data
                return $req->fetch(PDO::FETCH_ASSOC);
            }
            catch(Exception $e){
                die('error de retrait des données !! '. $e->getMessage());
            }
        }

        public function updateEvent($ev){
            $sql = "UPDATE events SET nomEvent = :nomEvent
                    , orgEvent = :orgEvent
                    , themeEvent = :themeEvent
                    , dateEvent = :dateEvent
                    , lieuEvent = :lieuEvent WHERE idEvent = :idEvent";
            $db = config::getConnexion();
            try{
                $req = $db->prepare($sql);
                $req->bindValue(":idEvent", $ev->idEvent);
                $req->execute([
                    "nomEvent"=> $ev->getNomEvent(),
                    "orgEvent"=> $ev->getOrganisteur(),
                    "themeEvent"=> $ev->getTheme(),
                    "dateEvent"=> $ev->getDate()->format('Y-m-d'),
                    "lieuEvent"=> $ev->getLieu()
                ]);
            }
            catch(Exception $e){
                die('error de modification !! '. $e->getMessage());
            }
        }
        
        
    }
?>