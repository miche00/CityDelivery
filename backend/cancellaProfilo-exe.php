<?php
session_start();
include_once("../common/setup.php");
include_once("../common/funzioni.php");

$tipo = $_SESSION["tipo"];
$login = $_SESSION["utente"];

if (isset($_SESSION["logged"]))
{	   	
		$ris=cancellaProfilo($cid, $login, $tipo);
		if ($ris["status"]=='ok'){
			session_destroy();
			header("Location: ../index.php");
		}
		else
			{
			header("Location:../index.php?status=ko&msg=". urlencode($ris["msg"]));
		}
}
else
{
	header("Location:../index.php?status=ko&msg=". urlencode("Operazione riservata ad utenti registrati. Procedi con la login"));
}
?>