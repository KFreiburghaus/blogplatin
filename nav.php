<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <?php

        if ($loggedin) {
            echo '<a class="navbar-brand js-scroll-trigger" href="profile.php?id='.$_SESSION['userid'].'">'.$_SESSION['username'].'</a>';
            echo '<a class="navbar-brand js-scroll-trigger" href="res/logout.php">Abmelden</a>';

        }

        ?>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php">Startseite</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php#eintraege">Einträge</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="create.php">Eintrag erfassen</a>
                </li>
            </ul>
        </div>
    </div>
</nav>