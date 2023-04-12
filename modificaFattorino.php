<html>
<head>
<?php 
session_start();
include "common/head.php";
include "common/navbar.php";
include "common/funzioni.php";
include "common/setup.php";

$email=$_GET["email"];
$password = $_GET["password"];
$nome = $_GET["nome"];
$cognome = $_GET["cognome"];
$cf = $_GET["cf"];
$accredito = $_GET["accredito"];
$zona = $_GET["zona"];
$data = $_GET["data"];
 ?>
</head>
<body>
<div class="section" style="height:100px"></div>
<div class="section mx-auto border" style="max-width: 540px">
    <div class=card>
    <img src="images/profile.png" class="card-img-top">
        <div id ="profilo" class="card-body">
            <div class="section mb-3">
                <div class="container" data-aos="fade-up" >
                    <form method="POST" action="backend\modificadati-exe.php">
                    <div class="row">
                        <div class="col-12 "> 
                        <h1 class="text-center">Modifica i tuoi dati</h1>
                        </div>
                    </div>
                    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <input
                                    name="email"
                                    type="email"
                                    class="form-control" <?php echo "value=" ."$email";?>
                                    placeholder="Email" 
                                    disabled
                                    />
                                </div>                     
                                <div class="col-6 mb-3">
                                    <input
                                    name="password"
                                    type="password"
                                    class="form-control" <?php echo "value=" ."$password";?> 
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
                                    class="form-control" <?php echo "value="  ."$nome";?>
                                    placeholder="Nome"
                                    />
                                </div>
                                <div class="col-6 mb-3">
                                    <input
                                    name="cognome"
                                    type="text"
                                    class="form-control"<?php echo "value="  ."$cognome";?>
                                    placeholder="Cognome"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-6">
                                    <input
                                    name="cf"
                                    type="text"
                                    class="form-control" <?php echo"value="  ."$cf";?>
                                    placeholder="Codice Fiscale"
                                    disabled
                                    />
                                </div>
                                <div class="col-6 mb-3">
                                    <input
                                    name="zona"
                                    type="text"
                                    class="form-control" <?php echo"value="."$zona";?>
                                    placeholder="Zona"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <input
                                    name="dataNascita"
                                    type="text"
                                    class="form-control" <?php echo "value=" ."$data";?>
                                    placeholder="Data di Nascita"
                                    disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Salva le modifiche" class="btn btn-primary col-12 mb-3">
                        <input type="reset" value="Annulla" class="btn btn-danger col-12 mb-3">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include "common/footer.php"; ?>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/aos.js"></script>
<script src="js/navbar.js"></script>
<script src="js/counter.js"></script>
<script src="js/custom.js"></script>
<script src="js/ajax.js"></script>