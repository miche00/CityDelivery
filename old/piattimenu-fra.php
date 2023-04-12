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


          <?php
          if (!isset($_GET["risto"])) {
            header("Location:ristoranti.php?status=ko&msg=ristorante-non-selezionato");
          }
            $risto = $_GET["risto"];
            $risultato1 = leggiPiatto($cid, $risto);
            $piatti = $risultato1["contenuto"];
            
            echo "
            
            <div
              class=\"hero page-inner overlay\"
              style=\"background-image: url('images/risto_copertina.jpg')\"
            >
              <div class=\"container\">
                <div class=\"row justify-content-center align-items-center mb-3\">
                  <div class=\"col-lg-9 text-center mt-5\">
                    <h1 class=\"heading\" data-aos=\"fade-up\">$risto</h1>
                      <nav
                        aria-label=\"breadcrumb\"
                        data-aos=\"fade-up\"
                        data-aos-delay=\"200\"
                      >
                        <ol class=\"breadcrumb text-center justify-content-center\">
                          <li class=\"breadcrumb-item\"><a href=\"ristoranti.php\">Ristoranti</a></li>
                          <li
                            class= \"breadcrumb-item active text-white-50\"
                            aria-current=\"page\"
                          >
                            $risto
                          </li>
                        </ol>
                      </nav>
                  </div>
                </div>
              </div>
            </div>


            <div class=\"section bg-light\">
              <div class=\"container\">
                <div class=\"row align-items-left\" data-aos=\"fade-up\">
                  <div class=\"section\">
                    <div class=\"container\">
                      <div class=\"row mb-5 align-items-center\">
                        <div class=\"col-lg-6 text-center mx-auto\">
                          <h2 class=\"font-weight-bold text-primary heading\">
                            I nostri piatti
                          </h2>
                        </div>
                      </div>
                      <div class=\"row\">
                        <div class=\"col-12\">
                          <div class=\"property-slider-wrap\">
                            <div class=\"property-slider\">
                                ";
                              stampaPiatto($piatti);
                              echo "
                            </div>
            
                              <div
                                id=\"property-nav\"
                                class=\"controls\"
                                tabindex=\"0\"
                                aria-label=\"Carousel Navigation\"
                              >
                                <span
                                  class=\"prev\"
                                  data-controls=\"prev\"
                                  aria-controls=\"property\"
                                  tabindex=\"-1\"
                                  >Prev</span
                                >
                                <span
                                  class=\"next\"
                                  data-controls=\"next\"
                                  aria-controls=\"property\"
                                  tabindex=\"-1\"
                                  >Next</span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>        
                    </div>
              </div>
                      ";
                      ?>


                <?php
                if (!isset($_GET["risto"])) {
                  header("Location:ristoranti.php?status=ko&msg=ristorante-non-selezionato");
                }
                  $risto = $_GET["risto"];
                  $risultato2 = leggiMenu($cid, $risto);
                  $menu = $risultato2["contenuto"];
                  
                  echo "
                  <div class=\"row align-items-left\" data-aos=\"fade-up\">
                  <div class=\"section sec-testimonials\">
                    <div class=\"container\">
                      <div class=\"row mb-5 align-items-center\">
                        <div class=\"col-lg-6 text-center mx-auto\">
                          <h2 class=\"font-weight-bold text-primary heading\">
                            I nostri Menu
                          </h2>
                        </div>
                      </div>
                      <div class=\"row\">
                        <div class=\"col-12\">
                        <div class=\"testimonial-slider-wrap\">
                          <div class=\"testimonial-slider\">
                        ";
                        stampaMenu($menu);
                        echo "
                      </div>
              
                      <div
                        id=\"testimonial-nav\"
                        class=\"controls\"
                        tabindex=\"0\"
                        aria-label=\"Carousel Navigation\"
                        >
                        <span
                          class=\"prev\"
                          data-controls=\"prev\"
                          aria-controls=\"testimonial\"
                          tabindex=\"-1\"
                          >Prev</span
                        >
                        <span
                          class=\"next\"
                          data-controls=\"next\"
                          aria-controls=\"testimonial\"
                          tabindex=\"-1\"
                          >Next</span
                          >
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                </div>
                </div>


      ";
      ?>
                      </div>
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
    </body>
  </html>
  