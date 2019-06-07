<?php

session_start();
$loggedin = false;

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
}

if (isset($_GET['id']) && $_GET['id'] != '') {

    require_once 'res/dbconnect.php';

    $blogs = array();
	
	$username = '';


    $sqlBlog = "SELECT u.username, b.* FROM user u
            JOIN blog b ON b.user=u.id
            where u.id='".$_GET['id']."'";

    $resultBlog = $conn->query($sqlBlog);
    if ($resultBlog->num_rows > 0) {
        while($row = $resultBlog->fetch_assoc()) {
            $username = $row['username'];
            $entry['bid'] = $row['bid'];
            $entry['text'] = $row['text'];
			
			$dateSplitted = explode(" ", $row['created']);
			
			$date = explode("-", $dateSplitted[0]);
			$time = explode(":", $dateSplitted[1]);
		
			$entry['created'] = $date[2] . '.' . $date[1] . '.' . $date[0] . ' ' . $time[0] . ':' . $time[1];
            array_push($blogs, $entry);
        }
    } else {
		$sqluser = "SELECT u.username FROM user u
            where u.id='".$_GET['id']."'";
		$resultUser = $conn->query($sqluser);
		
		 if ($resultUser->num_rows > 0) {
			while($row = $resultUser->fetch_assoc()) {
				$username = $row['username'];
			}
		 }
		

	}


    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php' ?>

<body id="page-top">

  <!-- Navigation -->
  <?php require_once 'nav.php' ?>


  <header class="masthead">
      <div class="container d-flex h-100 align-items-center">
          <div class="mx-auto text-center">
              <h1 class="mx-auto my-0 text-uppercase"><?php echo $username; ?></h1>
          </div>
      </div>
  </header>


  <!-- Header -->
  <div id="eintraege">

      <?php

      foreach ($blogs as &$value) {
          echo '  <section class="about-section text-center">
                  <div class="container">
                        <div class="row">
                              <div class="col-lg-8 mx-auto">
                                    <h2 class="text-white mb-4">'.$value['created'].'</h2>
                                    <p class="text-white-50">'.$value['text'].'</p>
                                  </div>
                            </div>
                      </div>
                </section>';
      }


      ?>


  </div>


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
