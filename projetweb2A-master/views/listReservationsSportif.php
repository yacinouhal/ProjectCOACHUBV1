<?php
include "../controller/ReservationCoachC.php";

$c = new ReservationCoachC();
$tab = $c->listReservations();

$newReservation = null;

$lastAddedReservationId = isset($_GET['lastAddedReservationId']) ? $_GET['lastAddedReservationId'] : null;

if ($lastAddedReservationId) {
    $newReservation = $c->showReservation($lastAddedReservationId);
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Liste des réservations pour Coach Sportif</title>
</head>

<body>


    <div class="search-container">
        <form action="" method="GET">
            <input type="text" id="searchInput" name="search" placeholder="Rechercher.." value="<?= $search ?>" oninput="searchFunction()">
            <button type="submit">Rechercher</button>
        </form>
    </div>
    <center>
        <h1>Liste des réservations pour Coach Sportif</h1>
        <link rel="stylesheet" href="styles.css">
        <h2>
            <a href="addReservationCoach.php">Ajouter une réservation</a>
        </h2>
    </center>
    <div class="container">
        <table border="1" align="center" width="70%">
            <tr>
                <th>ID Réservation</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date Séance Sportive</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>

            <?php
            foreach ($tab as $reservation) {
            ?>
                <tr>
                    <td><?= $reservation['id_reservation_coach']; ?></td>
                    <td><?= $reservation['nom']; ?></td>
                    <td><?= $reservation['prenom']; ?></td>
                    <td><?= $reservation['email']; ?></td>
                    <td><?= $reservation['tel']; ?></td>
                    <td><?= $reservation['date_seance_sportive']; ?></td>
                    <td>
                        <a href="updateReservationSportif.php?idReservation=<?php echo $reservation['id_reservation_coach']; ?>">Modifier</a>
                    </td>
                    <td align="center">
                        <a href="deleteReservationSportif.php?idReservation=<?php echo $reservation['id_reservation_coach']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php
            }

            if ($newReservation) {
            ?>
                <tr>
                    <td><?= $newReservation['id_reservation_coach']; ?></td>
                    <td><?= $newReservation['nom']; ?></td>
                    <td><?= $newReservation['prenom']; ?></td>
                    <td><?= $newReservation['email']; ?></td>
                    <td><?= $newReservation['tel']; ?></td>
                    <td><?= $newReservation['date_seance_sportive']; ?></td>
                    <td>
                        <a href="updateReservationSportif.php?idReservation=<?php echo $newReservation['id_reservation_coach']; ?>">Modifier</a>
                    </td>
                    <td align="center">
                        <a href="deleteReservationSportif.php?idReservation=<?php echo $newReservation['id_reservation_coach']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <?php
    function highlightSearchTerm($text, $searchTerm)
    {
        if (!empty($searchTerm)) {
            $highlightedText = preg_replace("/($searchTerm)/i", '<span style="background-color: yellow;">$1</span>', $text);
            return $highlightedText;
        }
        return $text;
    }
    ?>

    <div class="container chart-container">
        <a href="stats.php" class="btn-chart">Voir les statistiques</a>
    </div>
</body>

</html>
