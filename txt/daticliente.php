<?php 
// è una form uguale a quella di registrazione, cambia solo la query al database
session_start();
include "../setup.php";
include "../funzioni.php";
$risultato = leggiDati($cid);
//print_r("ris");
//print_r($risultato);
$dati = $risultato["contenuto"];
$via = $dati[7];
$via = str_ireplace(' ', '', $via);
//echo $via;
?>
<div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
  <form method="POST" action="backend/modificadati-exe.php">
               <div class="col-lg-12">
                <div class="row">
                  <div class="col-6">
                    <input
                      name="email"
                      type="email"
                      class="form-control" <?php echo "value=" .$dati[0];?>
                      placeholder="Email" 
                      disabled
                    />
                  </div>  
                  <div class="col-6 mb-3">
                    <input
                      name="password"
                      type="password"
                      class="form-control" <?php echo "value=" .$dati[1];?> 
                      placeholder="Password"
                    />
                  </div>
                </div>
              </div>
               <div class="col-lg-12">
                <div class="row">
                  <div class="col-6">
                    <input
                      name="nome"
                      type="text"
                      class="form-control"
                      value=<?php echo $dati[2];?>
                      placeholder="Nome"
                    />
                  </div>
                  <div class="col-6 mb-3">
                    <input
                    name="cognome"
                      type="text"
                      class="form-control"
                      value=<?php echo $dati[3];?>
                      placeholder="Cognome"
                    />
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-6">
                    <input
                      name="carta_di_credito"
                      type="text"
                      class="form-control"
                      value=<?php echo $dati[4];?>
                      placeholder="Carta di Credito"
                    />
                  </div>
                  <div class="col-6 mb-3">
                    <input
                      name="indicazioni_consegna"
                      type="text"
                      class="form-control"
                      value=<?php echo $dati[5];?>
                      placeholder="Indicazioni Consegna"
                    />
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-6 mb-3">
                    <input
                      name="citta"
                      type="text"
                      class="form-control"
                      value=<?php echo $dati[6];?>
                      placeholder="Città"
                      disabled
                    />
                  </div>
                  <div class="col-6 mb-3">
                    <input
                      name="via"
                      type="text"
                      class="form-control"
                      placeholder="Via"
                      disabled <?php echo "value=". $via;?>
                    />
                  </div>
                </div>
              </div>
            <input  type="submit" value="Salva" class="btn btn-primary col-12 mb-3">
            <input  type="submit" value="Esci senza salvare" class="btn btn-danger col-12 mb-3"
  </form>
</div>