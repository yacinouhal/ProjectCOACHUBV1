<?php
class CoachSportifReservation
{
    private ?int $idReservationCoach = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $email = null;
    private ?string $tel = null;
    private ?string $dateSeanceSportive = null;

    public function __construct($id = null, $n, $p, $a, $t, $date)
    {
        $this->idReservationCoach = $id;
        $this->nom = $n;
        $this->prenom = $p;
        $this->email = $a;
        $this->tel = $t;
        $this->dateSeanceSportive = $date;
    }

    public function getIdReservationCoach()
    {
        return $this->idReservationCoach;
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

    public function getDateSeanceSportive()
    {
        return $this->dateSeanceSportive;
    }

    public function setDateSeanceSportive($date)
    {
        $this->dateSeanceSportive = $date;
        return $this;
    }
}
?>
