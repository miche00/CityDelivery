<?php
session_start();
include "../common/funzioni.php";
include "../common/setup.php";
echo $_SESSION["tipo"];
if ((isset($_SESSION["logged"])) and (($_SESSION["tipo"]) == "Cliente")) {
        //header("Location:../login.php");

        //echo "<h1>logged</h1>";

        //$tipo = $_SESSION["tipo"];
        //echo "<h1>$tipo</h1>";
        echo "<h1>Cliente loggato</h1>";
        if (isset($_GET["nomeR"])) {
            $nomeR = $_GET["nomeR"];
        }
        $nomeR = $_GET["nomeR"];
        $emailR = $_GET["emailR"];
        $nomepm = $_GET["nome"];
        $login = $_SESSION["utente"];

        $date = date('Y-m-d', time());
        $time = date('H:i:s', time());
        echo "<h1>$date</h1>";
        echo "<h1>$time</h1>";
        echo "<h1>$emailR</h1>";
        echo "<h1>$nomepm</h1>";
        echo "<h1>$login</h1>";
        $risultato = AddOrder($cid, $time, $date, $login, $emailR, $nomepm);
        $status = $risultato["status"];
        $msg = $risultato["msg"];
        header("Location:../piattimenu.php?emailR=$emailR&nomeR=$nomeR&status=$status&$msg=$msg&nomeR=$nomeR");
} else {
    header("Location:../login.php?msg=orderrequest");
    echo "<h1>unlogged</h1>";
}
?>