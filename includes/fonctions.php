<?php
require('connexion.php');

function getAllDepartments()
{
    $connect = dbconnect();
    $query = "SELECT * 
              FROM v_departement";
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
    $query = "SELECT * 
              FROM v_departement
              WHERE Numero = '%s'";

    $query = sprintf($query, $id);
    $result = mysqli_query($connect, $query);
    $department = mysqli_fetch_assoc($result);

    return $department;
}

function getDepartementEmployees($id, $page = 1, $limit = 20)
{
    $connect = dbconnect();

    $offset = ($page - 1) * $limit;

    $countQuery = "SELECT COUNT(*) AS total
                   FROM current_dept_emp
                   WHERE dept_no = '%s' 
                   AND to_date = '9999-01-01'";

    $countQuery = sprintf($countQuery, $id);
    $countResult = mysqli_query($connect, $countQuery);
    $total = mysqli_fetch_assoc($countResult)['total'];
    mysqli_free_result($countResult);

    $query = "SELECT e.emp_no, CONCAT(e.first_name, ' ', e.last_name) AS full_name, e.hire_date
              FROM employees e
              JOIN current_dept_emp de ON e.emp_no = de.emp_no
              WHERE de.dept_no = '%s'
              AND de.to_date = '9999-01-01'
              ORDER BY e.emp_no
              LIMIT %d OFFSET %d";

    $query = sprintf($query, $id, $limit, $offset);
    $result = mysqli_query($connect, $query);

    $employees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }

    mysqli_free_result($result);

    return [
        'total' => $total,
        'employees' => $employees
    ];
}


function getEmployeByno($emp_no)
{
    $sql = "SELECT * FROM employees WHERE emp_no = '%s'";
    $sql = sprintf($sql, $emp_no);
    $sql_query = mysqli_query(dbconnect(), $sql);
    return mysqli_fetch_assoc($sql_query);
}

function searchEmployees($departement, $nom, $age_min, $age_max, $page = 1)
{
    $connect = dbconnect();

    $baseQuery = "FROM employees e
                  LEFT JOIN current_dept_emp de ON e.emp_no = de.emp_no
                  LEFT JOIN departments d ON de.dept_no = d.dept_no
                  WHERE 1=1";

    $params = [];
    $condition = "";

    if (!empty($departement)) {
        $condition .= " AND d.dept_name LIKE '%%%s%%'";
        $params[] = $departement;
    }

    if (!empty($nom)) {
        $condition .= " AND (e.first_name LIKE '%%%s%%' OR e.last_name LIKE '%%%s%%')";
        $params[] = $nom;
        $params[] = $nom;
    }

    if (!empty($age_min)) {
        $condition .= " AND (YEAR(CURDATE()) - YEAR(e.birth_date)) >= %d";
        $params[] = (int)$age_min;
    }

    if (!empty($age_max)) {
        $condition .= " AND (YEAR(CURDATE()) - YEAR(e.birth_date)) <= %d";
        $params[] = (int)$age_max;
    }

    $countQuery = "SELECT COUNT(*) AS total " . $baseQuery . $condition;
    if (!empty($params)) {
        $countQuery = vsprintf($countQuery, $params);
    }

    $countResult = mysqli_query($connect, $countQuery);
    $total = mysqli_fetch_assoc($countResult)['total'];
    mysqli_free_result($countResult);

    $limit = 20;
    $offset = ($page - 1) * $limit;

    $mainQuery = "SELECT e.emp_no, CONCAT(e.first_name, ' ', e.last_name) AS full_name, e.birth_date, e.hire_date "
        . $baseQuery . $condition . " ORDER BY e.emp_no LIMIT $offset, $limit";

    if (!empty($params)) {
        $mainQuery = vsprintf($mainQuery, $params);
    }

    $result = mysqli_query($connect, $mainQuery);
    $employees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
    mysqli_free_result($result);

    return [
        'total' => $total,
        'employees' => $employees
    ];
}

function thisJobDate($emp_no)
{
    $sql = "SELECT * 
            FROM titles 
            WHERE emp_no = '%s'";
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
    $sql = "SELECT * 
            FROM salaries 
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

function formatSalaire($salaire)
{
    $formatted = number_format($salaire, 2, ',', ' ');
    return $formatted . ' €';
}

function formatNumber($number)
{
    return number_format($number, 0, ',', ' ');
}

function longestJob($emp_no)
{
    $sql = "SELECT title, DATEDIFF(to_date, from_date) AS duree
            FROM titles
            WHERE emp_no = %d
            AND to_date != '9999-01-01'
            ORDER BY duree DESC
            LIMIT 1";
    $sql = sprintf($sql, (int)$emp_no);
    $sql_query = mysqli_query(dbconnect(), $sql);
    return mysqli_fetch_assoc($sql_query);
}


function isCDI($emp_no)
{
    $sql = "SELECT COUNT(*) AS count
            FROM titles
            WHERE emp_no = %d
            AND to_date = '9999-01-01'";
    $sql = sprintf($sql, (int)$emp_no);
    $sql_query = mysqli_query(dbconnect(), $sql);
    $result = mysqli_fetch_assoc($sql_query);

    return $result['count'] > 0;
}


function dayToYear($day)
{
    $year = floor($day / 365);
    $remainingDays = $day % 365;
    return sprintf("%d an(s) et %d jour(s)", $year, $remainingDays);
}

function getEmployeeDept($emp_no)
{
    $sql = "SELECT dept_no
            FROM v_employes
            WHERE emp_no = '%s'";
    $sql = sprintf($sql, $emp_no);
    $sql_query = mysqli_query(dbconnect(), $sql);
    $departments = mysqli_fetch_assoc($sql_query);

    return $departments['dept_no'] ?? null;
}

function emploiInfoM() 
{
    $sql = "SELECT count(emp_no) as nb_emp, title, avgSalary FROM emploiInfo
            WHERE gender = '%s'
            GROUP BY title";
    $sql = sprintf($sql, 'M');
    $sql_query = mysqli_query(dbconnect(), $sql);
    $result = array();
    while($row = mysqli_fetch_assoc($sql_query)) {
        $result[] = $row;
    }
    return $result;
}

function emploiInfoF() 
{
    $sql = "SELECT count(emp_no) as nb_emp, title, avgSalary FROM emploiInfo
            WHERE gender = '%s'
            GROUP BY title";
    $sql = sprintf($sql, 'F');
    $sql_query = mysqli_query(dbconnect(), $sql);
    $result = array();
    while($row = mysqli_fetch_assoc($sql_query)) {
        $result[] = $row;
    }
    return $result;
}

function dept_emp($emp_no)
{
    $sql = "SELECT dept_name, from_date
            FROM v_empDept
            WHERE emp_no = '%s' AND to_date = '%s'";
    $sql = sprintf($sql, $emp_no, '9999-01-01');
    $sql_query = mysqli_query(dbconnect(), $sql);
    $result = mysqli_fetch_assoc($sql_query);
    return $result;
}

function choixDept($deptActuel) 
{
    $sql = "SELECT dept_name
            FROM departments
            WHERE dept_name NOT IN('%s')";
    $sql = sprintf($sql, $deptActuel);
    $sql_query = mysqli_query(dbconnect(), $sql);
    $result = array();
    while($row = mysqli_fetch_assoc($sql_query)) {
        $result[] = $row;
    }
    return $result;
}