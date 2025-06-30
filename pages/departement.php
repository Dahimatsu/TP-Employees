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
    <h1 class="text-center"><?= htmlspecialchars($departement['Departement']) ?> - <?= htmlspecialchars($departement['Numero']) ?></h1>
    <p class="text-center">Manager : <?= htmlspecialchars($departement['Manager']) ?></p>
    <h2>Employés : <?= $total ?></h2>
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
                    <td><?= htmlspecialchars($employe['full_name']) ?></td>
                    <td><?= date('d/m/Y', strtotime($employe['hire_date'])) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center gap-3 mt-3">
        <?php if ($page > 1): ?>
            <a href="modele.php?page=departement&departement=<?= urlencode($departementId) ?>&p=<?= $page - 1 ?>" class="btn btn-secondary">Précédent</a>
        <?php endif; ?>
        <?php if ($page < $pages): ?>
            <a href="modele.php?page=departement&departement=<?= urlencode($departementId) ?>&p=<?= $page + 1 ?>" class="btn btn-secondary">Suivant</a>
        <?php endif; ?>
    </div>
</section>