<html>
<head>
<?php 
session_start();
include "common/funzioni.php";
include "common/setup.php";
include "common/head.php";
include "common/navbar.php";
$tipo = $_SESSION["tipo"];
 ?>
</head>
<body>
<div class="section" style="height:100px">
</div>
<?php

if (isset($_SESSION["logged"]))
{	   	

        if (isset($_GET["status"])) {
            if ($_GET["status"]=="ok") {
                echo "<div class=\"alert alert-success\"><strong>" . urldecode($_GET["msg"]) . "</strong></div>";
            } else {
                echo "<div class=\"alert alert-danger\"><strong>Errore!</strong>" . urldecode($_GET["msg"]) . "</div>";
            }
        }

    $risultato = MostraDati($cid, $tipo);

    }
    else
    {
        header("Location:../CityDelivery/index.php?status=ko&msg=". urlencode("Operazione riservata ad utenti registrati. Procedi con la login"));
    }
?>
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