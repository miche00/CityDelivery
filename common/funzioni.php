<?php

include "setup.php";

function isUser($cid,$login,$pwd, $tipo)
{
	$risultato= array("msg"=>"","status"=>"ok");

   /* inserire controlli dell'input */
   switch ($tipo) {
    case "Cliente":
        $sql = "SELECT * FROM cliente where email = '$login' and password = '$pwd'";
        break;
    case "Fattorino":
        $sql = "SELECT * FROM fattorino where email = '$login' and password = '$pwd'";
        break;
    case "Ristorante":
        $sql = "SELECT * FROM ristorante where email = '$login' and password = '$pwd'";
        break;
	}

   
   $res = $cid->query($sql);
   	if ($res==null) 
	{
	        $msg = "Si sono verificati i seguenti errori:<br/>" 
     		. $res->error;
			$risultato["status"]="ko";
			$risultato["msg"]=$msg;			
	}elseif($res->num_rows==0 || $res->num_rows>1)
	{
			$msg = "Login o password sbagliate";
			$risultato["status"]="ko";
			$risultato["msg"]=$msg;		
	}elseif($res->num_rows==1)
	{
	    $msg = "Login effettuato con successo";
		$risultato["status"]="ok";
		$risultato["msg"]=$msg;		
	}
    return $risultato;
}

/*Legge tutti i ristoranti nel db*/
function leggiRistoranti($cid)
{
 $ristoranti = array();
 $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
 
 /*controllo la connessione*/
 if ($cid->connect_errno) {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
  return $risultato;
 }
 /*creo la mia interrogazione*/
 $sql= "SELECT * FROM ristorante;";
 $res=$cid->query($sql);
 if ($res==null)
 {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
  return $risultato;
 }
 while($row=$res->fetch_row())
 {
	array_push($ristoranti, $row);	
 }
 $risultato["status"]="ok";
 $risultato["msg"]="Query Effettuata con Successo";
 $risultato["contenuto"]=$ristoranti;
 return $risultato;
}

/*legge un ristorante specifico*/
function leggiRistorante($cid)
{
	$dati = array();
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	
	/*controllo la connessione*/
	if ($cid->connect_errno) {
	 $risultato["status"]="ko";
	 $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
	 return $risultato;
	}
	/*creo la mia interrogazione*/
	$campo1 = $_SESSION["utente"];
	$sql= "SELECT * FROM ristorante WHERE email='$campo1';";
	$res=$cid->query($sql);
	if ($res==null)
	{
	 $risultato["status"]="ko";
	 $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
	 return $risultato;
	}
	$row=$res->fetch_row();
	//print_r($row);
	for ($i=0; $i<sizeof($row); $i++) {
	    $dati[$i]=$row[$i];
	}
	//print_r($dati);
	$risultato["status"]="ok";
	$risultato["msg"]="Query Effettuata con Successo";
	$risultato["contenuto"]=$dati;
	//print_r($risultato);
	return $risultato;
    }


function stampaRistoranti($ristoranti) {
	echo  "<div class=\"section bg-light\">
	<div class=\"container mb-3\"><div class=\"row\">";
	foreach ($ristoranti AS $key => $ar_risto)
 	{
			$email = $ar_risto[0];
			$nomeR = $ar_risto[2];
			$citta = $ar_risto[5];
			$via = $ar_risto[6];
			$img = $ar_risto[7];
			//echo "<h1>". $nome. "</h1>";echo "<h1>". $citta. "</h1>";echo "<h1>". $via. "</h1>";
			echo "<div class=\"col-sm-6\" data-aos=\"fade-up\">
			<div class=\"cadrd mb-3\">
			<img src=\"images/". $img ."\" class=\"card-img-top\">
			  <div class=\"card-body\">
				<h5 class=\"card-title\">". $nomeR ."</h5>
				<p class=\"card-text\">". $citta .", via ". $via. "</p>
				<a href=\"piattimenu.php?emailR=$email&nomeR=$nomeR\" class=\"btn btn-primary\"\">Piatti e Menù</a>
			  </div>
			</div>
		  </div>";			
	}	
	echo "</div>";
}

/*function MostraRistoranti() {
    echo "<div>";
        $risultato = leggiRistoranti($cid);
        //print_r($ristoranti);
        $ristoranti = $risultato["contenuto"];
        //print_r($ristoranti);
        stampaRistoranti($ristoranti);
    echo "</div>";
}*/


/* funzioni relative alla visulizzazione dei PIATTI*/
function leggiPiatto($cid, $emailR)
{
 $piatti = array();
 $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
 
 /*controllo la connessione*/
 if ($cid->connect_errno) {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
  return $risultato;
 }
 /*creo la mia interrogazione*/
 //SELECT * FROM pietanza WHERE tipo = 'piatto' AND emailR = (SELECT EmailR FROM ristorante WHERE nome= 'EverGreen');
 $sql= "SELECT * FROM pietanza WHERE tipo = 'piatto' AND emailR = (SELECT email FROM ristorante WHERE email='$emailR');"; //qui in emailR devo passare una variabile 
 $res=$cid->query($sql);
 if ($res==null)
 {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
  return $risultato;
 }
 while($row=$res->fetch_row())
 {
	array_push($piatti, $row);	
 }
 $risultato["status"]="ok";
 $risultato["msg"]="Query Effettuata con Successo";
 $risultato["contenuto"]=$piatti;
 return $risultato;
}

