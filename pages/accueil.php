<?php
$departements = getAllDepartments();
?>
<section>
    <h1>Liste des départements</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Departement</th>
                <th>Manager</th>
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
                    <td>
                        <a href="modele.php?page=departement&departement=<?= $departement['Numero'] ?>" class="text-decoration-none">
                            <?= $departement['Departement'] ?>
                        </a>
                    </td>
                    <td><?= $departement['Manager'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>