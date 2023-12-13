<?php
class User {
    private $id;
    private $nom;
    private $prenom;
    private $ddn;
    private $pays;
    private $email;
    private $mdp;
    private $cmdp;
    private $sexe;
    private $type;
    private $conn;

    public function __construct($id, $nom, $prenom, $ddn, $pays, $email, $mdp, $cmdp, $sexe, $type) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->ddn = $ddn;
        $this->pays = $pays;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->cmdp = $cmdp;
        $this->sexe = $sexe;
        $this->type = $type;
        $this->conn = getConnexion();
    }

    public function getbyid() {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$this->id]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userData;
    }

    public function getbymdp() {
        return $this->mdp;
    }

    public function getbycmdp() {
        return $this->cmdp;
    }

    public function getbytype() {
        return $this->type;
    }

    public function getbyemail() {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$this->email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userData;
    }
    

    public function addUser() {
        $photo_url = isset($this->photo_url) ? $this->photo_url : '';
    
        $query = "INSERT INTO users (nom, prenom, ddn, pays, email, mdp, cmdp, sexe, type) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($query);
    
        // Exécution de la requête
        $stmt->execute([$this->nom, $this->prenom, $this->ddn, $this->pays, $this->email, $this->mdp, $this->cmdp, $this->sexe, $this->type]);
    
        // Message de succès
        $message = "Utilisateur ajouté avec succès.";
    
        // Ajout du script JavaScript pour afficher l'alerte
        echo "<script>alert('$message'); window.location.href='Admin Dashboard.php';</script>";
    
        // Retourner le message pour une éventuelle utilisation ultérieure
        return $message;
    }
    

    public function listesUser() {
        $query = "SELECT * FROM users";
        $result = $this->conn->query($query);

        if ($result) {
            $users = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }

            return $users;
        } else {
            throw new Exception("Erreur lors de l'exécution de la requête.");
        }
    }

    public function deleteUser($id) {
        $query = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $query->execute([$id]);

        return $query->rowCount() > 0;
    }

    public function updateUser($nom, $prenom, $ddn, $pays,$email, $mdp, $cmdp, $sexe, $type) {
        try {
            $query = $this->conn->prepare("UPDATE users SET nom = ?, prenom = ?, ddn = ?, pays = ?,email = ?, mdp = ?, cmdp = ?, sexe = ?, type = ? WHERE id = ?");
            $query->execute([$nom, $prenom, $ddn, $pays, $email, $mdp, $cmdp, $sexe, $type, $this->id]);

            return $query->rowCount() > 0;
        } catch (Exception $e) {
            echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
            return false;
        }
    }};

<<<<<<< HEAD
?>
=======
    public function validateResetToken($token) {
        $query = "SELECT * FROM users WHERE reset_token = ? AND email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$token, $this->email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $user ? true : false;
    }
    
    public function updatePassword($hashedPassword, $confirmedPassword) {
        try {
            $query = $this->conn->prepare("UPDATE users SET mdp = ?, cmdp = ? WHERE email = ?");
            $query->execute([$hashedPassword, $confirmedPassword, $this->email]);
    
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            echo "Erreur lors de la mise à jour du mot de passe : " . $e->getMessage();
            return false;
        }
    }
    
    public function updateResetToken($resetToken, $expirationTime) {
        try {
            $query = $this->conn->prepare("UPDATE users SET reset_token = ?, reset_token_expires = ? WHERE email = ?");
            $query->execute([$resetToken, $expirationTime, $this->email]);
    
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            echo "Erreur lors de la mise à jour du jeton de réinitialisation : " . $e->getMessage();
            return false;
        }
    }
    
    
    public function generateResetToken() {
        // Génération du jeton
        $resetToken = bin2hex(random_bytes(32));
    
        // Mise à jour de la base de données avec le jeton généré
        $this->updateResetToken($resetToken);
    
        // Retournez le jeton généré
        return $resetToken;
    }

    public function isResetTokenValid($token) {
        try {
            // Récupérer le jeton et la date d'expiration de la base de données
            $query = $this->conn->prepare("SELECT reset_token, reset_token_expires FROM users WHERE email = ?");
            $query->execute([$this->email]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                $dbToken = $result['reset_token'];
                $expirationTime = strtotime($result['reset_token_expires']);
                $currentTime = time();
    
                echo "Reset Token (Session): $token<br>";
                echo "Reset Token (DB): $dbToken<br>";
                echo "Expiration Time (String): {$result['reset_token_expires']}<br>";
    
                echo "DB Token: $dbToken<br>";
    
                // Vérifier la validité du jeton
                if ($token === $dbToken && $currentTime <= $expirationTime) {
                    return true;
                }
                echo "Token Comparison: " . ($token === $dbToken ? 'true' : 'false') . "<br>";
                echo "Time Comparison: " . ($currentTime <= $expirationTime ? 'true' : 'false') . "<br>";
                return false;
            } else {
                echo "No result found for email: {$this->email}<br>";
                return false;
            }
        } catch (Exception $e) {
            echo "Erreur lors de la vérification du jeton de réinitialisation : " . $e->getMessage();
            return false;
        }
    }

    public function clearResetToken() {
        try {
            $query = $this->conn->prepare("UPDATE users SET reset_token = NULL, reset_token_expires = NULL WHERE email = ?");
            $query->execute([$this->email]);

            return $query->rowCount() > 0;
        } catch (Exception $e) {
            echo "Erreur lors de l'effacement du jeton de réinitialisation : " . $e->getMessage();
            return false;
        }
    }

}
?>
>>>>>>> f0c56549119f5e9f0afcf35e7fbd434d0fbe9742
