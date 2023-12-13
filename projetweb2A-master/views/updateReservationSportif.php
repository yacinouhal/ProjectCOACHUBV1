<?php
include '../controller/ReservationCoachC.php';
include '../model/CoachSportifReservation.php';

$reservationC = new ReservationCoachC();
$idReservation = isset($_GET['idReservation']) ? $_GET['idReservation'] : null;
$oldReservation = $reservationC->showReservation($idReservation);

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
            $reservationC->updateReservation($reservation, $idReservation);
            header('Location: listReservationsSportif.php');
            exit();
        }
    }
}

$idReservation = isset($_GET['idReservation']) ? $_GET['idReservation'] : null;
$oldReservation = $reservationC->showReservation($idReservation);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la réservation pour Coach Sportif</title>
    <link rel="stylesheet" href="styles.css">
    <script src="ReservationCoach.js" defer></script>
</head>

<body>
    <div class="container">
        <button><a href="listReservationsSportif.php">Retour à la liste</a></button>
        <hr>

        <?php
        if ($idReservation && $oldReservation) {
        ?>
            <form action="" method="POST" id="form">
                <table>
                    <tr>
                        <td><label for="nom">Nom :</label></td>
                        <td class="icon-field">
                        <img src="user_img.png" alt="Coach Icon" class="field-icon" />
                            <input type="text" id="nom" name="nom" required pattern="[A-Za-z]+" value="<?php echo $oldReservation['nom'] ?>" />
                            <span id="erreurNom" class="erreur"></span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="prenom">Prénom :</label></td>
                        <td class="icon-field">
                        <img src="user_img.png" alt="Coach Icon" class="field-icon" />
                            <input type="text" id="prenom" name="prenom" required pattern="[A-Za-z]+" value="<?php echo $oldReservation['prenom'] ?>" />
                            <span id="erreurPrenom" class="erreur"></span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="email">Email :</label></td>
                        <td class="icon-field">
                        <img src="email.png" alt="Email Icon" class="field-icon" />
                            <input type="text" id="email" name="email" required value="<?php echo $oldReservation['email'] ?>" />
                            <span id="erreurEmail" class="erreur"></span>
                        </td>
                    </tr>
                    <tr>
    <td><label for="telephone">Téléphone :</label></td>
    <td class="icon-field">
    <img src="phone.png" alt="Phone Icon" class="field-icon" />
        <input type="text" id="telephone" name="tel" required value="<?php echo $oldReservation['tel'] ?>" />
        <span id="erreurTelephone" class="erreur"></span>
    </td>
</tr>
<tr>
    <td><label for="date_reservation">Date de réservation :</label></td>
    <td class="icon-field">
    <img src="date.png" alt="Date Icon" class="field-icon" />
        <input type="date" id="date_reservation" name="date_seance_sportive" required value="<?php echo $oldReservation['date_seance_sportive'] ?>" />
        <span id="erreurDateReservation" class="erreur"></span>
    </td>
</tr>
                    <tr>
                        <td>
                            <input type="submit" value="Enregistrer">
                        </td>
                        <td>
                            <input type="reset" value="Réinitialiser">
                        </td>
                    </tr>
                </table>
            </form>
        <?php
        }
        ?>
    </div>
</body>

</html>