function leggiMenu($cid, $emailR)
{
 $menu = array();
 $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
 
 /*controllo la connessione*/
 if ($cid->connect_errno) {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
  return $risultato;
 }
 /*creo la mia interrogazione*/
 $sql= "SELECT * FROM pietanza WHERE tipo = 'menu' AND emailR = (SELECT email FROM ristorante WHERE email='$emailR');"; //qui in emailR devo passare una variabile 
 $res=$cid->query($sql);
 if ($res==null)
 {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
  return $risultato;
 }
 while($row=$res->fetch_row())
 {
	array_push($menu, $row);	
 }
 $risultato["status"]="ok";
 $risultato["msg"]="Query Effettuata con Successo";
 $risultato["contenuto"]=$menu;
 return $risultato;
}

function stampaMenu($menu, $emailR, $nomeR) {
	//echo  "<div class=\"section bg-light\">
	//<div class=\"container mb-3\"><div class=\"row\">";
	foreach ($menu as $key =>$ar_piatti)
 	{
			$nome = $ar_piatti[1];
			$descrizione = $ar_piatti[2];
			$costo = $ar_piatti[3];
			$img = $ar_piatti[4];
			
			echo "
			<div class=\"property-item\">
			<!--piatto 1-->
			<img src= $img alt=\"Image\" class=\"img-fluid\" />             
			<div class=\"property-content\">
			  <div class=\"price mb-2\"><span> &euro; $costo</span></div>
			    <div>
				 <span class=\"d-block mb-2 text-black-50\"
				   >$descrizione</span
				 >
				 <span class=\"city d-block mb-3\">$nome</span>
		   
				 <a
				   href=\"backend/aggiungi_ordine-exe.php?emailR=$emailR&nome=$nome&nomeR=$nomeR\"
				   class=\"btn btn-primary py-2 px-3\"
				 >Aggiungi all'ordine</a
							>
			    </div>
			  </div>
			</div>
				";
				}
}


function stampaPiatto($piatti, $emailR, $nomeR) {
	foreach ($piatti as $key =>$ar_piatti)
 	{
			$nome = $ar_piatti[1];
			$descrizione = $ar_piatti[2];
			$costo = $ar_piatti[3];
			$img = $ar_piatti[4];
			echo "
	
			<div class=\"property-item\">
				<img src=\"$img\" alt=\"Image\" class=\"img-fluid\" />
									
				<div class=\"property-content\">
					  <div class=\"price mb-2\"><span> &euro; $costo</span></div>
						  <div>
							<span class=\"d-block mb-2 text-black-50\"
								>$descrizione</span
								>
							<span class=\"city d-block mb-3\">$nome</span>
		
							<a
								href=\"backend/aggiungi_ordine-exe.php?emailR=$emailR&nome=$nome&nomeR=$nomeR\"
								class=\"btn btn-primary py-2 px-3\"
								>Aggiungi all'ordine</a
							>
						  </div>
					</div>
				</div>
			";
			}
}

function AddOrder($cid, $time, $date, $login, $emailR, $nomepm) {
	$risultato = array("status"=>"ok","msg"=>"");
	$msg="";
	if ($cid->connect_errno) {
		$risultato["status"]="ko";
		$risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		return $risultato;
	   }
	//check se esiste un ordine fatto dallo stesso cliente verso lo stesso ristorante
	$sqlcheck = "SELECT * from ordine WHERE emailR = '$emailR' and emailC = '$login'";
	echo "<h1>$sqlcheck</h1>";
	$rescheck=$cid->query($sqlcheck);
	if ($rescheck->num_rows > 0) {
			// Significa che esiste un altro ordine per lo stesso cliente verso quel ristorante, dunque il pm viene aggiunto all'ordine preesistente.
		   echo "<h1>L'ordine esiste già</h1>";
		   $risultato["msg"]="Sto per aggiungere il pm all'ordine preesistente!";
		   $risultato["status"]="ko";
		   foreach ($rescheck AS $key => $ar_ordini) {
			$tempoordine = $ar_ordini["ora_creazione"];
			$dataordine = $ar_ordini["data"];
		   }
			$risultato = AddInOrder($cid, $tempoordine, $dataordine, $nomepm, $emailR);
		   return $risultato;
	}
	echo "<h1>L'ordine non esiste già, viene creato</h1>";	
	$sql1="INSERT INTO ordine VALUES('$time', '$date', NULL, NULL, NULL, NULL, NULL, NULL, '$emailR', NULL, '$login')";
	$res=$cid->query($sql1);
	echo $sql1;
	if ($res==1) {
		echo "Primo If AddOrder 1";
		$risultato["msg"]="L'operazione di inserimento si è conclusa con successo";
		$risultato["status"]="ok";
	} else
	{
		echo "Secondo If Addorder 2";
	   $risultato["status"]="ko";
	   $risultato["msg"]="L'operazione di inserimento è fallita";
	   $risultato["op"]="";
	   return $risultato;
	}
	echo "<h1>Il piatto viene aggiunto all'ordine appena creato.</h1>";	
	$risultato["op"] = AddInOrder($cid, $time, $date, $nomepm, $emailR);
	return $risultato;
}

