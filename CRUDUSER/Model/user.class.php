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
        return $this->email;
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
    }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';
    public function sendPasswordResetEmail($email, $token) {
        $mail = new PHPMailer(true);

        try {
            // Paramètres du serveur SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.example.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your_username';
            $mail->Password   = 'your_password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Paramètres du message
            $mail->setFrom('your_email@example.com', 'Your Name');
            $mail->addAddress($email);

            // Contenu du message
            $mail->isHTML(true);
            $mail->Subject = 'Réinitialisation du mot de passe';
            $mail->Body    = 'Pour réinitialiser votre mot de passe, cliquez sur ce lien : <a href="https://yourwebsite.com/reset-password.php?token=' . $token . '">Réinitialiser le mot de passe</a>';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
