  <div class="site-mobile-menu site-navbar-target">
  <div class="site-mobile-menu-header"></div>
  <div class="site-mobile-menu-body"></div>
  </div>
  <nav class="site-nav">
    <div class="container">
      <div class="menu-bg-wrap">
        <div class="site-navigation">
          <a href="index.php" class="logo m-0 float-start">CityDelivery</a>

          <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
            <li><a class="text-light" href="index.php">Home</a></li>
      
            <?php if (isset($_SESSION["logged"])) {?>
              <li><a class = "text-light" href="ristoranti.php">Ristoranti</a></li>
              <li class="has-children">
                <a class = "text-light" href="_ajax.php">Funzionalità</a>
                <ul class="dropdown">
                  <li><a class="text-light" href="_ajax.php">- Sottofunz1</a></li>
                  <li><a class="text-light" href="_ajax.php">- Sottofunz2</a></li>
                </ul>
              </li>
              <li><a class = "text-light" href="ordiniRisto.php">Ordini</a></li>
              <li><a class = "text-light" href="profilo.php">Profilo</a></li>
              <li><a class = "text-light" href="backend/logout-exe.php">Logout</a></li>
            <?php } else { ?>
              <li><a class = "text-light" href="ristoranti.php">Ristoranti</a></li>
              <li><a class = "text-light" href="registrati.php">Registrati</a></li>
              <li><a class = "text-light" href="login.php">Login</a></li>

            <?php } ?>
          </ul>
          <!-- Navbar Collapser !-->
          <a
            href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
          </a>
        </div>
      </div>
    </div>
  </nav>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>