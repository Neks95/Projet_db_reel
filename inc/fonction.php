<?php
require("connexion.php");

function getDept()
{
    $query = "SELECT * FROM departments ORDER BY dept_name ASC";
    $requete = mysqli_query(bdconnect(), $query);
    $departement = [];
    while ($temp = mysqli_fetch_assoc($requete)) {
        $departement[] = $temp;
    }
    return $departement;
}

function getManager()
{
    $query = "SELECT d.dept_no, d.dept_name, e.first_name, e.last_name, 
                     (SELECT COUNT(*) FROM dept_emp de WHERE de.dept_no = d.dept_no) AS nb_employes
              FROM departments d
              JOIN dept_manager dm ON d.dept_no = dm.dept_no
              JOIN employees e ON dm.emp_no = e.emp_no
              WHERE dm.to_date = '9999-01-01'
              ORDER BY d.dept_name ASC";
    $requete = mysqli_query(bdconnect(), $query);
    $departement = [];
    while ($temp = mysqli_fetch_assoc($requete)) {
        $departement[] = $temp;
    }
    return $departement;
}

function getEmp($idd,$limite)
{
    $query = "SELECT e.*, de.dept_name 
              FROM dept_emp d 
              JOIN employees e ON d.emp_no = e.emp_no 
              JOIN departments de ON d.dept_no = de.dept_no 
              WHERE d.dept_no = '%s'
               LIMIT %d, 20";
    $query = sprintf($query, $idd,$limite);
    $requete = mysqli_query(bdconnect(), $query);
    $emp = [];
    while ($temp = mysqli_fetch_assoc($requete)) {
        $emp[] = $temp;
    }
    return $emp;
}


function get_info_emp($emp_no)
{
    $requete = "SELECT * FROM employees e
                JOIN dept_emp de ON e.emp_no = de.emp_no JOIN departments d ON de.dept_no = d.dept_no WHERE e.emp_no = '%s'";
    $requete = sprintf($requete, $emp_no);
    $donnees = mysqli_query(bdconnect(), $requete);
    $result = mysqli_fetch_assoc($donnees);
    return $result;
}



function getSalaire($ide)
{
    $requete = "SELECT * FROM salaries where emp_no = '%s' ";
    $requete = sprintf($requete, $ide);
    $result = mysqli_query(bdconnect(), $requete);
    $sal = [];
    while ($temp = mysqli_fetch_assoc($result)) {
        $sal[] = $temp;
    }
    return $sal;
}

function salaireActuel($emp_no)
{
    $requete = "SELECT * FROM salaries where emp_no = '%s' AND to_date = '9999-01-01'";
    $requete = sprintf($requete, $emp_no);
    $result = mysqli_query(bdconnect(), $requete);
    $sal = [];
    while ($temp = mysqli_fetch_assoc($result)) {
        $sal[] = $temp;
    }
    return $sal;

}

function getTitre($ide)
{
    $requete = "SELECT  * FROM titles where emp_no = '%s'";
    $requete = sprintf($requete, $ide);
    $result = mysqli_query(bdconnect(), $requete);
    $ti = [];
    while ($temp = mysqli_fetch_assoc($result)) {
        $ti[] = $temp;
    }
    return $ti;
}

function titreActuel($ide)
{
    $requete = "SELECT  * FROM titles where emp_no = '%s' AND to_date = '9999-01-01'";
    $requete = sprintf($requete, $ide);
    $result = mysqli_query(bdconnect(), $requete);
    $ti = [];
    while ($temp = mysqli_fetch_assoc($result)) {
        $ti[] = $temp;
    }
    return $ti;

}

function rechercher($dep, $nom, $max, $min,$limite)
{
    $valiny = [];
    if ($dep == "tous") {
        $sql = "
            SELECT e.emp_no, e.first_name, e.last_name, e.birth_date, d.dept_name
            FROM employees e
            JOIN dept_emp de ON e.emp_no = de.emp_no
            JOIN departments d ON d.dept_no = de.dept_no
            WHERE  1=1
            AND e.first_name LIKE '%%%s%%'
            AND TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) BETWEEN %d AND %d
            LIMIT %d,20
        ";
    
        $sql = sprintf($sql,  $nom, $min, $max,$limite);
    
        $result = mysqli_query(bdconnect(), $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $valiny[] = $row;
        }
    }
    else {
        $sql = "
            SELECT e.emp_no, e.first_name, e.last_name, e.birth_date, d.dept_name
            FROM employees e
            JOIN dept_emp de ON e.emp_no = de.emp_no
            JOIN departments d ON d.dept_no = de.dept_no
            WHERE  1=1
            AND d.dept_name LIKE '%%%s%%' AND
            e.first_name LIKE '%%%s%%'
            AND TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) BETWEEN %d AND %d
            LIMIT %d,20
        ";
    
        $sql = sprintf($sql, $dep, $nom, $min, $max,$limite);
    
        $result = mysqli_query(bdconnect(), $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $valiny[] = $row;
        }
        
    }
    return $valiny;
}

function rechercherCount($dep, $nom, $max, $min)
{
    if ($dep == "tous") {
        $sql = "
            SELECT COUNT(*) as total
            FROM employees e
            JOIN dept_emp de ON e.emp_no = de.emp_no
            JOIN departments d ON d.dept_no = de.dept_no
            WHERE 1=1
            AND e.first_name LIKE '%%%s%%'
            AND TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) BETWEEN %d AND %d
        ";
        $sql = sprintf($sql, $nom, $min, $max);
    } else {
        $sql = "
            SELECT COUNT(*) as total
            FROM employees e
            JOIN dept_emp de ON e.emp_no = de.emp_no
            JOIN departments d ON d.dept_no = de.dept_no
            WHERE 1=1
            AND d.dept_name LIKE '%%%s%%'
            AND e.first_name LIKE '%%%s%%'
            AND TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) BETWEEN %d AND %d
        ";
        $sql = sprintf($sql, $dep, $nom, $min, $max);
    }

    $result = mysqli_query(bdconnect(), $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function countEmp($idd)
{
    $query = "SELECT COUNT(*) as total FROM dept_emp WHERE dept_no = '%s'";
    $query = sprintf($query, $idd);
    $requete = mysqli_query(bdconnect(), $query);
    $result = mysqli_fetch_assoc($requete);
    return $result['total'];
}

?>