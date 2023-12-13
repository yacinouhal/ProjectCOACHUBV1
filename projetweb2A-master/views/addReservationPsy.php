<?php
include '../controller/ReservationPsyC.php';
include '../model/PsychiatreReservation.php';

$reservationC = new ReservationPsyC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["nom"]) &&
        isset($_POST["prenom"]) &&
        isset($_POST["email"]) &&
        isset($_POST["tel"]) &&
        isset($_POST["date_reservationPsy"])
    ) {
        if (
            !empty($_POST['nom']) &&
            !empty($_POST["prenom"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["tel"]) &&
            !empty($_POST["date_reservationPsy"])
        ) {
            $reservation = new PsychiatreReservation(
                null,
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['tel'],
                $_POST['date_reservationPsy']
            );
            $reservationC->addReservation($reservation);
            header('Location: listReservationsPsy.php');
            exit();
        }
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Psychiatre Reservation</title>
    <link rel="stylesheet" href="styles.css">
    <script src="ReservationPsychiatre.js" defer></script>
    
</head>

<body>
    <button><a href="listReservationsPsy.php">Back to list</a></button>
    <hr>

    <form action="" method="POST" onsubmit="return validerDateReservation();" id="form">
        <table>
            <tr>
                <td><label for="nom">Nom :</label></td>
                <td class="icon-field">
                <img src="user_img.png" alt="Patient Icon" class="field-icon" />
                    <input type="text" id="nom" name="nom" required pattern="[A-Za-z]+" />
                    <span id="erreurNom" class="error-message"></span>
                </td>
            </tr>
            <tr>
                <td><label for="prenom">Prénom :</label></td>
                <td class="icon-field">
                 <img src="user_img.png" alt="Patient Icon" class="field-icon" />
                <input type="text" id="prenom" name="prenom" required pattern="[A-Za-z]+" />
                    <span id="erreurPrenom"></span>
                </td>
            </tr>
            <tr>
             <td><label for="email">Email :</label></td>
              <td class="icon-field">
                <img src="email.png" alt="Email Icon" class="field-icon" />
               <input type="text" id="email" name="email" required />
                <span id="erreurEmail"></span>
            </td>
          </tr>
            <tr>
                <td><label for="telephone">Téléphone :</label></td>
                  <td class="icon-field">
                     <img src="phone.png" alt="Phone Icon" class="field-icon" />
                  <input type="text" id="telephone" name="tel" required />
                    <span id="erreurTelephone"></span>
               </td>
           </tr>
           <tr>
    <td><label for="date_reservationPsy">Date Reservation :</label></td>
    <td class="icon-field">
        <img src="date.png" alt="Date Icon" class="field-icon" />
        <input type="date" id="date_reservationPsy" name="date_reservationPsy" required />
        <span id="erreurDateReservationPsy"></span>
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
