<?php
include "../../config.php";

    class EventC{
        public function ListEvents(){
            $sql = "SELECT * FROM events";
            $db = config::getConnexion();
            //echo "connection successful !! ";
            try{
                $stmt = $db->query($sql);
                $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            $sql = "INSERT INTO events VALUES(NULL,:nomEv,:orgEv,:themeEv,:dateEv,:lieuEv,:NbPart)";
            $db = config::getConnexion();
            try{
                $req = $db->prepare($sql);
                $req->execute([
                    "nomEv"=> $ev->getNomEvent(),
                    "orgEv"=> $ev->getOrganisteur(),
                    "themeEv"=> $ev->getTheme(),
                    "dateEv"=> $ev->getDate()->format('Y/m/d'),
                    "lieuEv"=> $ev->getLieu(),
                    "NbPart"=> $ev->getNbPart()
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
                return $req->fetch(PDO::FETCH_ASSOC);
            }
            catch(Exception $e){
                die('error de retrait des données !! '. $e->getMessage());
            }
        }

        public function updateEvent($ev,$id){
            try{
                $db = config::getConnexion();
                $sql = "UPDATE events SET idEvent = :idEvent 
                    , nomEvent = :nomEvent
                    , orgEvent = :orgEvent
                    , themeEvent = :themeEvent
                    , dateEvent = :dateEvent
                    , lieuEvent = :lieuEvent 
                    , NbPart = :NbPart WHERE idEvent = :idEvent";
                $req = $db->prepare($sql);
                $req->bindValue(":idEvent", $id);
                $req->execute([
                    "idEvent"=> $ev->getId(),
                    "nomEvent"=> $ev->getNomEvent(),
                    "orgEvent"=> $ev->getOrganisteur(),
                    "themeEvent"=> $ev->getTheme(),
                    "dateEvent"=> $ev->getDate()->format('Y-m-d'),
                    "lieuEvent"=> $ev->getLieu(),
                    "NbPart"=> $ev->getNbPart()
                ]);
                echo $req->rowCount() . " records UPDATED successfully <br>";
            }
            catch(Exception $e){
                die('error de modification !! '. $e->getMessage());
            }
        }
        
        public function searchEventByName($eventName){
            $sql = "SELECT * FROM events WHERE nomEvent = :nomEvent";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":nomEvent", $eventName);
            try {
                $req->execute();
                return $req->fetchAll(PDO::FETCH_ASSOC);
            } catch(Exception $e) {
                die('Error retrieving events by name: ' . $e->getMessage());
            }
        }

        public function searchEventByOrganizer($organizerName){
            $sql = "SELECT * FROM events WHERE orgEvent = :orgEvent";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":orgEvent", $organizerName);
            try {
                $req->execute();
                return $req->fetchAll(PDO::FETCH_ASSOC);
            } catch(Exception $e) {
                die('Error retrieving events by organizer: ' . $e->getMessage());
            }
        }

        public function searchEventByParticipant($participantNme){
            $sql = "SELECT * FROM events S,participant P WHERE S.idEvent = P.idEvent AND nomPart = :nomPart";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":nomPart", $participantNme);
            try{
                $req->execute();
                return $req->fetchAll();
            }
            catch(Exception $e){
                die('error de retrait des données !! '. $e->getMessage());
            }
        }


        public function CountPlacesLeft($idEvent){
            $db = config::getConnexion();
            $sql = "SELECT NbPart - COUNT(idPart) AS placesLeft 
                    FROM events E 
                    LEFT JOIN participant P ON E.idEvent = P.idEvent 
                    WHERE E.idEvent = :idEvent 
                    GROUP BY E.idEvent";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":idEvent", $idEvent);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result['placesLeft'] : 0; 
            } catch(Exception $e) {
                die('Error counting places left: ' . $e->getMessage());
            }
        }

        public function ListEventsWithPlacesLeft(){
            $db = config::getConnexion();
            
            try {
                $sql = "SELECT E.*, 
                               E.NbPart - COUNT(P.idPart) AS placesLeft
                          FROM events E
                     LEFT JOIN participant P ON E.idEvent = P.idEvent
                      GROUP BY E.idEvent";
                
                $stmt = $db->prepare($sql);
                $stmt->execute();
                
                // Fetch all events along with the count of places left for each event
                $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                return $events;
            } catch(Exception $e) {
                die('Error retrieving events with places left: ' . $e->getMessage());
            }
        }

        public function EventWithPlacesLeft($nomEvent){
            $db = config::getConnexion();
            
            try {
                $sql = "SELECT E.*, 
                               E.NbPart - COUNT(P.idPart) AS placesLeft
                          FROM events E
                     LEFT JOIN participant P ON E.idEvent = P.idEvent
                         WHERE E.nomEvent = :nomEvent
                      GROUP BY E.idEvent";
                
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':nomEvent', $nomEvent);
                $stmt->execute();
                
                // Fetch the event along with the count of places left
                $event = $stmt->fetch(PDO::FETCH_ASSOC);
                
                return $event;
            } catch(Exception $e) {
                die('Error retrieving event by name: ' . $e->getMessage());
            }
        }
        

        public function deleteEventOnZero($idEvent){
            $db = config::getConnexion();
            try{
                $sql = "DELETE FROM events WHERE idEvent = :idEvent";
                $req = $db->prepare($sql);
                $req->bindValue(":idEvent",$idEvent);
                $req->execute();
            }
            catch(Exception $e){
                die('Error de supression de levent !!' . $e->getMessage());
            }
        }
        
        
    }


?>