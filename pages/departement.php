<?php
    $departement = getDepartementById($_GET['departement']);
    $employes = getDepartementEmployees($_GET['departement']);
?> 
<section>
    <h1 class="text-center" ><?= $departement['Departement'] ?> - <?= $departement['Numero'] ?> </h1>
    <p class="text-center" >Manager : <?= $departement['Manager'] ?></p>
    <h2>Employés</h2>
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