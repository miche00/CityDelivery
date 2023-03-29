<?php
include_once "common/funzioni.php";
function MostraDati($cid) {
    echo "<div>";
        $risultato = leggiDati($cid);
        $dati = $risultato["contenuto"];
        print_r($dati);
        stampaDati($dati);
    echo "</div>";
}
?>