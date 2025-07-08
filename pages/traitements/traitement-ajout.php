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

    exit;
}
