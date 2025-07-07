<?php require("../../includes/fonctions.php");

$idEmploye = $_POST['ID_Emp'];
$idDept = $_POST['ID_Dept'];
$dateDebut = $_POST['dateDebut'];

if (!valideDate($dateDebut)) {
    header("Location: ../modele.php?page=employe&emp_no=" . $idEmploye . "&error=1");
    exit();
}

if (!isAnterieur($dateDebut, $idDept)) {
    header("Location: ../modele.php?page=employe&emp_no=" . $idEmploye . "&error=2");
    exit();
}
