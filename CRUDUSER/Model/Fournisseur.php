<?php

class Fournisseur
{
    private $id;
    private $nom;
    private $adresse;
    private $idProd2;

    public function __construct($id, $nom, $adresse, $idProd2)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->idProd2 = $idProd2;
    }

    public function getIdFourn()
    {
        return $this->id;
    }

    public function setIdFourn($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getnom()
    {
        return $this->nom;
    }

    public function setnom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getadresse()
    {
        return $this->adresse;
    }

    public function setadresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getIdProd2()
    {
        return $this->idProd2;
    }

    public function setIdProd2($idProd2)
    {
        $this->idProd2 = $idProd2;
        return $this;
    }
}
