<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include "common/setup.php";
    include "common/head.php";
    include "common/funzioni.php";
    $email=$_SESSION["utente"];
    ?>  
  <body>
  <?php
    include "common/navbar.php"
    ?>


        <?php
        $tipo = $_SESSION["tipo"];   
        $risultato = leggiOrdini($cid, $email, $tipo);
          $ordini = $risultato["contenuto"];
          echo "
          <div
          class=\"hero page-inner overlay\"
          style=\"background-image: url('images/risto_copertina.jpg')\"
        >
          <div class=\"container\">
            <div class=\"row justify-content-center align-items-center mb-3\">
              <div class=\"col-lg-9 text-center mt-5\">
                <h1 class=\"heading\" data-aos=\"fade-up\">Ordini</h1>
    
                <nav
                  aria-label=\"breadcrumb\"
                  data-aos=\"fade-up\"
                  data-aos-delay=\"200\"
                >
                  <ol class=\"breadcrumb text-center justify-content-center\">
                    <li class=\"breadcrumb-item\"><a href=\"index.php\">Home</a></li>
                    <li
                      class=\"breadcrumb-item active text-white-50\"
                      aria-current=\"page\"
                    >
                      Ordini
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>

        <div class=\"section\">
        <div class=\"container\">
        <div class=\"row align-items-center\">
          <div class=\"col-lg-6 text-center mx-auto\">
            <h2 class=\"font-weight-bold text-primary heading\" data-aos=\"fade-up\">
              Ordini attivi
            </h2>
          </div>
        </div>

        <div class= \"row\">
        <div class=\"col-lg-12 text-center mt-5\">
        <div class=\"table-responsive\">
          <table class=\"table\" data-aos=\"fade-up\" >
          <thead>
            <tr>";
            switch ($tipo) {
              case "Cliente":
                echo "<th scope=\"col\">Tipo Pagamento (Cliente e Fattorino)</th>
                <th scope=\"col\">Ristorante</th>
                <th scope=\"col\">Data</th>
                <th scope=\"col\">Ora Creazione</th>
                <th scope=\"col\">Tempo di Consegna</th>
                <th scope=\"col\">Ora Accettazione</th>
                <th scope=\"col\">Stato dell'ordine</th>
                <th scope=\"col\">Costo Totale</th>
                <th scope=\"col\">Fattorino</th>
                <th scope=\"col\">Modifica</th>
                <th scope=\"col\">Cancella</th>
                  <th scope=\"col\">Ordina</th>";
                  break;
              case "Fattorino":
                echo "<th scope=\"col\">Tipo Pagamento (Cliente e Fattorino)</th>
                <th scope=\"col\">Ristorante</th>
                <th scope=\"col\">Data</th>
                <th scope=\"col\">Ora Creazione</th>
                <th scope=\"col\">Tempo di Consegna</th>
                <th scope=\"col\">Ora Accettazione</th>
                <th scope=\"col\">Stato dell'ordine</th>
                <th scope=\"col\">Costo Totale</th>
                <th scope=\"col\">Fattorino</th>
                <th scope=\"col\">Modifica</th>
                <th scope=\"col\">Cancella</th>
                  <th scope=\"col\">Ordina</th>";
                  break;
              case "Ristorante":
                echo "<th scope=\"col\">Cliente</th>
                <th scope=\"col\">Data</th>
                <th scope=\"col\">Ora Creazione</th>
                <th scope=\"col\">Tempo di Consegna</th>
                <th scope=\"col\">Ora Accettazione</th>
                <th scope=\"col\">Stato dell'ordine</th>
                <th scope=\"col\">Costo Totale</th>
                <th scope=\"col\">Fattorino</th>
                <th scope=\"col\">Modifica</th>
                <th scope=\"col\">Cancella</th>
                  <th scope=\"col\">Visualizza</th>";
                  break;
            }
              echo "
            </tr>
          </thead>
          <tbody>
          ";
          stampaOrdini($cid, $ordini, $tipo);
          echo "
          </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
  ";
  
  ?>       
    <?php
      include "common/footer.php"
    ?>  
  </body>
</html>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/aos.js"></script>
<script src="js/navbar.js"></script>
<script src="js/counter.js"></script>
<script src="js/custom.js"></script>
<script src="js/ajax.js"></script>