function AddInOrder($cid, $time, $date, $nomepm, $emailR) {
	$risultato = array("status"=>"ok","msg"=>"");
	
	$sqlcheck = "SELECT qta from contiene WHERE nome = '$nomepm' AND emailR = '$emailR' AND data = '$date' AND ora_creazione = '$time'";
	$rescheck=$cid->query($sqlcheck);
	echo "<h1>" . $sqlcheck . "</h1>";
	print_r($rescheck);
	if ($rescheck->num_rows > 0) {
		foreach ($rescheck AS $key => $ar_contiene) {
			$qta = $ar_contiene["qta"];
		}
		$qta = $qta+1;
		echo "<h1>UPDATE</h1>";
		$sql = "UPDATE `contiene` SET `qta` = '$qta' WHERE `contiene`.`nome` = '$nomepm' AND `contiene`.`emailR` = 'davittorio@hotmail.it' AND `contiene`.`ora_creazione` = '$time' AND `contiene`.`data` = '$date';";
		$res=$cid->query($sql);
		echo "<h1>" . $sql . "</h1>";
		if ($res==1) {
			echo "Primo If";
			$risultato["msg"]="L'operazione di inserimento si è conclusa con successo";
			$risultato["status"]="ok";
			return $risultato;
		} else
		{
			echo "Secondo If";
		   $risultato["status"]="ko";
		   $risultato["msg"]="L'operazione di inserimento è fallita o duplicata";
		   return $risultato;
		}
		echo "No If";
		$risultato["status"]="ko";
		$risultato["msg"]=$msg;
		return $risultato;
	}

	$msg="";
	$sql = "INSERT INTO contiene VALUES('$nomepm', '$emailR', '$time', '$date', '1')";
	$res=$cid->query($sql);
	echo "<h1>$sql</h1>";
	if ($res==1) {
		echo "Primo If";
		$risultato["msg"]="L'operazione di inserimento si è conclusa con successo";
		$risultato["status"]="ok";
		return $risultato;
	} else
	{
		echo "Secondo If";
	   $risultato["status"]="ko";
	   $risultato["msg"]="L'operazione di inserimento è fallita o duplicata";
	   return $risultato;
	}
	echo "No If";
	$risultato["status"]="ko";
	$risultato["msg"]=$msg;
	return $risultato;
}
/*Legge tutti i clienti nel db*/
function leggiClienti($cid)
{
 $clienti = array();
 $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
 
 /*controllo la connessione*/
 if ($cid->connect_errno) {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
  return $risultato;
 }
 /*creo la mia interrogazione*/
 $sql= "SELECT * FROM cliente;";
 $res=$cid->query($sql);
 if ($res==null)
 {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
  return $risultato;
 }
 while($row=$res->fetch_row())
 {
	array_push($clienti, $row);	
 }
 $risultato["status"]="ok";
 $risultato["msg"]="Query Effettuata con Successo";
 $risultato["contenuto"]=$clienti;
 return $risultato;
}


/*inserisci CLIENTE*/
/*inserisci CLIENTE*/
function insertCliente($cid, $login, $pwd, $nome, $cognome, $citta, $carta_credito, $via, $cap, $zona)
{ 
 $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
 
 $msg="";
 $res=leggiClienti($cid);
 
 if ($res["status"]=='ko')
 { 
  echo "<h1>Errore nella lettura dei clienti</h1>";
  $msg .= "Problemi nella lettura dal database<br/>";
 }
 else 
 { 
  $clienti=$res["contenuto"];
  print_r( $res["contenuto"]);
  if (isset($clienti[$login]))
  {
   echo "Email già usata";
   $msg .= "La email $login specifica &egrave; gi&agrave; usata per $clienti[$login]<br/>";
  }
 }
 $sqlindirizzo = "INSERT INTO indirizzo VALUES('$citta', '$via', '$cap', '$zona');";
 $res_ind = $cid->query($sqlindirizzo);
 if ($res_ind==1) {
  echo "ind:Primo If";
  $risultato["msg"]="L'operazione di inserimento si è conclusa con successo";
  $risultato["status"]="ok";
 } else
 {
  echo "ind:Secondo If";
    $risultato["status"]="ko";
    $risultato["msg"]="L'operazione di inserimento è fallita";
 }
 echo "<h1>Inserimento Cliente</h1>";
 $sql= "INSERT INTO cliente VALUES('$login', '$pwd', '$nome', '$cognome', '$carta_credito', 'nessuna', '$citta', '$via');";
 $res=$cid->query($sql);
 echo "<h1>Qua</h1>". $res;
 if ($res==1) {
  echo "Primo If";
  $risultato["msg"]="L'operazione di inserimento si è conclusa con successo";
  $risultato["status"]="ok";
  return $risultato;
 } else
 {
  echo "Secondo If";
    $risultato["status"]="ko";
    $risultato["msg"]="L'operazione di inserimento è fallita";
 }
 echo "No If";
 $risultato["status"]="ko";
 $risultato["msg"]=$msg;
 return $risultato;
}

