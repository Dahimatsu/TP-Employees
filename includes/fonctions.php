<?php
require('connexion.php');

function getAllDepartments()
{
    $connect = dbconnect();
    $query = "SELECT d.dept_no Numero, d.dept_name Departement, CONCAT(e.first_name, ' ', e.last_name) Manager
              FROM departments d
              JOIN dept_manager dm ON d.dept_no = dm.dept_no
              JOIN employees e ON dm.emp_no = e.emp_no
              WHERE dm.to_date = '9999-01-01'
              ORDER BY d.dept_no";
    $result = mysqli_query($connect, $query);

    $departments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = $row;
    }

    mysqli_free_result($result);
    return $departments;
}

function getDepartementById($id)
{
    $connect = dbconnect();
    $query = "SELECT d.dept_no Numero, d.dept_name Departement, CONCAT(e.first_name, ' ', e.last_name) Manager
              FROM departments d
              JOIN dept_manager dm ON d.dept_no = dm.dept_no
              JOIN employees e ON dm.emp_no = e.emp_no
              WHERE dm.to_date = '9999-01-01'
              AND d.dept_no = '%s'";

    $query = sprintf($query, $id);
    $result = mysqli_query($connect, $query);
    $department = mysqli_fetch_assoc($result);

    return $department;
}

function getDepartementEmployees($id)
{
    $connect = dbconnect();
    $query = "SELECT e.emp_no, CONCAT(e.first_name, ' ', e.last_name) full_name, e.hire_date
              FROM employees e
              JOIN current_dept_emp de ON e.emp_no = de.emp_no
              WHERE de.dept_no = '%s'
              AND de.to_date = '9999-01-01'
              ORDER BY e.emp_no";

    $query = sprintf($query, $id);
    $result = mysqli_query($connect, $query);

    $employees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }

    mysqli_free_result($result);
    return $employees;
}

function getEmployeByno($emp_no) {
    $sql = "SELECT * FROM employees WHERE emp_no = '%s'";
    $sql = sprintf($sql, $emp_no);
    $sql_query = mysqli_query(dbconnect(), $sql);
    return mysqli_fetch_assoc($sql_query);
}

function searchEmployees($departement, $nom, $age_min, $age_max)
{
    $connect = dbconnect();
    $query = "SELECT e.emp_no, CONCAT(e.first_name, ' ', e.last_name) full_name, e.birth_date, e.hire_date
              FROM employees e
              JOIN current_dept_emp de ON e.emp_no = de.emp_no
              JOIN departments d ON de.dept_no = d.dept_no
              AND d.dept_name LIKE '%%%s%%%'
              OR (e.first_name LIKE '%%%s%%' OR e.last_name LIKE '%%%s%%')
              OR YEAR(CURDATE()) - YEAR(e.birth_date) >= '%s'
              OR YEAR(CURDATE()) - YEAR(e.birth_date) <= '%s'";

    $query = sprintf($query, $departement, $nom, $nom, (int)$age_min, (int)$age_max);
    $result = mysqli_query($connect, $query);

    $employees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }

    mysqli_free_result($result);
    return $employees;
}