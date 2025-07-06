<?php 

$pourHommes = emploiInfoM();
$pourFemmes = emploiInfoF();

?>

<section>
    <h1 class="text-center" >Information sur nos emplois</h1>
    <div class="row rowInfoEmploi">
        <div class="col-6">
            <h3 class="text-center titleInfoEmploi">Les employés hommes</h3>
            <table class="table table-striped">
                <tr>
                    <th>Emplois</th>
                    <th>Nombres d'employés</th>
                    <th>Salaire moyen</th>
                </tr>
                <?php for($i=0; $i<count($pourHommes); $i++) { ?>
                        <tr>
                            <td><?php echo $pourHommes[$i]['title']; ?></td>
                            <td><?php echo $pourHommes[$i]['nb_emp']; ?></td>
                            <td><?php echo $pourHommes[$i]['avgSalary']; ?></td>
                        </tr>
                <?php } ?>
            </table>
        </div>
        <div class="col-6">
            <h3 class="text-center titleInfoEmploi">Les employées femmes</h3>
            <table class="table table-striped">
                <tr>
                    <th>Emplois</th>
                    <th>Nombres d'employés</th>
                    <th>Salaire moyen</th>
                </tr>
                <?php for($i=0; $i<count($pourFemmes); $i++) { ?>
                        <tr>
                            <td><?php echo $pourFemmes[$i]['title']; ?></td>
                            <td><?php echo $pourFemmes[$i]['nb_emp']; ?></td>
                            <td><?php echo $pourFemmes[$i]['avgSalary']; ?></td>
                        </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</section>