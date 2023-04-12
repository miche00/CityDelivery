<?php
session_start();
echo "<h1>Modifica</h1>";
$tipo = $_SESSION["tipo"];
$login = $_SESSION["utente"];
include_once("../common/setup.php");
include_once("../common/funzioni.php");
if ($cid && isset($_SESSION["logged"])) {
	$utente = 0;
	//echo "<h1>Qui</h1>";
	switch ($tipo) {
		case "Cliente":
			//echo "<h1>Cliente</h1>";  
			//email, password, nome, cognome, città, indicazioni, carta
			$password = $_POST["password"];
			$nome = $_POST["nome"];
			$cognome = $_POST["cognome"];
			$carta_credito = $_POST["carta_di_credito"];
			$indicazioni_consegna = $_POST["indicazioni_consegna"];
			//Cap e Zona rimossi dalla form di registrazione, per non fare due query al database per richiedere indirizzo e cliente.
			//echo "$cid, $login, $password, $nome, $cognome, $carta_credito, $indicazioni_consegna, $citta, $via";
			$risultato = ModificaCliente($cid, $login, $password, $nome, $cognome, $carta_credito, $indicazioni_consegna);
			echo "<h1>Fatto</h1>";  
			break;
		case "Fattorino":
			echo "<h1>Fattorino</h1>";  
			$utente = 1;
			$nome = $_POST["nome"];
			$cognome = $_POST["cognome"];
			$cf = $_POST["cf"];
			$accredito = 0;
			$zona = $_POST["zona_citta"];
			$data = $_POST["data_nascita"];
			$risultato = ModificaFattorino($cid, $login, $password, $nome, $cognome, $cf, $accredito, $zona, $data);
			echo "<h1>Fatto</h1>"; 
			break;
		case "Ristorante":
			echo "<h1>Ristorante</h1>";  
			$utente = 2;
			$piva = $_POST["partita_iva"];
			$rsociale = $_POST["ragionesociale"];
			$citta = $_POST["citta"];
			$via = $_POST["via"];
			$img = "risto3.jpg"; //Da aggiungere nella form di registrazione
			$nome = "Pippo"; //Da aggiungere nella form di registrazione
			//mancante
			$risultato = ModificaRistorante($cid, $login, $password, $nome, $piva, $rsociale, $citta, $via, $img);
			echo "<h1>Fatto</h1>"; 
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