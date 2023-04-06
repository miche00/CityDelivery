<?php
$tipo = $_POST["tipo"];
$login= $_POST["email"];
$pwd = $_POST["password"];
include_once("../common/setup.php");
include_once("../common/funzioni.php");

if ($cid && !isset($_SESSION["logged"])) {
	$result= isUser($cid,$login,$pwd, $tipo);
	if ($result["status"]=="ok")	{
		$cid->close();
		session_start();
		$_SESSION["utente"]=$login;
		$_SESSION["logged"]=true;
		header("Location:../login.php?status=ok&msg=". urlencode($result["msg"]));
	}	else 	{
	$utente = 0;
	echo "<h1>Qui</h1>";
	switch ($tipo) {
		case "Cliente":
			echo "<h1>Cliente</h1>";  
			$nome = $_POST["nome"];
			$cognome = $_POST["cognome"];
			$citta = $_POST["citta"];
			$via = $_POST["via"];
			$carta_credito = $_POST["cartadicredito"];
			$cap = $_POST["cap"];
			$zona = $_POST["zona"];
			$risultato = insertCliente($cid, $login, $pwd, $nome, $cognome, $citta, $carta_credito, $via, $cap, $zona);
			echo "<h1>Fatto</h1>";  
			break;
		case "Fattorino":
			echo "<h1>Fattorino</h1>";  
			$utente = 1;
			$nome = $_POST["nome"];
			$cognome = $_POST["cognome"];
			$cf = $_POST["cf"];
			$accredito = 0;
			$data = $_POST["data"];
			$zona = $_POST["zonacitta"];
			$risultato = insertFattorino($cid, $login, $pwd, $nome, $cognome, $cf, $accredito, $zona, $data,);
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
			$risultato = insertRistorante($cid, $login, $pwd, $piva, $rsociale, $citta, $via, $img, $nome);
			echo "<h1>Fatto</h1>"; 
			break;
	}
	if ($risultato["status"]=="ko") {
		echo "<h1>Ho Trovato un errore</h1>". $risultato["msg"]; 
	} else {
		echo "<h1>Success!</h1>"; 
		header("Location:../login.php?status=ok&msg=". urlencode("Registrazione effettuata"));
	}
	}
	}	else {
				header("Location:../login.php?status=ko&msg=". urlencode("errore di connessione al db"));
		}


/*		
$login= $_POST["email"];
$pwd = $_POST["password"];
$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$citta = $_POST["citta"];
$carta_credito = $_POST["cartadicredito"]*/
?>
