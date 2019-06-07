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
          <h2 class="text-white mb-4">Anmelden</h2>
            <form method="post" action="res/login.php" >
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="" aria-label="Email" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Passwort</span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="" aria-label="password" aria-describedby="basic-addon1">
                </div>
                <button type="submit" class="btn btn-primary">Anmelden</button>

            </form>
            <br>
            <p class="text-white-50">Noch nicht angemeldet? Dann <a href="register.php">jetzt registrieren.</a></p>
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
