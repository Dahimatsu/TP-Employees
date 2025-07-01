<?php
require('../includes/fonctions.php');
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
        <nav class="main-header-nav">
            <div class="container d-flex justify-content-between align-items-center py-3">
                <a class="header-logo" href="?page=accueil">
                    TJ Corporation
                </a>
                <div class="header-nav-links">
                    <ul class="d-flex align-items-center mb-0 list-unstyled">
                        <li>
                            <a href="modele.php?page=accueil">
                                <i class="bi bi-house-door"></i> Accueil
                            </a>
                        </li>
                        <li>
                            <a href="modele.php?page=rechercher">
                                <i class="bi bi-search"></i> Rechercher
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        <?php require($page . '.php'); ?>
    </main>

    <footer class="main-footer">
        <div class="footer-bottom-bar text-center py-2">
            <div class="container d-flex flex-wrap justify-content-center justify-content-md-between align-items-center">
                <span class="copyright-text">ETU004054 - RAVELOMANANTSOA Tony Mahefa</span>
                <span class="copyright-text">ETU004054 - RAKOTOBE Joshua Riki</span>
            </div>
        </div>
    </footer>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>