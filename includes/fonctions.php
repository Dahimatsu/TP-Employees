<?php
require('includes/connexion.php');

function getAllDepartments()
{
    $connect = dbconnect();
    $query = "SELECT * FROM departments";
    $result = mysqli_query($connect, $query);

    $departments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = $row;
    }

    mysqli_free_result($result);
    return $departments;
}
