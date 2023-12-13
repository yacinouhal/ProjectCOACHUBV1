<?php
include '../controller/ReservationCoachC.php';
$reservationC = new ReservationCoachC();
$reservationC->deleteReservation($_GET["idReservationCoach"]);
header('Location:listReservationsCoach.php');
?>
