<?php
if (isset($_POST['departement']) || isset($_POST['nom']) || isset($_POST['age_min']) || isset($_POST['age_max'])) {
    $departemet = $_POST['departement'];
    $nom = $_POST['nom'];
    $age_min = $_POST['age_min'];
    $age_max = $_POST['age_max'];

    $employes = searchEmployees($departemet, $nom, $age_min, $age_max);
}
?>
<form action="modele.php?page=rechercher" method="post" class="container mt-4">
    <div class="mb-3">
        <label for="departement" class="form-label">Département :</label>
        <input type="text" id="departement" name="departement" class="form-control">
    </div>
    <div class="mb-3">
        <label for="nom" class="form-label">Nom de l'employé :</label>
        <input type="text" id="nom" name="nom" class="form-control">
    </div>
    <div class="mb-3">
        <label for="age_min" class="form-label">Âge minimum :</label>
        <input type="number" id="age_min" name="age_min" min="0" class="form-control">
    </div>
    <div class="mb-3">
        <label for="age_max" class="form-label">Âge maximum :</label>
        <input type="number" id="age_max" name="age_max" min="0" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>
<?php if (isset($employes) && !empty($employes)) { ?>
    <div class="container mt-4">
        <h2>Résultats de la recherche</h2>
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
                        <td><?= $employe['emp_no'] ?></td>
                        <td><?= $employe['full_name'] ?></td>
                        <td><?= date('d/m/Y', strtotime($employe['birth_date'])) ?></td>
                        <td><?= date('d/m/Y', strtotime($employe['hire_date'])) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else if (isset($employes)) { ?>
    <div class="container mt-4">
        <p>Aucun employé trouvé avec les critères spécifiés.</p>
    </div>
<?php } ?>