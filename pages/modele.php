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
            <div class="container d-flex justify-content-between align-items-center py-2">
                <a class="header-logo fs-5" href="?page=accueil" style="padding: 0.25rem 0.5rem;">
                    TJ Corporation
                </a>
                <div class="header-nav-links d-none d-md-block">
                    <ul class="d-flex align-items-center mb-0 list-unstyled gap-2">
                        <li>
                            <a href="modele.php?page=accueil" class="px-2 py-1 small">
                                <i class="bi bi-house-door"></i> Accueil
                            </a>
                        </li>
                        <li>
                            <a href="modele.php?page=rechercher" class="px-2 py-1 small">
                                <i class="bi bi-search"></i> Rechercher
                            </a>
                        </li>
                        <li>
                            <a href="modele.php?page=infoEmploi" class="px-2 py-1 small">
                                <i class="bi bi-info-circle"></i> Nos emplois
                            </a>
                        </li>
                        <li>
                            <a href="modele.php?page=ajouter" class="px-2 py-1 small">
                                <i class="bi bi-plus"></i> Ajouter
                            </a>
                        </li>
                        <li>
                            <a href="modele.php?page=modifier" class="px-2 py-1 small">
                                <i class="bi bi-pen"></i> Modifier
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="d-block d-md-none">
                    <button class="btn btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav" aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list" style="font-size: 1.5rem;"></i>
                    </button>
                </div>
                <div class="collapse mobileNav" id="mobileNav">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="modele.php?page=accueil" class="d-block py-1 small">
                                <i class="bi bi-house-door"></i> Accueil
                            </a>
                        </li>
                        <li>
                            <a href="modele.php?page=rechercher" class="d-block py-1 small">
                                <i class="bi bi-search"></i> Rechercher
                            </a>
                        </li>
                        <li>
                            <a href="modele.php?page=infoEmploi" class="d-block py-1 small">
                                <i class="bi bi-info-circle"></i> Nos emplois
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
                <span class="copyright-text">ETU004155 - RAKOTOBE Joshua Riki</span>
            </div>
        </div>
    </footer>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>