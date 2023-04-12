<?php
session_start();
include_once("../common/setup.php");
include_once("../common/funzioni.php");

$login = $_SESSION["utente"];
$data= $_GET["data"];
$ora_creazione= $_GET["ora"];

if (isset($_SESSION["logged"]))
{	   	
     $ris=cancellaOrdine($cid, $ora_creazione, $data);
		if ($ris["status"]=='ok'){	
		 	header("Location:../ordiniRisto.php");
		}	
		else
		{
			header("Location:../ordiniRisto.php?");
		}
}
else
{
	header("Location:../index.php?status=ko&msg=". urlencode("Operazione riservata ad utenti registrati."));
}
?>