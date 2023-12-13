<?php
require '../config.php';

class ReservationCoachC
{
    public function listReservations()
    {
        $sql = "SELECT * FROM coach_sportif_reservation ORDER BY id_reservation_coach";
        $db = getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteReservation($id)
    {
        $sql = "DELETE FROM coach_sportif_reservation WHERE id_reservation_coach = :id";
        $db = getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addReservation($reservation)
    {
        $db = getConnexion();
    
        try {
             // Get the maximum existing ID
             $result = $db->query("SELECT MAX(idReservation) AS maxId FROM coach_sportif_reservation");
             $maxId = $result->fetch()['maxId'];
     
             // Manually reset auto-increment to the maximum existing ID plus one
             $db->exec("ALTER TABLE coach_sportif_reservation AUTO_INCREMENT = " . ($maxId + 1));
     
             
            $sql = "INSERT INTO coach_sportif_reservation (nom, prenom, email, tel, date_reservationPsy) 
                    VALUES (:nom, :prenom, :email, :tel, :date_seance_sportive)";
    
            $query = $db->prepare($sql);
            $query->execute([
                ':nom' => $reservation->getNom(),
                ':prenom' => $reservation->getPrenom(),
                ':email' => $reservation->getEmail(),
                ':tel' => $reservation->getTel(),
                ':date_seance_sportive' => $reservation->getDateSeanceSportive(),
            ]);
    
            if ($query->rowCount() > 0) {
                echo "Réservation coach ajoutée avec succès!";
            } else {
                echo "Erreur lors de l'ajout de la réservation coach.";
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

    function showReservation($id)
    {
        $sql = "SELECT * FROM coach_sportif_reservation WHERE id_reservation_coach = $id";
        $db = getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $reservation = $query->fetch();
            return $reservation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateReservation($reservation, $id)
    {
        try {
            $db = getConnexion();
            $query = $db->prepare(
                'UPDATE coach_sportif_reservation SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    tel = :tel,
                    date_seance_sportive = :date_seance_sportive
                WHERE id_reservation_coach = :id_reservation_coach'
            );

            $query->execute([
                'id_reservation_coach' => $id,
                'nom' => $reservation->getNom(),
                'prenom' => $reservation->getPrenom(),
                'email' => $reservation->getEmail(),
                'tel' => $reservation->getTel(),
                'date_seance_sportive' => $reservation->getDateSeanceSportive(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
?>
