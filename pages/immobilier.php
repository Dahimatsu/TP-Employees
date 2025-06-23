<?php
require('../include/fonctions.php');
$page = $_GET['page'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css" />
    <title><?= ucfirst($page) ?></title>
</head>

<body class="d-flex flex-column min-vh-100">

    <header>
        <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
            <div class="container">
                <a class="navbar-brand me-auto dah-immobilier-logo-text" href="immobilier.php?page=liste">
                    <img src="../assets/images/logo.png" alt="DahImmobilier Logo" class="dah-immobilier-logo me-2" width="50" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="immobilier.php?page=liste">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Annonces</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Propriété</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <div class="navbar-nav ms-auto align-items-center"> <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownLang" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-globe me-1"></i> FR
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownLang">
                            <li><a class="dropdown-item" href="#">FR</a></li>
                            <li><a class="dropdown-item" href="#">EN</a></li>
                        </ul>
                        <span class="navbar-text mx-2">|</span> <a class="nav-link d-flex align-items-center" href="#">
                            <i class="bi bi-person-circle me-1"></i> Se Connecter
                        </a>
                        <span class="navbar-text mx-2">|</span> <a class="nav-link d-flex align-items-center" href="#">
                            <i class="bi bi-person-circle me-1"></i> Bonjour, Tony! </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        <?php require($page . '.php'); ?>
    </main>

    <footer class="bg-light py-3 mt-auto text-center">
        <p class="mb-0">ETU004054 - RAVELOMANANTSOA Tony Mahefa</p>
        <p class="mb-0">&copy; 2025</p>
    </footer>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>