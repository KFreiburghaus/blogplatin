<?php

session_start();
$loggedin = false;

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;

    header("Location: index.php");
    die();
}


?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php' ?>


<body id="page-top">

  <!-- Navigation -->
  <?php require_once 'nav.php' ?>

  <!-- About Section -->
  <section id="about" class="about-section text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
            <?php
            if (isset($_GET['register']) && $_GET['register'] == 'success') {
                echo '<h2 class="mb-4" style="color: green;">Registrierung erfolgreich</h2>';
            } else if (isset($_GET['register']) && $_GET['register'] == 'fail') {
                echo '<h2 class="mb-4" style="color: red;">Registrierung fehlgeschlagen</h2>';
            }
            ?>
            <h2 class="text-white mb-4">Registrieren</h2>
            <form method="post" action="res/register.php" >
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Username</span>
                    </div>
                    <input type="text" name="username" class="form-control" placeholder="" aria-label="username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">E-Mail</span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="" aria-label="email" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Passwort</span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="" aria-label="password" aria-describedby="basic-addon1">
                </div>
                <button type="submit" class="btn btn-primary">Registrieren</button>

            </form>
            <br>
            <p class="text-white-50">Schon registriert? Dann <a href="login.php">jetzt anmelden.</a></p>
        </div>
      </div>
    </div>
  </section>

  <?php require_once 'footer.php'; ?>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>

</body>

</html>
