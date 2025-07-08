<?php

require("../../includes/fonctions.php");

    $newDept = $_POST['ls_dept'];
    $date = $_POST['date_deptChange'];
    $actuelleDate = $_POST['date_actuelDept'];
    $emp_no = $_POST['emp_no'];
    $allDept = getAllDepartments();

    if($date > $actuelleDate) {
        updateEmpDept($date, $emp_no);
        for($i=0; $i<count($allDept); $i++) {
            if($newDept == $allDept[$i]['Departement']) {
                $dept_no = $allDept[$i]['Numero'];
                insertNewEmpDept($emp_no, $dept_no, $date);
            }
        }
        header('Location: ../modele.php?page=employe&emp_no='. $emp_no);
    }
    if($date < $actuelleDate) {
        header('Location: ../modele.php?page=employe&emp_no='. $emp_no . '&erreurChangeDept=1');
    }




?>