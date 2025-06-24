<?php 

    $cet_employe = getEmployeByno($_GET['emp_no']);

?>



<section>
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
</section>