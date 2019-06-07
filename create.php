<?php

session_start();
$loggedin = false;

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: login.php");
    die();
} else {
    $loggedin = true;
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
          <?php
          if (isset($_GET['create']) && $_GET['create'] == 'success') {
              echo '<h2 class="mb-4" style="color: green;">Erfassung eines Eintrags erfolgreich</h2>';
          } else if (isset($_GET['create']) && $_GET['create'] == 'fail') {
              echo '<h2 class="mb-4" style="color: red;">Erfassung eines Eintrags fehlgeschlagen</h2>';
          }
          ?>
        <div class="col-lg-8 mx-auto">
          <h2 class="text-white mb-4">Eintrag</h2>
            <form method="post" action="res/createEntry.php" >
                <div class="form-group">
                    <label for="comment">Eintrag:</label>
                    <textarea class="form-control" rows="5" id="entry" name="entry"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Erfassen</button>
            </form>
            <br>
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
