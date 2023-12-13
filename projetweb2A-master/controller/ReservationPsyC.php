<?php
require '../config.php';


class ReservationPsyC
{
    public function listReservations()
    {
        $sql = "SELECT * FROM psychiatre_reservation";
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
        $sql = "DELETE FROM psychiatre_reservation WHERE idReservation = :id";
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
         $result = $db->query("SELECT MAX(idReservation) AS maxId FROM psychiatre_reservation");
         $maxId = $result->fetch()['maxId'];
 
         // Manually reset auto-increment to the maximum existing ID plus one
         $db->exec("ALTER TABLE psychiatre_reservation AUTO_INCREMENT = " . ($maxId + 1));
 
         
        $sql = "INSERT INTO psychiatre_reservation (nom, prenom, email, tel, date_reservationPsy) 
                VALUES (:nom, :prenom, :email, :tel, :date_reservationPsy)";

        $query = $db->prepare($sql);
        $query->execute([
            ':nom' => $reservation->getNom(),
            ':prenom' => $reservation->getPrenom(),
            ':email' => $reservation->getEmail(),
            ':tel' => $reservation->getTel(),
            ':date_reservationPsy' => $reservation->getDateReservationPsy(),
        ]);

        if ($query->rowCount() > 0) {
            echo "Réservation Psychiatre ajoutée avec succès!";
        } else {
            echo "Erreur lors de l'ajout de la réservation Psychiatre.";
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



    function showReservation($id)
    {
        $sql = "SELECT * FROM psychiatre_reservation WHERE idReservation = $id";
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
                'UPDATE psychiatre_reservation SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    tel = :tel,
                    date_reservationPsy = :date_reservationPsy
                WHERE idReservation= :idReservation'
            );

            $query->execute([
                'idReservation' => $id,
                'nom' => $reservation->getNom(),
                'prenom' => $reservation->getPrenom(),
                'email' => $reservation->getEmail(),
                'tel' => $reservation->getTel(),
                'date_reservationPsy' => $reservation->getDateReservationPsy(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
?>
