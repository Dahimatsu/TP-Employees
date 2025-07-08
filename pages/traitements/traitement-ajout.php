<?php
require("../../includes/fonctions.php");

if (isset($_POST['ajouterEmploye'])) {
    $nom = $_POST['lastName'];
    $prenom = $_POST['firstName'];
    $dateNaissance = $_POST['birthDate'];
    $sexe = $_POST['sex'];
    if ($sexe === 'Homme') {
        $sexe = 'M';
    } elseif ($sexe === 'Femme') {
        $sexe = 'F';
    }
    $id = getLastEmpNo() + 1;

    insertNewEmployee($id, $nom, $prenom, $dateNaissance, $sexe);
    header("Location: ../modele.php?page=ajouter&success=employe");
}

if (isset($_POST['ajouterDepartement'])) {
    $no_dept = getLastDeptNo() + 1;
    $dept_name = $_POST['dept_name'];
    addDept($no_dept, $dept_name);

    header('Location: ../modele.php?page=ajouter&success=departement');
}
