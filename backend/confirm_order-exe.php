<?php
/* Questa funzione fa l'update sull'ora di accettazione dell'ordine*/
session_start();
include_once "../common/funzioni.php";
include_once "../common/setup.php";

$date = $_GET["data"];
$ora_creazione = $_GET["ora"];
$time = date('H:i:s', time());
//echo "<h1>$date</h1>";
echo "<h1>$time</h1>";
$res = ConfermaOrdine($cid, $time, $ora_creazione, $date);
header("Location:../ordini.php?msg=ordineconfermato")
?>