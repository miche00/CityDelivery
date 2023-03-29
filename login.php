<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include "common/setup.php";
    include "common/funzioni.php";
    include "common/head.php"
    ?>  

  <body>

    <?php
    include "common/navbar.php"
    ?>

    <div
      class="hero page-inner overlay"
      style="background-image: url('images/spaghetti.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Login</h1>

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
                  Login
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
      <?php
      	if (isset($_GET["status"])) {
		      if($_GET["status"]=='ok') {
			      echo "<div class=\"alert alert-success\" data-aos=\"fade-up\"><strong>" . urldecode($_GET["msg"]) . "</strong></div>";
          }
        }
	?> 
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
				    <form method="POST" action="backend/login-exe.php">
              <div class="row">
                <div class="col-6">
                  <input name="user" type="email" class="form-control" placeholder="Email"/>
                </div>
                <div class="col-6 mb-3">
                  <input name="pass" type="password" class="form-control" placeholder="Password"/>
              </div>
                  <div class="row">
                  <div class="col-12 mb-3"> 
                    <select name ="tipo" class="form-select">
                      <option value="Cliente">Cliente</option> 
                      <option value="Fattorino">Fattorino</option>
                      <option value="Ristorante">Ristorante</option>
                    </select>
                  </div>
                </div>             
                <div class="col-12 mb-3"> 
                  <input type="submit" value="Login" class="btn btn-primary login loginmodal-submit col-12 mb-3" value="Login">
                </div>
            </form>
            </div>
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
</php>
