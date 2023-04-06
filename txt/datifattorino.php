<?php 
// è una form uguale a quella di registrazione, cambia solo la query al database
session_start();
include "../setup.php";
include "../funzioni.php";
$risultato = leggiFattorino($cid);
print_r("ris");
print_r($risultato);
$dati = $risultato["contenuto"];
//$via = $dati[7];
//$via = str_ireplace(' ', '', $via);
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
                    name="piva"
                      type="text"
                      class="form-control"
                      value=<?php echo $dati[3];?>
                      placeholder="Partita Iva"
                    />
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-6">
                    <input
                      name="rsociale"
                      type="text"
                      class="form-control"
                      value=<?php echo $dati[4];?>
                      placeholder="Ragione Sociale"
                    />
                  </div>
                  <div class="col-6 mb-3">
                    <input
                      name="citta"
                      type="text"
                      class="form-control"
                      value=<?php echo $dati[5];?>
                      placeholder="Città"
                    />
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-6 mb-3">
                    <input
                      name="via"
                      type="text"
                      class="form-control"
                      value=<?php echo $dati[6];?>
                      placeholder="Via"
                      disabled
                    />
                  </div>
                </div>
              </div>
            <input  type="submit" value="Salva" class="btn btn-primary col-12 mb-3">
            <input  type="submit" value="Esci senza salvare" class="btn btn-danger col-12 mb-3"
  </form>
</div>