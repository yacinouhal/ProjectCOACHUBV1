<?php

include '../config.php';
include '../Fournisseur.php';

class FournisseurF
{
    // Fonction pour ajouter un produit
    function addFournisseur($fournisseur)
    {
        $sql = "INSERT INTO fournisseurs (id, nom, adresse, idProd2) VALUES (:id, :nom, :adresse, :idProd2)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $fournisseur->getIdFourn(),
                'nom' => $fournisseur->getnom(),
                'adresse' => $fournisseur->getadresse(),
                'idProd2' => $fournisseur->getIdProd2()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateFournisseur($fournisseur, $id)
    {
        $sql = "UPDATE fournisseurs SET nom = :nom, adresse = :adresse, idProd2 = :idProd2 WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'nom' => $fournisseur->getnom(),
                'adresse' => $fournisseur->getadresse(),
                'idProd2' => $fournisseur->getIdProd2()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteFournisseur($id)
    {
        $sql = "DELETE FROM fournisseurs WHERE id = :id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id);

        try {
            $query->execute();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Fonction pour récupérer la liste des fournisseurs
    function listFournisseurs()
    {
        $sql = "SELECT * FROM fournisseurs";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $fournisseur = $query->fetchAll(PDO::FETCH_ASSOC);
            return $fournisseur;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Fonction pour afficher un fournisseur
    function showFournisseur($id)
    {
        $sql = "SELECT * FROM fournisseurs WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $fournisseur = $query->fetch();
            return $fournisseur;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
