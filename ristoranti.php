<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include "common/head.php";
    include "common/funzioni.php"
    ?>  
  <body>
  <?php
    include "common/navbar.php"
    ?>

    <div
      class="hero page-inner overlay"
      style="background-image: url('images/risto_copertina.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center mb-3">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Ristoranti</h1>

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
                  Ristoranti
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
        <?php 
    echo "<div>";
        $risultato = leggiRistoranti($cid);
        //print_r($ristoranti);
        $ristoranti = $risultato["contenuto"];
        //print_r($ristoranti);
        stampaRistoranti($ristoranti);
    echo "</div>";
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