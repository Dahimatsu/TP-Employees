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

function getEmployeByno($emp_no)
{
    $sql = "SELECT * FROM employees WHERE emp_no = '%s'";
    $sql = sprintf($sql, $emp_no);
    $sql_query = mysqli_query(dbconnect(), $sql);
    return mysqli_fetch_assoc($sql_query);
}

function searchEmployees($departement, $nom, $age_min, $age_max)
{
    $connect = dbconnect();

    $query = "SELECT e.emp_no, CONCAT(e.first_name, ' ', e.last_name) AS full_name, e.birth_date, e.hire_date
              FROM employees e
              LEFT JOIN current_dept_emp de ON e.emp_no = de.emp_no
              LEFT JOIN departments d ON de.dept_no = d.dept_no
              WHERE 1=1";

    $params = [];

    if (!empty($departement)) {
        $query .= " AND d.dept_name LIKE '%%%s%%'";
        $params[] = mysqli_real_escape_string($connect, $departement);
    }

    if (!empty($nom)) {
        $query .= " AND (e.first_name LIKE '%%%s%%' OR e.last_name LIKE '%%%s%%')";
        $nom_esc = mysqli_real_escape_string($connect, $nom);
        $params[] = $nom_esc;
        $params[] = $nom_esc;
    }

    if (!empty($age_min)) {
        $query .= " AND (YEAR(CURDATE()) - YEAR(e.birth_date)) >= %d";
        $params[] = (int)$age_min;
    }

    if (!empty($age_max)) {
        $query .= " AND (YEAR(CURDATE()) - YEAR(e.birth_date)) <= %d";
        $params[] = (int)$age_max;
    }

    $query .= " ORDER BY e.emp_no LIMIT 20";

    if (!empty($params)) {
        $query = vsprintf($query, $params);
    }

    $result = mysqli_query($connect, $query);
    $employees = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }

    mysqli_free_result($result);
    return $employees;
}



function thisJobDate($emp_no)
{
    $sql = "SELECT * FROM titles WHERE emp_no = '%s'";
    $sql = sprintf($sql, $emp_no);
    $sql_query = mysqli_query(dbconnect(), $sql);
    $result = array();
    while ($row = mysqli_fetch_assoc($sql_query)) {
        $result[] = $row;
    }
    return $result;
}

function thisSalarieDate($to_date, $emp_no)
{
    $sql = "SELECT * FROM salaries 
    WHERE to_date <= '%s'
    AND emp_no = '%s'";
    $sql = sprintf($sql, $to_date, $emp_no);
    $sql_query = mysqli_query(dbconnect(), $sql);
    $result = array();
    while ($row = mysqli_fetch_assoc($sql_query)) {
        $result[] = $row;
    }
    return $result;
}

function thisSalarieDateJob2($to_date, $to_date_old, $emp_no)
{
    $sql = "SELECT * FROM salaries 
    WHERE to_date <= '%s'
    AND from_date >= '%s'
    AND emp_no = '%s'";
    $sql = sprintf($sql, $to_date, $to_date_old, $emp_no);
    $sql_query = mysqli_query(dbconnect(), $sql);
    $result = array();
    while ($row = mysqli_fetch_assoc($sql_query)) {
        $result[] = $row;
    }
    return $result;
}


/*
test
SELECT * FROM titles WHERE emp_no = 499998; 
SELECT * FROM salaries WHERE emp_no = 499998;

SELECT * FROM salaries 
WHERE AND to_date < '2000-08-03'
AND
    AND emp_no = '10017';
    10017




SELECT * FROM salaries 
    WHERE to_date <= '9999-01-01'
    AND from_date >= '2000-08-03'
    AND emp_no = '10017'


    SELECT e.emp_no, CONCAT(e.first_name, ' ', e.last_name) full_name, e.birth_date, e.hire_date
              FROM employees e
              JOIN current_dept_emp de ON e.emp_no = de.emp_no
              JOIN departments d ON de.dept_no = d.dept_no
              AND d.dept_name LIKE 'Marketing'
              OR (e.first_name LIKE 'Bo' OR e.last_name LIKE 'Bo')
              OR YEAR(CURDATE()) - YEAR(e.birth_date) >= 1
              OR YEAR(CURDATE()) - YEAR(e.birth_date) <= 80
              LIMIT 20;
*/