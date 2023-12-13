<?php
class PsychiatreReservation
{
    private ?int $idReservation = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $email = null;
    private ?string $tel = null;
    private ?string $date_reservationPsy = null;

    public function __construct($id = null, $n, $p, $a, $t, $date)
    {
        $this->idReservation = $id;
        $this->nom = $n;
        $this->prenom = $p;
        $this->email = $a;
        $this->tel = $t;
        $this->date_reservationPsy = $date;
    }

    public function getIdReservation()
    {
        return $this->idReservation;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
        return $this;
    }


    public function getDateReservationPsy()
    {
        return $this->date_reservationPsy;
    }

    public function setDateReservationPsy($date)
    {
        $this->date_reservationPsy = $date;
        return $this;
    }
}
?>
