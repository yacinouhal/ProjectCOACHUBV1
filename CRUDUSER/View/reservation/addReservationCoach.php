<?php
include '../../Controller/ReservationCoachC.php';
include '../../Model/CoachSportifReservation.php';

$reservationC = new ReservationCoachC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["nom"]) &&
        isset($_POST["prenom"]) &&
        isset($_POST["email"]) &&
        isset($_POST["tel"]) &&
        isset($_POST["date_seance_sportive"])
    ) {
        if (
            !empty($_POST['nom']) &&
            !empty($_POST["prenom"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["tel"]) &&
            !empty($_POST["date_seance_sportive"])
        ) {
            $reservation = new CoachSportifReservation(
                null,
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['tel'],
                $_POST['date_seance_sportive']
            );
            $reservationC->addReservation($reservation);
            header('Location: listReservationsSportif.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une réservation pour Coach Sportif</title>
    <link rel="stylesheet" href="styles.css">
    <script src="ReservationCoach.js" defer></script>
</head>

<body>
    <button><a href="listReservationsSportif.php">Retour à la liste</a></button>
    <hr>

    <form action="" method="POST" id="form">
        <table>
            <tr>
                <td><label for="nom">Nom :</label></td>
                <td class="icon-field">
                    <img src="user_img.png" alt="Coach Icon" class="field-icon" />
                    <input type="text" id="nom" name="nom" required pattern="[A-Za-z]+" />
                    <span id="erreurNom" class="erreur"></span>
                </td>
            </tr>
            <tr>
                <td><label for="prenom">Prénom :</label></td>
                <td class="icon-field">
                    <img src="user_img.png" alt="Coach Icon" class="field-icon" />
                    <input type="text" id="prenom" name="prenom" required pattern="[A-Za-z]+" />
                    <span id="erreurPrenom" class="erreur"></span>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email :</label></td>
                <td class="icon-field">
                    <img src="email.png" alt="Email Icon" class="field-icon" />
                    <input type="text" id="email" name="email" required />
                    <span id="erreurEmail" class="erreur"></span>
                </td>
            </tr>
            <tr>
                <td><label for="tel">Téléphone :</label></td>
                <td class="icon-field">
                    <img src="phone.png" alt="Phone Icon" class="field-icon" />
                    <input type="text" id="tel" name="tel" required />
                    <span id="erreurTelephone" class="erreur"></span>
                </td>
            </tr>
            <tr>
                <td><label for="date_seance_sportive">Date Séance Sportive :</label></td>
                <td class="icon-field">
                    <img src="date.png" alt="Date Icon" class="field-icon" />
                    <input type="date" id="date_seance_sportive" name="date_seance_sportive" required />
                    <span id="erreurDateSeanceSportive" class="erreur"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Enregistrer" id="submitBtn">
                </td>
                <td>
                    <input type="reset" value="Supprimer">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>

