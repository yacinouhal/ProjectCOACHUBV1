<?php
include '../../Controller/ReservationCoachC.php';
$reservationC = new ReservationCoachC();
$reservationC->deleteReservation($_GET["idReservationCoach"]);
header('Location:listReservationsCoach.php');
?>
