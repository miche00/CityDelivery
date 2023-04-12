<?php
session_start();
echo "<h1>Modifica</h1>";
$tipo = $_SESSION["tipo"];
$login = $_SESSION["utente"];
include_once("../common/setup.php");
include_once("../common/funzioni.php");
if ($cid && isset($_SESSION["logged"])) {
	$utente = 0;
	echo "<h1>Qui</h1>";
	switch ($tipo) {
		case "Cliente":
			$email=$_POST["email"];
			$password = $_POST["password"];
			$nome = $_POST["nome"];
			$cognome = $_POST["cognome"];
			$carta_credito = $_POST["cartadicredito"];
			$indicazioni_consegna = $_POST["indicazioni"];
			$citta=$_POST["citta"];
			$via=$_POST["via"];
			$cap=$_POST["cap"]; 
			$zona=$_POST["zona"];
			$risultato = modificaCliente($cid, $login, $password, $nome, $cognome, $carta_credito, $indicazioni_consegna, $citta, $via, $cap, $zona);
			break;
		case "Fattorino":
			echo "<h1>Fattorino</h1>";  
			//$email=$_POST["email"];
			$password = $_POST["password"];
			$nome = $_POST["nome"];
			$cognome = $_POST["cognome"];
			//$cf = $_POST["cf"];
			$accredito = ["accredito"];
			$zona = $_POST["zona"];
			//$data = $_POST["data"];
			$risultato = ModificaFattorino($cid, $login, $password, $nome, $cognome, $zona);
			echo "<h1>Fatto</h1>"; 
			break;
		case "Ristorante":
			echo "<h1>Ristorante</h1>";  
			$email=$_POST["email"];
			$password=$_POST["password"];
			$piva = $_POST["piva"];
			$rsociale = $_POST["rsociale"];
			$citta = $_POST["citta"];
			$via = $_POST["via"];
			//$img = "risto3.jpg"; //Da aggiungere nella form di registrazione
			$nome = $_POST["nome"]; //Da aggiungere nella form di registrazione
			$cap=$_POST["cap"]; 
			$zona=$_POST["zona"];
			//mancante
			$risultato = ModificaRistorante($cid, $login, $password, $nome, $piva, $rsociale, $citta, $via, $img, $cap, $zona);
			break;
	}
	if ($risultato["status"] == "ok") {
		header("Location: ../profilo.php?status=ok&msg=". urlencode($risultato["msg"]));
	} else {
		header("Location: ../profilo.php?status=ko&msg=". urlencode($risultato["msg"]));
	}
}




/*
if ($cid)
{
	if ($result["status"]=="ok")
	{
	   $cid->close();
	  session_start();
	  $_SESSION["utente"]=$login;
	  $_SESSION["logged"]=true;
	  $_SESSION["tipo"] = $tipo;
	  header("Location:../profilo.php?status=ok&msg=". urlencode($result["msg"]));
	}
	else
	{
	  header("Location:../profilo.php?status=ko&msg=" . urlencode($result["msg"]));
	}
}
else
	header("Location:../profilo.php?status=ko&msg=". urlencode("errore di connessione al db"));
*/
?>