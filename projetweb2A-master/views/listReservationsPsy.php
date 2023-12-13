<?php
include "../controller/ReservationPsyC.php";


$c = new ReservationPsyC();


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
    <title>Liste des réservations</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .search-container {
            float: right;
            margin: 10px 20px;
        }

        #searchInput {
            padding: 5px;
        }

        button {
            padding: 5px;
        }

        .center-button {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="topnav">
        <a class="active" href="#home">Home</a>
        <a href="#about">About</a>
        <a href="addReservationPsy.php">Contact</a>
    </div>

    <div class="search-container">
        <form action="" method="GET">
            <input type="text" id="searchInput" name="search" placeholder="Rechercher.." value="<?= $search ?>" oninput="searchFunction()">
            <button type="submit">Rechercher</button>
        </form>
    </div>

    <div class="center-button">
        <h1>Liste des réservations</h1>
        <h2>
            <a href="addReservationPsy.php">Ajouter une réservation</a>
        </h2>
    </div>

    <div class="container">
        <table border="1" width="100%">
            <tr>
                <th>ID Réservation</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date Réservation</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>

            <?php
            foreach ($tab as $reservation) {
            ?>
                <tr>
                    <td><?= highlightSearchTerm($reservation['idReservation'], $search); ?></td>
                    <td><?= highlightSearchTerm($reservation['nom'], $search); ?></td>
                    <td><?= highlightSearchTerm($reservation['prenom'], $search); ?></td>
                    <td><?= highlightSearchTerm($reservation['email'], $search); ?></td>
                    <td><?= highlightSearchTerm($reservation['tel'], $search); ?></td>
                    <td><?= highlightSearchTerm($reservation['date_reservationPsy'], $search); ?></td>
                    <td>
                        <a href="updateReservationPsy.php?idReservation=<?php echo $reservation['idReservation']; ?>">Modifier</a>
                    </td>
                    <td align="center">
                        <a href="deleteReservationPsy.php?idReservation=<?php echo $reservation['idReservation']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php
            }

            if ($newReservation) {
            ?>
                <tr>
                    <td><?= highlightSearchTerm($newReservation['idReservation'], $search); ?></td>
                    <td><?= highlightSearchTerm($newReservation['nom'], $search); ?></td>
                    <td><?= highlightSearchTerm($newReservation['prenom'], $search); ?></td>
                    <td><?= highlightSearchTerm($newReservation['email'], $search); ?></td>
                    <td><?= highlightSearchTerm($newReservation['tel'], $search); ?></td>
                    <td><?= highlightSearchTerm($newReservation['date_reservationPsy'], $search); ?></td>
                    <td>
                        <a href="updateReservationPsy.php?idReservation=<?php echo $newReservation['idReservation']; ?>">Modifier</a>
                    </td>
                    <td align="center">
                        <a href="deleteReservationPsy.php?idReservation=<?php echo $newReservation['idReservation']; ?>">Supprimer</a>
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
