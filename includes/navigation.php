<body>

  <?php session_start(); ?>
    
  <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Pallette Virtuose</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">A Propos</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Galerie</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">Toutes les oeuvres</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li><a class="dropdown-item" href="#!">Oeuvres recents</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Navbar-->
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                            <?php
                            if (!isset($_SESSION['id_artiste'])) {
                                echo '<li><a class="dropdown-item" href="register.php">S\'inscrire</a></li>';
                                echo '<li><a class="dropdown-item" href="login.php">Se connecter</a></li>';
                            } else {
                                echo '<li><a class="dropdown-item" href="#!">Nouvelle production</a></li>';
                                echo '<li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Se deconnecter</a></li>';

                            echo'<li><a class="dropdown-item" href="update_profile.php">Mise à jour du profile</a></li>';
                            }
                            ?>




                            
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>