<?php
include '../../Controller/FournisseurF.php';

$fournisseurF = new FournisseurF(); 
$fournisseurF->deleteFournisseur($_GET["id"]); // appel de methode
header('Location: listFourn.php');
?>
