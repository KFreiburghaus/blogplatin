<?php

session_start();
$loggedin = false;

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php' ?>

<body id="page-top">

  <!-- Navigation -->
  <?php require_once 'nav.php' ?>


  <!-- Header -->
  <header class="masthead">
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center">
        <h1 class="mx-auto my-0 text-uppercase">BlogPlatin</h1>
        <h2 class="text-white-50 mx-auto mt-2 mb-5">Veröffentliche jetzt einen Blog.</h2>
          <?php
          if ($loggedin) {
              echo '<a href="create.php" class="btn btn-primary js-scroll-trigger">Beitrag erfassen</a>';
          } else {
              echo '<a href="login.php" class="btn btn-primary js-scroll-trigger">Anmelden</a>';
          }

          ?>
      </div>
    </div>
  </header>

  <div id="eintraege">

  </div>


    <?php require_once 'footer.php'; ?>



  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>


  <script>
      loadEntries();

      <?php if ($loggedin) {?>

      function loadEntries() {
          var eintraege = document.getElementById("eintraege");
          eintraege.innerHTML ='';

          $.ajax({
              url: 'res/getEntries.php',
              type: "GET",
              dataType: "json",
              success: function (data) {

                  $.each(data, function (index, element) {
                      var commentDisplay = '';
                      if (element.commentcount > 0) {
                          commentDisplay = '<p style="color: #9191ff;" onclick="loadComments(' + element.bid + ')" >Alle ' + element.commentcount + ' Kommentare anzeigen</p>\n';
                      } else {
                          commentDisplay = '<p style="color: #9191ff;" >Dieser Beitrag hat keinen Kommentar</p>\n';
                      }

                      var styleLike = 'color:white;font-size: 1.8em;height: 1em;';
                      var styleDislike = 'color:white;margin-left:10px;font-size: 1.8em;height: 1em;';

                      if (element.myAction == 1) {
                          styleLike = 'color:green;font-size: 1.8em;height: 1em;';;
                      } else if (element.myAction == -1) {
                          styleDislike = 'color:red;margin-left:10px;font-size: 1.8em;height: 1em;';
                      }

                      eintraege.innerHTML = eintraege.innerHTML + '<section class="about-section text-center">\n' +
                          '        <div class="container">\n' +
                          '          <div class="row"><i class="fa fa-thumbs-up" id="like-fa-'+element.bid+'" style="'+styleLike+'" onclick="like('+element.bid+', '+element.myAction+');">'+element.likes+'</i> <i onclick="dislike('+element.bid+', '+element.myAction+');" id="dislike-fa-'+element.bid+'" class="fa fa-thumbs-down" style="'+styleDislike+'">'+element.dislikes+'</i>\n' +
                          '            <div class="col-lg-8 mx-auto">\n' +
                          '              <h2 class="text-white mb-4">' + parseTime(element.created) + ' | <a href="profile.php?id='+element.blogcreatorid+'">' + element.blogcreator + '</a></h2>\n' +
                          '              <p class="text-white-50">' + element.text + '</p>\n ' + commentDisplay +
                          '              <p style="color: #9191ff;" id="commentText-' + element.bid + '" onclick="openCommentBox(' + element.bid + ')" >Kommentieren </p>\n' +
                          '            </div>\n' +
                          '          </div>\n' +
                          '        </div>\n' +
                          '      </section>';
                  });

                  console.log(data);
              }
          });
      }

      <?php } else { ?>

      function loadEntries() {
          var eintraege = document.getElementById("eintraege");
          eintraege.innerHTML ='';

          $.ajax({
              url: 'res/getEntries.php',
              type: "GET",
              dataType: "json",
              success: function (data) {

                  $.each(data, function (index, element) {
                      var commentDisplay = '';
                      if (element.commentcount > 0) {
                          commentDisplay = '<p style="color: #9191ff;" id="commentText-' + element.bid + '" onclick="loadComments(' + element.bid + ')" >Alle ' + element.commentcount + ' Kommentare anzeigen</p>\n';
                      } else {
                          commentDisplay = '<p style="color: #9191ff;" >Dieser Beitrag hat keinen Kommentar</p>\n';
                      }

                      eintraege.innerHTML = eintraege.innerHTML + '<section class="about-section text-center">\n' +
                          '        <div class="container">\n' +
                          '          <div class="row">\n' +
                          '            <div class="col-lg-8 mx-auto">\n' +
                          '              <h2 class="text-white mb-4">' + parseTime(element.created) + '</h2>\n' +
                          '              <p class="text-white-50">' + element.text + '</p>\n' + commentDisplay +
                          '            </div>\n' +
                          '          </div>\n' +
                          '        </div>\n' +
                          '      </section>';
                  });

                  console.log(data);
              }
          });
      }
      <?php } ?>
      </script>



  <script>

      function like(id, myaction) {
          var faLike = document.getElementById("like-fa-"+id);
          var faDislike = document.getElementById("dislike-fa-"+id);

          var data = 'id='+id+'&like=1';
          var request = $.ajax({
              url: "res/createLike.php",
              type: "post",
              data: data
          });
          request.done(function (response, textStatus, jqXHR){
              if (myaction == -1) {
                  faDislike.innerHTML = Number(faDislike.innerHTML) -1;
              }

              if (faLike.style.color == 'green') {
                  faLike.style.color = 'white';
                  faLike.innerHTML = Number(faLike.innerHTML) -1;
              } else {
                  faLike.style.color = 'green';
                  faLike.innerHTML = Number(faLike.innerHTML) + 1;
              }
              faDislike.style.color = 'white';
          });
      }



      function dislike(id, myaction) {
          var faLike = document.getElementById("like-fa-"+id);
          var faDislike = document.getElementById("dislike-fa-"+id);

          var data = 'id='+id+'&like=-1';
          var request = $.ajax({
              url: "res/createLike.php",
              type: "post",
              data: data
          });
          request.done(function (response, textStatus, jqXHR){
              if (myaction == 1) {
                  faLike.innerHTML = Number(faLike.innerHTML) -1;
              }


              if (faDislike.style.color == 'red') {
                  faDislike.style.color = 'white';
                  faDislike.innerHTML = Number(faDislike.innerHTML) -1;

              } else {
                  faDislike.style.color = 'red';
                  faDislike.innerHTML = Number(faDislike.innerHTML) + 1;

              }
              faLike.style.color = 'white';
          });

      }

    function parseTime(time) {
        var timeSplitted = time.split(" ");

        var dateAsString = timeSplitted[0];
        var timeAsString = timeSplitted[1];

        var splittedDate = dateAsString.split("-");
        var splittedTime = timeAsString.split(":");

        return splittedDate[2] + '.' + splittedDate[1] + "." + splittedDate[0] + " " + splittedTime[0] + ":" + splittedTime[1];
    }



      function loadComments(id) {
          $.ajax({
              url: 'res/getComment.php?id='+id,
              type: "GET",
              dataType: "json",
              success: function (data) {
                  var line = '';


                  $.each(data, function (index, element) {
                      line = line + '<tr><td>'+element.text+'</td><td><a href="profile.php?id='+element.userId+'">'+element.username+'</a></td><td>'+parseTime(element.created)+'</td></tr>';
                  });

                  var modalContainer = document.getElementById("modal-container");
                  modalContainer.innerHTML = '<div class="modal fade" id="modal-'+id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\n' +
                      '              <div class="modal-dialog" role="document">\n' +
                      '              <div class="modal-content" style="width:50em;">\n' +
                      '              <div class="modal-header">\n' +
                      '              <h5 class="modal-title" id="exampleModalLabel">Kommentare</h5>\n' +
                      '          <button type="button" class="close" data-dismiss="modal" aria-label="Close">\n' +
                      '              <span aria-hidden="true">&times;</span>\n' +
                      '          </button>\n' +
                      '          </div>\n' +
                      '          <div class="modal-body">\n' +
                      '<table class="table">\n' +
                      '  <thead>\n' +
                      '    <tr>\n' +
                      '      <th scope="col">Kommentar</th>\n' +
                      '      <th scope="col">Ersteller</th>\n' +
                      '      <th scope="col">Wann</th>\n' +
                      '    </tr>\n' +
                      '  </thead>\n' +
                      '  <tbody>\n' + line +
                      '  </tbody>\n' +
                      '</table>' +
                      '      </div>\n' +
                      '          <div class="modal-footer">\n' +
                      '              <button type="button" class="btn btn-secondary" data-dismiss="modal">Schliessen</button>\n' +
                      '          </div>\n' +
                      '          </div>\n' +
                      '          </div>\n' +
                      '</div>';
                  $("#modal-"+id).modal();

              }
          });


      }

      function openCommentBox(id) {
          var commentBox = document.getElementById("commentText-"+id);

          var newEl = document.createElement('div');
          newEl.innerHTML = ' <textarea class="form-control" rows="5" id="create-comment-'+id+'"></textarea><button onclick="commentEntry('+id+')" class="btn btn-primary">Kommentieren</button>';
          commentBox.parentNode.replaceChild(newEl, commentBox);
      }

      function commentEntry(id) {
          var comment = document.getElementById("create-comment-"+id).value;
          var data = 'id='+id+'&comment='+comment;
          var request = $.ajax({
              url: "res/createComment.php",
              type: "post",
              data: data
          });
          request.done(function (response, textStatus, jqXHR){
              loadEntries();
              console.log(response);
          });
      }

  </script>

</body>

</html>
