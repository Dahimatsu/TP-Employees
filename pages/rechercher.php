<?php
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$departement = $_POST['departement'] ?? '';
$nom = $_POST['nom'] ?? '';
$age_min = $_POST['age_min'] ?? '';
$age_max = $_POST['age_max'] ?? '';

$resultats = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultats = searchEmployees($departement, $nom, $age_min, $age_max, $page);
    $employes = $resultats['employees'];
    $total = $resultats['total'];
    $pages = ceil($total / 20);
}
?>
<form action="modele.php?page=rechercher" method="post" class="container mt-4">
    <input type="hidden" name="page" value="1">
    <div class="mb-3">
        <label for="departement" class="form-label">Département :</label>
        <input type="text" id="departement" name="departement" class="form-control" value="<?= $departement ?>">
    </div>
    <div class="mb-3">
        <label for="nom" class="form-label">Nom de l'employé :</label>
        <input type="text" id="nom" name="nom" class="form-control" value="<?= $nom ?>">
    </div>
    <div class="mb-3">
        <label for="age_min" class="form-label">Âge minimum :</label>
        <input type="number" id="age_min" name="age_min" min="0" class="form-control" value="<?= $age_min ?>">
    </div>
    <div class="mb-3">
        <label for="age_max" class="form-label">Âge maximum :</label>
        <input type="number" id="age_max" name="age_max" min="0" class="form-control" value="<?= $age_max ?>">
    </div>
    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>

<?php if (!empty($resultats) && !empty($employes)) { ?>
    <div class="container mt-4">
        <h2>Résultats de la recherche (<?= $total ?> employés trouvés)</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Nom Complet</th>
                    <th>Date de naissance</th>
                    <th>Date d'embauche</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employes as $employe) { ?>
                    <tr>
                        <td><a href="modele.php?page=employe&emp_no=<?= $employe['emp_no'] ?>"><?= $employe['emp_no'] ?></a></td>
                        <td><?= $employe['full_name'] ?></td>
                        <td><?= date('d/m/Y', strtotime($employe['birth_date'])) ?></td>
                        <td><?= date('d/m/Y', strtotime($employe['hire_date'])) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-center gap-3 mt-3">
            <?php if ($page > 1) { ?>
                <form method="post">
                    <input type="hidden" name="page" value="<?= $page - 1 ?>">
                    <input type="hidden" name="departement" value="<?= $departement ?>">
                    <input type="hidden" name="nom" value="<?= $nom ?>">
                    <input type="hidden" name="age_min" value="<?= $age_min ?>">
                    <input type="hidden" name="age_max" value="<?= $age_max ?>">
                    <button type="submit" class="btn btn-secondary">Précédent</button>
                </form>
            <?php } ?>

            <?php if ($page < $pages) { ?>
                <form method="post">
                    <input type="hidden" name="page" value="<?= $page + 1 ?>">
                    <input type="hidden" name="departement" value="<?= $departement ?>">
                    <input type="hidden" name="nom" value="<?= $nom ?>">
                    <input type="hidden" name="age_min" value="<?= $age_min ?>">
                    <input type="hidden" name="age_max" value="<?= $age_max ?>">
                    <button type="submit" class="btn btn-secondary">Suivant</button>
                </form>
            <?php } ?>
        </div>
    </div>
<?php } elseif ($resultats !== null) { ?>
    <div class="container mt-4">
        <p>Aucun employé trouvé avec les critères spécifiés.</p>
    </div>
<?php } ?>