/*registrazione RISTORANTE*/
function insertRistorante($cid, $login, $pwd, $nome, $piva, $rsociale, $citta, $via, $img)
{	
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	
	$msg="";
	$res=leggiRistoranti($cid);
	
	if ($res["status"]=='ko')
	{	
		echo "<h1>Errore nella lettura dei clienti</h1>";
		$msg .= "Problemi nella lettura dal database<br/>";
	}
	else 
	{	
		$ristoranti=$res["contenuto"];
		print_r( $res["contenuto"]);
		if (isset($ristoranti[$login]))
		{
			echo "Email già usata";
			$msg .= "La email $login specifica &egrave; gi&agrave; usata per $ristoranti[$login]<br/>";
		}
	}
	$sqlindirizzo = "INSERT INTO indirizzo VALUES('$citta', '$via', '$cap', '$zona', '0');";
	$res_ind = $cid->query($sqlindirizzo);
	if ($res_ind==1) {
		echo "ind:Primo If";
		$risultato["msg"]="L'operazione di inserimento si è conclusa con successo";
		$risultato["status"]="ok";
	} else
	{
		echo "ind:Secondo If";
	   $risultato["status"]="ko";
	   $risultato["msg"]="L'operazione di inserimento è fallita";
	}
	echo "<h1>Inserimento Cliente</h1>";
	$sql= "INSERT INTO ristorante VALUES('$login', '$pwd', '$nome', '$piva', '$rsociale', '$citta', '$via', '$img');";
	$res=$cid->query($sql);
	echo "<h1>Qua</h1>". $res;
	if ($res==1) {
		echo "Primo If";
		$risultato["msg"]="L'operazione di inserimento si è conclusa con successo";
		$risultato["status"]="ok";
		return $risultato;
	} else
	{
		echo "Secondo If";
	   $risultato["status"]="ko";
	   $risultato["msg"]="L'operazione di inserimento è fallita";
	}
	echo "No If";
	$risultato["status"]="ko";
	$risultato["msg"]=$msg;
	return $risultato;
}

/*registrazione FATTORINO*/
function insertFattorino($cid, $login, $pwd, $nome, $cognome, $cf, $accredito, $zona, $data)
{	
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	
	$msg="";
	$res=leggiFattorino($cid);
	
	if ($res["status"]=='ko')
	{	
		echo "<h1>Errore nella lettura dei clienti</h1>";
		$msg .= "Problemi nella lettura dal database<br/>";
	}
	else 
	{	
		$fattorini=$res["contenuto"];
		print_r( $res["contenuto"]);
		if (isset($fattorini[$login]))
		{
			echo "Email già usata";
			$msg .= "La email $login specifica &egrave; gi&agrave; usata per $fattorini[$login]<br/>";
		}
	}

	$sql= "INSERT INTO fattorino VALUES('$login', '$pwd', '$nome', '$cognome', '$cf', '$accredito', '$zona', '$data');";
	$res=$cid->query($sql);
	echo "<h1>Qua</h1>". $res;
	if ($res==1) {
		echo "Primo If";
		$risultato["msg"]="L'operazione di inserimento si è conclusa con successo";
		$risultato["status"]="ok";
		return $risultato;
	} else
	{
		echo "Secondo If";
	   $risultato["status"]="ko";
	   $risultato["msg"]="L'operazione di inserimento è fallita";
	}
	echo "No If";
	$risultato["status"]="ko";
	$risultato["msg"]=$msg;
	return $risultato;
}

/*legge i dati dell'utente*/
function leggiDati($cid)
{
 $dati = array();
 $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
 
 /*controllo la connessione*/
 if ($cid->connect_errno) {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
  return $risultato;
 }
 /*creo la mia interrogazione*/
 $campo1 = $_SESSION["utente"];
 $sql= "SELECT * FROM cliente WHERE email='$campo1';";
 $res=$cid->query($sql);
 if ($res==null)
 {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
  return $risultato;
 }
 $row=$res->fetch_row();
 //print_r($row);
 for ($i=0; $i<sizeof($row); $i++) {
	$dati[$i]=$row[$i];
 }
 //print_r($dati);
 $risultato["status"]="ok";
 $risultato["msg"]="Query Effettuata con Successo";
 $risultato["contenuto"]=$dati;
 //print_r($risultato);
 return $risultato;
}

