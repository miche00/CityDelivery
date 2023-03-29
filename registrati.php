<!DOCTYPE html>
<html lang="en">
<?php
    include "common/head.php";
    include "common/funzioni.php";
    ?>  

  <body>

    <?php
    include "common/navbar.php"
    ?>

    <div
      class="hero page-inner overlay"
      style="background-image: url('images/fiorentina.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Registrati</h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li
                  class="breadcrumb-item active text-white-50"
                  aria-current="page"
                >
                  Registrati
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  <div class="section mb-3">
    <div class="container" data-aos="fade-up" >
        <form method="POST" action="backend/registrati-exe.php">
          <div class="row">
            <div class="col-12 "> 
              <select name="tipo" id="form1" class="form-select" required oninput=loadDoc()>
                <option value="Cliente">Cliente</option> 
                <option value="Fattorino">Fattorino</option>
                <option value="Ristorante">Ristorante</option>
              </select>
            </div>
          </div>
          <div class="section" id="section1">
          <div class="col-lg-12">
               <div class="col-lg-12">
                <div class="row">
                  <div class="col-6">
                    <input
                      name="email"
                      type="email"
                      class="form-control"
                      placeholder="Email"
                      required
                    />
                  </div>
                  <div class="col-6 mb-3">
                    <input
                      name="password"
                      type="password"
                      class="form-control"
                      placeholder="Password"
                      required
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
                      placeholder="Nome"
                      required
                    />
                  </div>
                  <div class="col-6 mb-3">
                    <input
                    name="cognome"
                      type="text"
                      class="form-control"
                      placeholder="Cognome"
                      required
                    />
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-6">
                    <input
                    name="citta"
                      type="text"
                      class="form-control"
                      placeholder="Città"
                      required
                    />
                  </div>
                  <div class="col-6 mb-3">
                    <input
                      name="via"
                      type="text"
                      class="form-control"
                      placeholder="Via"
                      required
                    />
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-12 mb-3">
                    <input
                      name="cartadicredito"
                      type="text"
                      class="form-control"
                      placeholder="Carta di Credito"
                      required
                    />
                  </div>
                </div>
              </div>
<?php /*
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-6">
                    <input
                    name="cap"
                      type="text"
                      class="form-control"
                      placeholder="CAP"
                      required
                    />
                  </div>
                  <div class="col-6 mb-3">
                    <input
                      name="zona"
                      type="text"
                      class="form-control"
                      placeholder="Zona"
                      required
                    />
                  </div>
                </div>
              </div>
*/?>
            <input type="submit" value="Registrati" class="btn btn-primary col-12 mb-3"
            </div>
          </div>
        </form>
    </div>
  </div>
    <div class="section" id="section1">
    </div>
    <?php
    include "common/footer.php"
    ?>  

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/ajax.js"></script>
  </body>
</php>
