<?php
$departementId = $_GET['departement'] ?? '';
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($page < 1) $page = 1;

$departement = getDepartementById($departementId);
$data = getDepartementEmployees($departementId, $page, 20);
$employes = $data['employees'];
$total = $data['total'];
$pages = ceil($total / 20);
?>
<section>
    <h1 class="text-center"><?= $departement['Departement'] ?> - <?= $departement['Numero'] ?></h1>
    <p class="text-center">Manager : <?= $departement['Manager'] ?></p>
    <h2>Employés : <?= formatNumber($total) ?></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Nom Complet</th>
                <th>Date d'embauche</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $employe) { ?>
                <tr>
                    <td><a href="modele.php?page=employe&emp_no=<?= $employe['emp_no'] ?>"><?= $employe['emp_no'] ?></a></td>
                    <td><?= $employe['full_name'] ?></td>
                    <td><?= date('d/m/Y', strtotime($employe['hire_date'])) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center flex-wrap gap-2 mt-3">
        <?php
        $range = 3; 
        $start = max(1, $page - $range);
        $end = min($pages, $page + $range);
        ?>

        <?php if ($page > 1) { ?>
            <a href="modele.php?page=departement&departement=<?= $departementId ?>&p=<?= $page - 1 ?>" class="btn btn-outline-secondary">«</a>
        <?php } ?>

        <?php for ($i = $start; $i <= $end; $i++) { ?>
            <a href="modele.php?page=departement&departement=<?= $departementId ?>&p=<?= $i ?>"
                class="btn <?= $i === $page ? 'btn-primary' : 'btn-outline-secondary' ?>">
                <?= $i ?>
            </a>
        <?php } ?>

        <?php if ($page < $pages) { ?>
            <a href="modele.php?page=departement&departement=<?= $departementId ?>&p=<?= $page + 1 ?>" class="btn btn-outline-secondary">»</a>
        <?php } ?>
    </div>

</section>