/*VECCHIA Stampo i dati dei diversi utenti*/
/*function stampaDati($dati, $tipo) {
	switch ($tipo) {
		case "Cliente":
			$email = $dati[0];
			$password = $dati[1];
			$nome = $dati[2];
			$cognome = $dati[3];
			$carta_credito = $dati[4];
			$indicazioni_consegna = $dati[5];
			$citta = $dati[6];
			$via = $dati[7];
			//echo $via;
			//echo $tipo;
			//echo "<h1 class=\"bg-light\">". $email. $password. $nome. "</h1>";
			echo "<div class=\"section mx-auto border\" style=\"max-width: 540px;\"";
			echo "<div class=\"card\">
					<img src=\"images/profile.png\" class=\"card-img-top\">
					<div id =\"profilo\" class=\"card-body\">
						<h5 class=\"card-title text-center\">". $nome. " ". $cognome. "</h5>
						<p class=\"card-text text-center\">Via ". $via. " ". $citta. "</p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Password: ". $password . " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Indicazioni Consegna: ". $indicazioni_consegna. " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Carta di credito: ". $carta_credito. " </small></p>
						<p class=\"card-text text-center\"><small id=\"tipo\" class=\"text-muted\">$tipo</small></p>
						<div class=\"row\">
						<input type=\"submit\" value=\"Modifica\" class=\"btn btn-primary col-12 mb-3\" onclick=loadModificaDati()>
						<input type=\"submit\" value=\"Cancella\" class=\"btn btn-danger col-12 mb-3\"
						</div>
					</div>
				</div>";
			echo "</div>";
			break; 
		case "Fattorino":
			$email = $dati[0];
			$password = $dati[1];
			$nome = $dati[2];
			$cognome = $dati[3];
			$cf = $dati[4];
			$accredito = $dati[5];
			$zona_citta = $dati[6];
			$data_nascita = $dati[7];
			//echo $via;
			//echo $tipo;
			//echo "<h1 class=\"bg-light\">". $email. $password. $nome. "</h1>";
			echo "<div class=\"section mx-auto border\" style=\"max-width: 540px;\"";
			echo "<div class=\"card\">
					<img src=\"images/profile.png\" class=\"card-img-top\">
					<div id =\"profilo\" class=\"card-body\">
						<h5 class=\"card-title text-center\">". $nome. " ". $cognome. "</h5>
						<p class=\"card-text text-center\">Data di Nascita: ". $data_nascita. " </p>
						<p class=\"card-text text-center\">CF: ". $cf. "</p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Password: ". $password . " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Zona: ". $zona_citta. " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Accredito: ". $accredito. " </small></p>
						<p class=\"card-text text-center\"><small id=\"tipo\" class=\"text-muted\">$tipo</small></p>
						<div class=\"row\">
						<input type=\"submit\" value=\"Modifica\" class=\"btn btn-primary col-12 mb-3\" onclick=loadModificaDati()>
						<input type=\"submit\" value=\"Cancella\" class=\"btn btn-danger col-12 mb-3\"
						</div>
					</div>
				</div>";
			echo "</div>";
			break;
		case "Ristorante":
			$email = $dati[0];
			$password = $dati[1];
			$nome = $dati[2];
			$piva = $dati[3];
			$rsociale = $dati[4];
			$citta = $dati[5];
			$via = $dati[6];
			//$img = $dati[7];
			//echo $via;
			//echo $tipo;
			//echo "<h1 class=\"bg-light\">". $email. $password. $nome. "</h1>";
//PRENDERE IMG DEL PROFILO
			echo "<div class=\"section mx-auto border\" style=\"max-width: 540px;\"";
			echo "<div class=\"card\">
					<img src=\"images/profile.png\" class=\"card-img-top\">
					<div id =\"profilo\" class=\"card-body\">
						<h5 class=\"card-title text-center\">". $nome. "</h5>
						<p class=\"card-text text-center\"> ". $via. " ". $citta. "</p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Password: ". $password . " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Partita Iva: ". $piva. " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Ragione Sociale: ". $rsociale. " </small></p>
						<p class=\"card-text text-center\"><small id=\"tipo\" class=\"text-muted\">$tipo</small></p>
						<div class=\"row\">
						<input type=\"submit\" value=\"Modifica\" class=\"btn btn-primary col-12 mb-3\" onclick=loadModificaDati()>
						<input type=\"submit\" value=\"Cancella\" class=\"btn btn-danger col-12 mb-3\"
						</div>
					</div>
				</div>";
			echo "</div>";
			break;
	}
}

function MostraDati($cid, $tipo) {
	switch ($tipo) {
		case "Cliente":
			echo "<div>";
				$risultato = leggiDati($cid,$tipo);
				$dati = $risultato["contenuto"];
				//print_r($dati);
				stampaDati($dati, $tipo);
			echo "</div>";
				return $risultato;
				break;
		case "Fattorino":
			echo "<div>";
				$risultato = leggiFattorino($cid);
				$dati = $risultato["contenuto"];
				//print_r($dati);
				stampaDati($dati, $tipo);
			echo "</div>";
				return $risultato;
				break;
		case "Ristorante":
			echo "<div>";
				$risultato = leggiRistorante($cid);
				$dati = $risultato["contenuto"];
				//print_r($dati);
				stampaDati($dati, $tipo);
		echo "</div>";
			return $risultato;	
			break;
	}
}

FINE VECCHIA
*/


