<?php
require("../../includes/fonctions.php");

if (isset($_POST['ajouterEmploye'])) {
    $nom = $_POST['lastName'];
    ucfirst($nom);
    $prenom = $_POST['firstName'];
    ucfirst($prenom);
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
    $lastDeptNo = getLastDeptNo();
    $num = intval(substr($lastDeptNo, 1));
    $nextNum = $num + 1;
    $no_dept = 'd' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);
    $dept_name = $_POST['dept_name'];
    ucfirst($dept_name);

    if(!deptAlreadyExists($dept_name)) {
        addDept($no_dept, $dept_name);
    } else {
        header('Location: ../modele.php?page=ajouter&error=dept_exists');
        exit();
    }

    header('Location: ../modele.php?page=ajouter&success=departement');
}
