<?php

class Produit
{
    private $IdProd;
    private $Description;
    private $Quantite;
    private $Prix;

    public function __construct($IdProd, $Description, $Quantite, $Prix)
    {
        $this->IdProd = $IdProd;
        $this->Description = $Description;
        $this->Quantite = $Quantite;
        $this->Prix = $Prix;
    }

    /**
     * Get the value of IdProd
     */
    public function getIdProd()
    {
        return $this->IdProd;
    }

    /**
     * Set the value of IdProd
     *
     * @return  self
     */
    public function setIdProd($IdProd)
    {
        $this->IdProd = $IdProd;
        return $this;
    }

    /**
     * Get the value of Description
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * Set the value of Description
     *
     * @return  self
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
        return $this;
    }

    /**
     * Get the value of Quantite
     */
    public function getQuantite()
    {
        return $this->Quantite;
    }

    /**
     * Set the value of Quantite
     *
     * @return  self
     */
    public function setQuantite($Quantite)
    {
        $this->Quantite = $Quantite;
        return $this;
    }

    /**
     * Get the value of Prix
     */
    public function getPrix()
    {
        return $this->Prix;
    }

    /**
     * Set the value of Prix
     *
     * @return  self
     */
    public function setPrix($Prix)
    {
        $this->Prix = $Prix;
        return $this;
    }

    // Example of a method to get the total price
    public function getTotalPrice()
    {
        return $this->Quantite * $this->Prix;
    }
}