/*Stampo i dati dei diversi utenti*/
function stampaDati($dati, $tipo, $indirizzo) {

	switch ($tipo) {
		case "Cliente":
			$email = $dati[0];
			$password = $dati[1];
			$nome = $dati[2];
			$cognome = $dati[3];
			$carta_credito = $dati[4];
			$indicazioni_consegna = $dati[5];
			$citta = $dati[6];
			$via = $dati[7];
			$zona = $indirizzo[1];
			$cap = $indirizzo[0]; 

			echo "<div class=\"section mx-auto border\" style=\"max-width: 540px;\"";
			echo "<div class=\"card\">
					<img src=\"images/profile.png\" class=\"card-img-top\">
					<div id =\"profilo\" class=\"card-body\">
						<h5 class=\"card-title text-center\">". $nome. " ". $cognome. "</h5>
						<p class=\"card-text text-center\">Via ". $via. " ". $citta. "</p>
						<p class=\"card-text text-center\">Zona: ". $zona. "</p> 
						<p class=\"card-text text-center\">Cap: ". $cap. "</p> 
						<p class=\"card-text text-center\"><small class=\"text-muted\">Password: ". $password . " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Indicazioni Consegna: ". $indicazioni_consegna. " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Carta di credito: ". $carta_credito. " </small></p>
						<p class=\"card-text text-center\"><small id=\"tipo\" class=\"text-muted\">$tipo</small></p>
						<div class=\"row\">
						<a class=\"btn btn-primary\" href=\"modificaCliente.php?email=$email&nome=$nome&cognome=$cognome&carta=$carta_credito&indicazioni=$indicazioni_consegna&citta=$citta&via=$via&password=$password&zona=$zona&cap=$cap\">Modifica</a>
						<p></p>
						<a class=\"btn  btn-danger\" href=\"backend\cancellaProfilo-exe.php\">Cancella</a>
						</div>
					</div>
				</div>";
			echo "</div>";
			break; 
		case "Fattorino":
			$email = $dati[0];
			$password = $dati[1];
			$nome = $dati[2];
			$cognome = $dati[3];
			$cf = $dati[4];
			$accredito = $dati[5];
			$zona_citta = $dati[6];
			$data_nascita = $dati[7];
			//echo $via;
			//echo $tipo;
			//echo "<h1 class=\"bg-light\">". $email. $password. $nome. "</h1>";
			echo "<div class=\"section mx-auto border\" style=\"max-width: 540px;\"";
			echo "<div class=\"card\">
					<img src=\"images/profile.png\" class=\"card-img-top\">
					<div id =\"profilo\" class=\"card-body\">
						<h5 class=\"card-title text-center\">". $nome. " ". $cognome. "</h5>
						<p class=\"card-text text-center\">Data di Nascita: ". $data_nascita. " </p>
						<p class=\"card-text text-center\">CF: ". $cf. "</p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Password: ". $password . " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Zona: ". $zona_citta. " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Accredito: ". $accredito. " </small></p>
						<p class=\"card-text text-center\"><small id=\"tipo\" class=\"text-muted\">$tipo</small></p>
						<div class=\"row\">
						<a class=\"btn btn-primary\" href=\"#\">Modifica</a>
						<p></p>
						<a class=\"btn btn-danger\" href=\"backend\cancellaProfilo-exe.php\">Cancella</a>
						</div>
					</div>
				</div>";
			echo "</div>";
			break;
		case "Ristorante":
			$email = $dati[0];
			$password = $dati[1];
			$nome = $dati[2];
			$piva = $dati[3];
			$rsociale = $dati[4];
			$citta = $dati[5];
			$via = $dati[6];
			//$img = $dati[7];
			//echo $via;
			//echo $tipo;
			//echo "<h1 class=\"bg-light\">". $email. $password. $nome. "</h1>";
			//PRENDERE IMG DEL PROFILO
			echo "<div class=\"section mx-auto border\" style=\"max-width: 540px;\"";
			echo "<div class=\"card\">
					<img src=\"images/profile.png\" class=\"card-img-top\">
					<div id =\"profilo\" class=\"card-body\">
						<h5 class=\"card-title text-center\">". $nome. "</h5>
						<p class=\"card-text text-center\"> ". $via. " ". $citta. "</p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Password: ". $password . " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Partita Iva: ". $piva. " </small></p>
						<p class=\"card-text text-center\"><small class=\"text-muted\">Ragione Sociale: ". $rsociale. " </small></p>
						<p class=\"card-text text-center\"><small id=\"tipo\" class=\"text-muted\">$tipo</small></p>
						<div class=\"row\">
						<a class=\"btn btn-primary\" href=\"#\">Modifica</a>
						<p></p>
						<a class=\"btn  btn-danger\" href=\"backend\cancellaProfilo-exe.php\">Cancella</a>
						</div>
					</div>
				</div>";
			echo "</div>";
			break;
	}
}



/*restituisce cap e zona di un indirizzo specifico dell'utente*/
function leggiIndirizzo($cid)
{
 $indirizzi = array();
 $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
 
 /*controllo la connessione*/
 if ($cid->connect_errno) {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
  return $risultato;
 }
 /*creo la mia interrogazione*/
 $login = $_SESSION["utente"];
 //FUNZIONA CON CLIENTE VANNO FATTI FATTORINO E RISTORANTE
 $sql= "SELECT cap, zona FROM `indirizzo` JOIN cliente WHERE cliente.citta = indirizzo.citta AND cliente.via = indirizzo.via AND cliente.email='$login';";
 $res=$cid->query($sql);
 if ($res==null)
 {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
  return $risultato;
 }
 while($row=$res->fetch_row())
 {
	array_push($indirizzi, $row);	
 }
 $risultato["status"]="ok";
 $risultato["msg"]="Query Effettuata con Successo";
 $risultato["contenuto"]=$indirizzi;
 //print_r($risultato);
 return $risultato;
}



/*VA COMPLETATA PER FATT*/
function MostraDati($cid, $tipo) {
	switch ($tipo) {
		case "Cliente":
			echo "<div>";
				$risultato = leggiDati($cid,$tipo);
				$dati = $risultato["contenuto"];
				$risultato2 = leggiIndirizzo($cid);
				$indirizzi = $risultato2["contenuto"];
				$indirizzo = $indirizzi[0];
				//print_r($indirizzi);
				stampaDati($dati, $tipo, $indirizzo);
			echo "</div>";
				return $risultato;
				break;
		case "Fattorino":
			echo "<div>";
				$risultato = leggiFattorino($cid);
				$dati = $risultato["contenuto"];
				//print_r($dati);
				stampaDati($dati, $tipo);
			echo "</div>";
				return $risultato;
				break;
		case "Ristorante":
			echo "<div>";
				$risultato = leggiRistorante($cid);
				$dati = $risultato["contenuto"];
				//print_r($dati);
				stampaDati($dati, $tipo);
		echo "</div>";
			return $risultato;	
			break;
	}
}

