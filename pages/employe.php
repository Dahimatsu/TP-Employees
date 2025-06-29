<?php 

    $cet_employe = getEmployeByno($_GET['emp_no']);
    $Job = thisJobDate($_GET['emp_no']);
    $nbTitles = count($Job);

?>


<section>
    <div class="row">
        <div class="card" style="width: 18rem;">
        <img src="../assets/images/default.jpg" class="card-img-top" alt="IMAGE">
        <div class="card-body">
            <h5 class="card-title"><strong><?php echo $cet_employe['last_name'];?> </strong><?php echo $cet_employe['first_name']; ?></h5>
            <p class="card-text"><?php echo $cet_employe['emp_no']; ?></p>
            <hr>
            <ul>
                <li class="cart-text"><?php echo $cet_employe['birth_date'];?></li>
                <li class="cart-text"><?php echo $cet_employe['gender'];?></li>
                <li class="cart-text"><?php echo $cet_employe['hire_date'];?></li>
            </ul>
        </div>
        </div>
    </div>
    <div class="row">
        <h2>L'historique de salaire et d'emploiement</h2>
        <?php for($i=$nbTitles-1; $i>=0; $i=$i-1) { ?>
            <h4>
                <strong><?php echo $Job[$i]['title'];?></strong>
                <?php if($Job[$i]['to_date'] == '9999-01-01') { ?>
                    (depuis <?php echo $Job[$i]['from_date'];?>)
                <?php }else{ ?>
                    (de <?php echo $Job[$i]['from_date'];?> à <?php echo $Job[$i]['to_date'];?> )
                <?php } ?>
            </h4>

            <?php 
            if($i+1 > 0 && $i+1 <= $nbTitles-1) {
                $salaire = thisSalarieDateJob2($Job[$i]['to_date'], $Job[$i+1]['to_date'], $cet_employe['emp_no']);
                $nb_salaire_thisJob = count($salaire);
            }else{
                $salaire = thisSalarieDate($Job[$i]['to_date'], $cet_employe['emp_no']);
                $nb_salaire_thisJob = count($salaire);
            }
            ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Salaire</th>
                    <th>De</th>
                    <th>À</th>
                </tr>
            </thead>
            <?php for($j=0; $j<$nb_salaire_thisJob; $j++) { ?>
                    <tbody>
                        <tr>
                            <td><?php echo $salaire[$j]['salary']; ?></td>
                            <td><?php echo $salaire[$j]['from_date']; ?></td>
                            <td><?php echo $salaire[$j]['to_date']; ?></td>
                        </tr>
                    </tbody>
                    <?php } ?>
            </table>
        <?php } ?>
    </div>
</section>