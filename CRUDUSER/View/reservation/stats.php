<?php
include "../controller/ReservationPsyC.php";
$c = new ReservationPsyC();

// Function to calculate monthly statistics
function calculateMonthlyStats($reservations)
{
    $monthlyStats = [];

    foreach ($reservations as $reservation) {
        $date = new DateTime($reservation['date_reservationPsy']);
        $monthYear = $date->format('M Y');

        if (!isset($monthlyStats[$monthYear])) {
            $monthlyStats[$monthYear] = 1;
        } else {
            $monthlyStats[$monthYear]++;
        }
    }

    return $monthlyStats;
}

// Get the list of reservations
$tab = $c->listReservations();

// Calculate statistics using the function
$monthlyStats = calculateMonthlyStats($tab);

// Encode data as JSON to be used in JavaScript
$monthlyStatsJson = json_encode($monthlyStats);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Statistiques par mois</title>
    <h1>Statistiques par mois</h1>
</head>

<body>
    <div class="container chart-container">
        <canvas id="reservationChart" width="400" height="200"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('reservationChart').getContext('2d');

        var chartData = {
            labels: <?= json_encode(array_keys($monthlyStats)) ?>,
            datasets: [{
                label: 'Nombre de Réservations',
                data: <?= json_encode(array_values($monthlyStats)) ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        var myChart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
