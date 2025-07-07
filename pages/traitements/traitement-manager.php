<?php require("../../includes/fonctions.php");

$idEmploye = $_POST['ID_Emp'];
$idDept = $_POST['ID_Dept'];
$dateDebut = $_POST['dateDebut'];
$actualManager = getCurrentManager($idDept);

if (!valideDate($dateDebut)) {
    header("Location: ../modele.php?page=employe&emp_no=" . $idEmploye . "&error=1");
    exit();
}

if (!isAnterieur($dateDebut, $idDept)) {
    header("Location: ../modele.php?page=employe&emp_no=" . $idEmploye . "&error=2");
    exit();
}

if (becomeManager($idEmploye, $idDept, $dateDebut, $actualManager)) {
    header("Location: ../modele.php?page=employe&emp_no=" . $idEmploye . "&success");
}
