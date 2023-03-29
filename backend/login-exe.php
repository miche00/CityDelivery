<?php
session_start();
$login= $_POST["user"];
$pwd = $_POST["pass"];
$tipo = $_POST["tipo"];

include_once("../common/setup.php");
include_once("../common/funzioni.php");

if ($cid)
{
    $result= isUser($cid,$login,$pwd, $tipo);
	if ($result["status"]=="ok")
	{
	   $cid->close();
	  session_start();
	  $_SESSION["utente"]=$login;
	  $_SESSION["logged"]=true;
	  $_SESSION["tipo"] = $tipo;
	  header("Location:../login.php?status=ok&msg=". urlencode($result["msg"]));
	}
	else
	{
	  header("Location:../login.php?status=ko&msg=" . urlencode($result["msg"]));
	}
}
else
	header("Location:../login.php?status=ko&msg=". urlencode("errore di connessione al db"));


?>