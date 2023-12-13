<?php
<<<<<<< HEAD
function getConnexion() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "coachhu";
=======
// config.php
>>>>>>> f0c56549119f5e9f0afcf35e7fbd434d0fbe9742

if (!function_exists('getConnexion')) {
    function getConnexion() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "user";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Configurer PDO pour signaler les erreurs
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("La connexion à la base de données a échoué : " . $e->getMessage());
        }
    }
}

?>
