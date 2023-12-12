<?php
include'config.php';

class ProduitC
{

    private $conn; // Add this property

    // Constructor to initialize the connection
    public function __construct()
    {
        $this->conn = getConnexion();
    }

    // Rest of your class methods...
    
    public function listProduits()
    {
        try {
            $query = "SELECT * FROM produits";
            $result = $this->conn->query($query);

            if ($result) {
                return $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return array();
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return array();
        }
    }

     // Nouvelle fonction pour ajouter une image à un produit
     public function ajouterImageProduit($produit) {
        if (!empty($_FILES["image"]) && isset($_POST["id_prod"]) && $_POST["id_prod"] != "") {
            $img_nom = $_FILES["image"]["name"];
            $tmp_nom = $_FILES["image"]["tmp_name"];
            $time = time();
            $nouveau_nom_img = $time . $img_nom;
            $deplacer_img = move_uploaded_file($tmp_nom, "../view/image_bdd/" . $nouveau_nom_img);

            if ($deplacer_img) {
                $id_prod = $_POST["id_prod"];
                $bdd = getConnexion();

                // Mettez à jour le produit avec le nom de l'image dans la base de données
                $this->updateImageProduit($id_prod, $nouveau_nom_img);

                // Redirection ou traitement supplémentaire
                // ...
            } else {
                echo "Erreur lors de l'upload de l'image";
            }
        } else {
            echo "Veuillez remplir tous les champs";
        }
    }

    private function updateImageProduit($id_prod, $nouveau_nom_img)
    {
        $sql = "UPDATE produits SET image = :image WHERE IdProd = :IdProd";
        try {
            $query = $this->conn->prepare($sql);
            $query->execute([
                'IdProd' => $id_prod,
                'image' => $nouveau_nom_img
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    // Nouvelle fonction pour récupérer le nom de l'image du produit par son ID
    public function getImageByIdProduit($id_prod) {
        $sql = "SELECT image FROM produits WHERE IdProd = :IdProd";
        $db = getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':IdProd', $id_prod);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['image'];
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
 // Fonction pour ajouter un produit avec une image
function addProduit($produit, $nomImage)
{
    $sql = "INSERT INTO produits (Description, Quantite, Prix, image) VALUES (:Description, :Quantite, :Prix, :image)";
    $db = getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'Description' => $produit->getDescription(),
            'Quantite' => $produit->getQuantite(),
            'Prix' => $produit->getPrix(),
            'image' => $nomImage
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


    // Fonction pour mettre à jour un produit
    function updateProduit($produit, $IdProd)
    {
        $sql = "UPDATE produits SET Description = :Description, Quantite = :Quantite, Prix = :Prix WHERE IdProd = :IdProd";
        $db = getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'IdProd' => $IdProd,
                'Description' => $produit->getDescription(),
                'Quantite' => $produit->getQuantite(),
                'Prix' => $produit->getPrix()
            ]);
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
    
            // Handle image update
            if (!empty($_FILES["NouvelleImage"]["name"])) {
                $img_nom = $_FILES["NouvelleImage"]["name"];
                $tmp_nom = $_FILES["NouvelleImage"]["tmp_name"];
                $time = time();
                $nouveau_nom_img = $time . $img_nom;
                $deplacer_img = move_uploaded_file($tmp_nom, "../view/image_bdd/" . $nouveau_nom_img);
    
                if ($deplacer_img) {
                    // Update the database with the new image filename
                    $this->updateImageProduit($IdProd, $nouveau_nom_img);
                } else {
                    echo "Erreur lors de l'upload de la nouvelle image";
                }
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    function deleteProduit($IdProd) {
        // Check if IdProd is not null and numeric
        if ($IdProd !== null && is_numeric($IdProd)) {
            $sql = "DELETE FROM produits WHERE IdProd = :IdProd";
            $db = getConnexion();
            $query = $db->prepare($sql);
            $query->bindParam(':IdProd', $IdProd);

            try {
                $query->execute();
                echo $query->rowCount() . " records deleted successfully <br>";
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo "Invalid IdProd";
        }
    }

  // Fonction pour afficher un produit
    function showProduit($IdProd)
    {
        $sql = "SELECT * FROM produits WHERE IdProd = :IdProd";
        $db = getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':IdProd', $IdProd);
            $query->execute();
            $produit = $query->fetch();
            return $produit;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    // Inside ProduitC class
public function getProduitById($productId) {
    $sql = "SELECT * FROM produits WHERE IdProd = :IdProd";
    $db = getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':IdProd', $productId);
        $query->execute();
        $produit = $query->fetch(PDO::FETCH_ASSOC);
        return $produit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

    
}
?>