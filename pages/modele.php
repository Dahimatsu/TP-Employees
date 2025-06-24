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
        <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand fw-bold fs-4 text-primary" href="?page=accueil">
                    TJ Corporation
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="modele.php?page=accueil">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="modele.php?page=rechercher">Rechercher</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        <?php require($page . '.php'); ?>
    </main>

    <footer class="bg-light py-3 mt-auto text-center">
        <p class="mb-0">ETU004054 - RAVELOMANANTSOA Tony Mahefa</p>
        <p class="mb-0">ETU004054 - RAKOTOBE Joshua Riki</p>
        <p class="mb-0">&copy; 2025</p>
    </footer>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>