/*Modifica dati cliente*/
function ModificaCliente($cid, $login, $password, $nome, $cognome, $carta_credito, $indicazioni_consegna) 
{	
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	
	$msg="";
	$res=leggiClienti($cid);
	
	if ($res["status"]=='ko')
	{	
		echo "<h1>Errore nella lettura dei clienti</h1>";
		$msg .= "Problemi nella lettura dal database<br/>";
	}
	/*$sqlindirizzo = "INSERT INTO indirizzo VALUES('$citta', '$via', '$cap', '$zona', '0');";
	$res_ind = $cid->query($sqlindirizzo);
	if ($res_ind==1) {
		echo "ind:Primo If";
		$risultato["msg"]="L'operazione di inserimento si è conclusa con successo";
		$risultato["status"]="ok";
	} else
	{
		echo "ind:Secondo If";
	   $risultato["status"]="ko";
	   $risultato["msg"]="L'operazione di inserimento è fallita";
	}*/
	echo "<h1>Modifica Cliente</h1>";
	$sql = "UPDATE `cliente` SET `email` = '$login', `password` = '$password', `nome` = '$nome', `cognome` = '$cognome', `carta_di_credito` = '$carta_credito', `indicazioni_consegna` = '$indicazioni_consegna' WHERE `cliente`.`email` = '$login';";
	//print $sql;
	$res=$cid->query($sql);
	echo "<h1>Qua</h1>". $res;
	if ($res==1) {
		echo "Primo If";
		$risultato["msg"]="L'operazione di modifica si è conclusa con successo";
		$risultato["status"]="ok";
		return $risultato;
	} else
	{
		echo "Secondo If";
	   $risultato["status"]="ko";
	   $risultato["msg"]="L'operazione di modifica è fallita";
	   return $risultato;
	}
	echo "No If";
	$risultato["status"]="ko";
	$risultato["msg"]=$msg;
	return $risultato;
}


/*leggi FATTORINI*/
function leggiFattorino($cid)
{
	$dati = array();
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	
	/*controllo la connessione*/
	if ($cid->connect_errno) {
	 $risultato["status"]="ko";
	 $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
	 return $risultato;
	}
	/*creo la mia interrogazione*/
	$campo1 = $_SESSION["utente"];
	$sql= "SELECT * FROM fattorino WHERE email='$campo1';";
	$res=$cid->query($sql);
	if ($res==null)
	{
	 $risultato["status"]="ko";
	 $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
	 return $risultato;
	}
	$row=$res->fetch_row();
	//print_r($row);
	for ($i=0; $i<sizeof($row); $i++) {
	    $dati[$i]=$row[$i];
	}
	//print_r($dati);
	$risultato["status"]="ok";
	$risultato["msg"]="Query Effettuata con Successo";
	$risultato["contenuto"]=$dati;
	//print_r($risultato);
	return $risultato;
    }

/*Modifica dati fattorino*/
function ModificaFattorino($cid, $login, $password, $nome, $cognome, $cf, $accredito, $zona, $data)
{	
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	
	$msg="";
	$res=leggiFattorino($cid);
	
	if ($res["status"]=='ko')
	{	
		echo "<h1>Errore nella lettura dei fattorini</h1>";
		$msg .= "Problemi nella lettura dal database<br/>";
	}

	echo "<h1>Modifica Fattorino</h1>";
	$sql = "UPDATE `fattorino` SET `email` = '$login', `password` = '$password', `nome` = '$nome', `cognome` = '$cognome', `cf` = '$cf', `accredito` = '$accredito', `zona_citta`='$zona' ,`data_nascita`= '$data' WHERE `fattorino`.`email` = '$login';";
	//print $sql;
	$res=$cid->query($sql);
	echo "<h1>Qua</h1>". $res;
	if ($res==1) {
		echo "Primo If";
		$risultato["msg"]="L'operazione di modifica si è conclusa con successo";
		$risultato["status"]="ok";
		return $risultato;
	} else
	{
		echo "Secondo If";
	   $risultato["status"]="ko";
	   $risultato["msg"]="L'operazione di modifica è fallita";
	   return $risultato;
	}
	echo "No If";
	$risultato["status"]="ko";
	$risultato["msg"]=$msg;
	return $risultato;
}

