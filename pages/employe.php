<?php

$cet_employe = getEmployeByno($_GET['emp_no']);
$Job = thisJobDate($_GET['emp_no']);
$longestJob = longestJob($_GET['emp_no']);
$nbTitles = count($Job);
$departement = getEmployeeDept($_GET['emp_no']);
?>

<section class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="modele.php?page=departement&departement=<?= $departement ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <?php if (isset($_POST['becomeManager']) || isset($_GET['error'])) { ?>
        <h1 class="text-center mb-1">Devenir Manager</h1>
        <div class="d-flex justify-content-center">
            <form action="traitements/traitement-manager.php" method="POST" class="text-center">
                <input type="hidden" name="ID_Emp" value="<?= $cet_employe['emp_no'] ?>">
                <input type="hidden" name="ID_Dept" value="<?= $departement ?>">
                <label for="dateDebut" class="form-label">Date de début :</label>
                <input type="date" id="dateDebut" name="dateDebut" class="form-control" value="">
                <div class="mt-3">
                    <input type="submit" name="toManage" value="Devenir Manager" class="btn btn-primary ms-2">
                    <a href="?emp_no=<?= $cet_employe['emp_no'] ?>&page=employe" class="btn btn-danger">Annuler</a>
                </div>
            </form>
        </div>
        <div>
            <?php if (isset($_GET['error'])) {
                $error = $_GET['error']; ?>
                <div class="alert alert-danger mt-3 p-2 text-center" style="font-size:0.95em;">
                    <?php if ($error == 1) { ?>
                        Date invalide
                    <?php } elseif ($error == 2) { ?>
                        Date trop ancienne
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success mt-3 p-2 text-center" style="font-size:0.95em;">
            Changement de Manager effectué avec succès !
        </div>
    <?php } ?>

    <?php if(isset($_POST['changeDept'])) { ?>
        <h1 class="text-center mb-1">Changer de departement</h1>
        <div class="justify-content-center">
            <p class="text-center">
                Actuellement il se trouve dans : <strong><?php echo dept_emp($cet_employe['emp_no'])['dept_name']; ?></strong>
                depuis <strong><?php echo dept_emp($cet_employe['emp_no'])['from_date']; ?></strong>
            </p>
            <?php
            $choixDept = choixDept(dept_emp($cet_employe['emp_no'])['dept_name']);
            $nb_choiDept = count($choixDept);
            ?>
            <form action="traitements/traitement-changeDept.php" method="POST" class="text-center">
                <div class="row">
                    <div class="col-4">
                        <select id="ls_dept" name="ls_dept">
                            <?php for($i=0; $i<$nb_choiDept; $i++) { ?>
                                <option value="<?php echo $choixDept[$i]['dept_name'] ?>"><?php echo $choixDept[$i]['dept_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="date" name="date_deptChange">
                        <input type="hidden" name="date_actuelDept" value="<?php echo dept_emp($cet_employe['emp_no'])['from_date'] ?>">
                    </div>
                    <div class="col-4">
                        <input type="hidden" name="emp_no" value="<?php echo $cet_employe['emp_no'];?>">
                        <input type="submit" value="Valider">
                    </div>
                </div>
            </form>
        </div>
        <hr>
    <?php } ?>


    <h1 class="text-center mb-1 mt-5">Informations sur l'employé</h1>
    <div class="row emp">
        <div class="col-md-5 mb-4">
            <div class="card">
                <img src="../assets/images/default.jpg" class="card-img-top" alt="IMAGE">
                <div class="card-body">
                    <h5 class="card-title">
                        <strong><?php echo $cet_employe['last_name']; ?></strong> <?php echo $cet_employe['first_name']; ?>
                    </h5>
                    <p class="card-text">Matricule:
                        <strong>
                            <?php echo $cet_employe['emp_no']; ?>
                        </strong>
                    </p>
                    <?php if (!empty($longestJob)) { ?>
                        <p class="card-text">
                            Emploi le plus long :
                            <strong><?= $longestJob['title']; ?> - <?= dayToYear($longestJob['duree']); ?></strong>
                        </p>
                    <?php } ?>
                    <?php if (isManager($cet_employe['emp_no'], $departement)) { ?>
                        <p class="card-text text-success">
                            <i class="bi bi-award"></i>
                            <strong>Manager du département</strong>
                        </p>
                    <?php } ?>

                    <div class="d-flex gap-2 mb-3 changer">
                        <?php if (!isset($_POST['becomeManager']) && !isset($_GET['error']) && !isManager($cet_employe['emp_no'], $departement)) { ?>
                            <form method="post" class="m-0">
                                <input type="submit" class="btn btn-secondary" name="becomeManager" value="Devenir Manager">
                            </form>
                        <?php } ?>

                        <?php if (!isset($_POST['changeDept'])) { ?>
                            <form method="post" class="m-0">
                                <input type="submit" class="btn btn-secondary" name="changeDept" value="Changer de departement">
                            </form>
                        <?php } ?>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-calendar-date"></i> Date de Naissance:
                            <strong>
                                <?php echo $cet_employe['birth_date']; ?>
                            </strong>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-gender-ambiguous"></i> Genre:
                            <strong>
                                <?php echo ($cet_employe['gender'] === 'M') ? 'Homme' : (($cet_employe['gender'] === 'F') ? 'Femme' : 'Inconnu'); ?>
                            </strong>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-briefcase"></i> Date d'embauche:
                            <strong>
                                <?php echo $cet_employe['hire_date']; ?>
                            </strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <h2 class="mb-4">L'historique de salaire et d'emploiement</h2>
            <?php for ($i = $nbTitles - 1; $i >= 0; $i--) { ?>
                <div class="mb-4">
                    <h4>
                        <strong><?php echo $Job[$i]['title']; ?></strong>
                        <?php if ($Job[$i]['to_date'] == '9999-01-01') { ?>
                            - depuis <?php echo $Job[$i]['from_date']; ?></span>
                        <?php } else { ?>
                            - de <?php echo $Job[$i]['from_date']; ?> à <?php echo $Job[$i]['to_date']; ?></span>
                        <?php } ?>
                    </h4>
                    <?php
                    if ($i + 1 > 0 && $i + 1 <= $nbTitles - 1) {
                        $salaire = thisSalarieDateJob2($Job[$i]['to_date'], $Job[$i + 1]['to_date'], $cet_employe['emp_no']);
                        $nb_salaire_thisJob = count($salaire);
                    } else {
                        $salaire = thisSalarieDate($Job[$i]['to_date'], $cet_employe['emp_no']);
                        $nb_salaire_thisJob = count($salaire);
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Salaire</th>
                                    <th>De</th>
                                    <th>À</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($j = 0; $j < $nb_salaire_thisJob; $j++) { ?>
                                    <tr>
                                        <td><?php echo formatSalaire($salaire[$j]['salary']); ?></td>
                                        <td><?php echo $salaire[$j]['from_date']; ?></td>
                                        <td><?php echo $salaire[$j]['to_date']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>