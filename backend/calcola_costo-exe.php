<?php 
session_start();
include_once "../common/funzioni.php";
include_once "../common/setup.php";
$pagamento = $_GET["pagamento"];
$data = $_GET["data"];
$ora_creazione = $_GET["ora_creazione"];
echo "<h1>$data . $ora_creazione</h1>";
UpdatePagamento($cid, $pagamento, $ora_creazione, $data);
header("Location:confirm_order-exe.php?data=$data&ora=$ora_creazione")
?>