<?php
$departements = getAllDepartments();
?>
<section>
    <h1 class="text-center">Liste des départements</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Departement</th>
                <th>Manager</th>
                <th>Nombre d'employés</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departements as $departement) { ?>
                <tr>
                    <td>
                        <a href="modele.php?page=departement&departement=<?= $departement['Numero'] ?>" class="text-decoration-none">
                            <?= $departement['Numero'] ?>
                        </a>
                    </td>
                    <td><?= $departement['Departement'] ?></td>
                    <td><?= $departement['Manager'] ?></td>
                    <td><?= formatNumber($departement['nb_employes']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>