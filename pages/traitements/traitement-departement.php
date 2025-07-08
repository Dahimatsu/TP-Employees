<?php 
require("../../includes/fonctions.php");
$no_dept = getLastDeptNo() + 1;
$dept_name = $_POST['dept_name'];
addDept($no_dept, $dept_name);
header('Location: ../modele.php?page=ajouter&success=departement');
?>