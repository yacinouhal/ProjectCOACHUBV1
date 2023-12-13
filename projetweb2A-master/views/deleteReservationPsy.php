<?php
include '../controller/ReservationPsyC.php';
$reservationC = new ReservationPsyC();
$reservationC->deleteReservation($_GET["idReservation"]);
header('Location:listReservationsPsy.php');
?>