/*Modifica dati ristorante*/
function ModificaRistorante($cid, $login, $password, $nome, $piva, $rsociale, $citta, $via, $img) 
{	
	$risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
	
	$msg="";
	$res=leggiRistorante($cid);
	
	if ($res["status"]=='ko')
	{	
		echo "<h1>Errore nella lettura dei Ristoranti</h1>";
		$msg .= "Problemi nella lettura dal database<br/>";
	}
	/*$sqlindirizzo = "INSERT INTO indirizzo VALUES('$citta', '$via', '$cap', '$zona', '0');";
	$res_ind = $cid->query($sqlindirizzo);
	if ($res_ind==1) {
		echo "ind:Primo If";
		$risultato["msg"]="L'operazione di inserimento si è conclusa con successo";
		$risultato["status"]="ok";
	} else
	{
		echo "ind:Secondo If";
	   $risultato["status"]="ko";
	   $risultato["msg"]="L'operazione di inserimento è fallita";
	}*/
	echo "<h1>Modifica Ristorante</h1>";
	$sql = "UPDATE `ristorante` SET `email` = '$login', `password` = '$password', `nome` = '$nome', `partita_iva` = '$piva', `ragione_sociale` = '$rsociale', `citta` = '$citta', `via`='$via' ,`img`= '$img' WHERE `ristorante`.`email` = '$login';";
	print $sql;
	$res=$cid->query($sql);
	echo "<h1>Qua</h1>". $res;
	if ($res==1) {
		echo "Primo If";
		$risultato["msg"]="L'operazione di modifica si è conclusa con successo";
		$risultato["status"]="ok";
		return $risultato;
	} else
	{
		echo "Secondo If";
	   $risultato["status"]="ko";
	   $risultato["msg"]="L'operazione di modifica è fallita";
	   return $risultato;
	}
	echo "No If";
	$risultato["status"]="ko";
	$risultato["msg"]=$msg;
	return $risultato;
}
?>
<?php


/*Funzione per leggere gli ordini*/
function leggiOrdini($cid, $risto)
{
 $ordini = array();
 $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");

 /*controllo la connessione*/
 if ($cid->connect_errno) {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
  return $risultato;
 }
 /*creo la mia interrogazione*/
 $sql= "SELECT * FROM ordine WHERE emailR = '$risto';"; //potrebbe esserci una AND tempo di invio... da controllare
 $res=$cid->query($sql);
 if ($res==null)
 {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella esecuzione della interrogazione " . $cid->error;
  return $risultato;
 }
 while($row=$res->fetch_row())
 {
 array_push($ordini, $row); 
 }
 $risultato["status"]="ok";
 $risultato["msg"]="Query Effettuata con Successo";
 $risultato["contenuto"]=$ordini;
 return $risultato;
}

/*Funzione per stampare gli ordini di un certo ristorante*/
function stampaOrdini($ordini) {
	foreach ($ordini AS $key => $ar_ordini)
	 {
	  $ora_creazione = $ar_ordini[0];
	  $data = $ar_ordini[1];
	  $tempo_consegna = $ar_ordini[3];
	  $tipo_pagamento = $ar_ordini[4];
	  $ora_accettazione = $ar_ordini[5];
	  $stato_ordine =$ar_ordini[6];
	  $costo_totale = $ar_ordini[7];
	  $cliente = $ar_ordini[10];
	  $risto = $ar_ordini[8];
	  $fattorino=$ar_ordini[9];
   
	  echo "
	  <tr>
				   <th scope=\"row\"></th> 
				   <td>$cliente</td>
				   <td>$data</td>
	   <td>$ora_creazione</td>
				   <td>$tempo_consegna </td>
				   <td>$ora_accettazione</td>
				   <td>$stato_ordine</td>
				   <td> &euro; $costo_totale</td>
				   <td id=\"fattorino\">$fattorino</td>
	   <td>
		<a class=\"btn-sm btn-success\" href=\"frontend\modificaOrdineRisto.php?data=$data&ora=$ora_creazione&stato=$stato_ordine\">Modifica</a>
	   <a class=\"btn-sm btn-danger\" href=\"backend\cancellaOrdine-exe.php?data=$data&ora=$ora_creazione\">Cancella</a>
	   </td>
				 </tr>
	  ";   
	} 
   }
/*cancella profilo in base al tipo di utente */
function cancellaOrdine($cid, $ora_creazione, $data)
{
    $risultato= array("msg"=>"","status"=>"ok");
 $msg="";

 if ($cid->connect_errno) {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
  return $risultato;
 }

 $sql = "DELETE FROM ordine WHERE ora_creazione = '$ora_creazione' AND data = '$data' AND stato_ordine = 'consegnato';";
 
    $res = $cid->query($sql);

 // gestione dell'errore
 if ($res==null) 
 {
          $msg = "Si sono verificati i seguenti errori:<br/>" 
       . $res->error;
   $risultato["status"]="ko";
   $risultato["msg"]=$msg;
 }
 return $risultato;

}

/*cancella profilo in base al tipo di utente */
function cancellaProfilo($cid, $login, $tipo)
{
    $risultato= array("msg"=>"","status"=>"ok");
 $msg="";

 if ($cid->connect_errno) {
  $risultato["status"]="ko";
  $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
  return $risultato;
 }
 
 switch ($tipo) {
  case "Cliente":
   $sql = "DELETE FROM cliente WHERE email = '$login';"; 
       break;
  case "Fattorino":
   $sql = "DELETE FROM fattorino WHERE email = '$login';"; 
       break;
  case "Ristorante":
   $sql = "DELETE FROM ristorante WHERE email = '$login';"; 
       break;
   } 

    $res = $cid->query($sql);

  // gestione dell'errore
 if ($res==null) 
 {
         $msg = "Si sono verificati i seguenti errori:<br/>" 
       . $res->error;
   $risultato["status"]="ko";
   $risultato["msg"]=$msg;
 }
 return $risultato;
}
?>