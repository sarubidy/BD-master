<?php 
require("connection.php");

function aff_dep()
{
    $sql = "SELECT COUNT(dept_emp.emp_no) AS nombre, departments.dept_no, departments.dept_name, employees.first_name AS nom ,employees.last_name AS prenom FROM departments
    JOIN dept_manager ON departments.dept_no = dept_manager.dept_no
    JOIN employees ON employees.emp_no = dept_manager.emp_no
    JOIN dept_emp ON dept_emp.dept_no = departments.dept_no
    WHERE dept_manager.to_date = '9999-01-01'
    GROUP BY departments.dept_no
    ORDER BY departments.dept_name";
    $requette = mysqli_query(dbconnect(), $sql) ;
    return $requette;
}

function aff_liste_employer($numero,$n)
{
    $sql = "SELECT employees.gender,employees.birth_date AS anniv ,employees.emp_no AS numero ,employees.first_name, employees.last_name FROM employees
    JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
    JOIN departments ON departments.dept_no = dept_emp.dept_no
    WHERE dept_emp.dept_no = '$numero' LIMIT $n, 20";
    $requette = mysqli_query(dbconnect(), $sql);
    return $requette;

}

function sex_man($numero,$n) {
    $sql ="SELECT * FROM v_list  
    WHERE num = '$numero' AND gn  = 'M' LIMIT $n, 20";
    $requette = mysqli_query(dbconnect(), $sql);
        $result=[];
    while($donnees = mysqli_fetch_assoc($requette)){
        $result[]=$donnees;

    }
    return $result;

}

function count_man($num,$n) {
    $sql = "SELECT COUNT(*) AS total FROM employees
    JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
    JOIN departments ON departments.dept_no = dept_emp.dept_no
    WHERE dept_emp.dept_no = '$num' AND employees.gender = 'M'
    ";
    $requette = mysqli_query(dbconnect(), $sql);
    return $requette;
}

function sex_woman($numero,$n) {
    $sql ="SELECT * FROM v_list  
    WHERE num = '$numero' AND gn  = 'F' LIMIT $n, 20 ";
    $requette = mysqli_query(dbconnect(), $sql);
        $result=[];
    while($donnees = mysqli_fetch_assoc($requette)){
        $result[]=$donnees;

    }
    return $result;
}

function count_wom($num,$n) {
    $sql = "SELECT COUNT(*) AS total FROM employees
    JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
    JOIN departments ON departments.dept_no = dept_emp.dept_no
    WHERE dept_emp.dept_no = '$num' AND employees.gender = 'F' 
    ";
    $requette = mysqli_query(dbconnect(), $sql);
    return $requette;
}


function lien_employer() {
    $sql = "SELECT departments.dept_no, departments.dept_name, employees.first_name AS nom ,employees.last_name AS prenom FROM departments
    JOIN dept_manager ON departments.dept_no = dept_manager.dept_no
    JOIN employees ON employees.emp_no = dept_manager.emp_no
    WHERE dept_manager.to_date = '9999-01-01'
    GROUP BY departments.dept_no
    ORDER BY departments.dept_name";
    $requette = mysqli_query(dbconnect(), $sql) ;
        $result=[];
    while ($donnees = mysqli_fetch_assoc($requette)) {
        $result[] = $donnees;
    }
    return $result;
}

function get_id($numero,$n)
{
    $sql = "SELECT  departments.dept_name  AS id ,dept_emp.dept_no AS nam,employees.gender,employees.birth_date AS anniv ,employees.emp_no AS numero ,employees.first_name, employees.last_name FROM employees
    JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
    JOIN departments ON departments.dept_no = dept_emp.dept_no
    WHERE dept_emp.dept_no = '$numero' LIMIT $n, 20";
    $requette = mysqli_query(dbconnect(), $sql) ;
    return mysqli_fetch_assoc($requette );;   
}

function detail_employe($num)
{
    $sql = "SELECT employees.emp_no AS id,departments.dept_no,departments.dept_name ,employees.birth_date,employees.first_name,employees.last_name,employees.gender, employees.hire_date, titles.title FROM employees 
    JOIN titles ON titles.emp_no = employees.emp_no
    JOIN dept_emp ON employees.emp_no = dept_emp.emp_no 
    JOIN departments ON departments.dept_no = dept_emp.dept_no 
    WHERE employees.emp_no = '$num'
    ORDER  BY TIMESTAMPDIFF(YEAR,titles.from_date,titles.to_date) DESC
    LIMIT 1";
    $requette = mysqli_query(dbconnect(), $sql) ;
    return $requette;
}

function historique($num) {
    $sql = "SELECT 
                s.salary,
                s.from_date,
                s.to_date,
                t.title
            FROM salaries s
            LEFT JOIN titles t ON s.emp_no = t.emp_no
                AND (s.from_date BETWEEN t.from_date AND t.to_date
                     OR t.from_date BETWEEN s.from_date AND s.to_date)
            WHERE s.emp_no = $num
            ORDER BY s.from_date DESC";
    
    return mysqli_query(dbconnect(), $sql);
}

function aff_emp($nom, $dep, $min, $max, $n)
{
    $sql = "SELECT employees.gender,employees.birth_date AS anniv ,employees.emp_no AS numero ,employees.first_name, employees.last_name FROM employees
    JOIN dept_emp ON employees.emp_no = dept_emp.emp_no 
    JOIN departments ON departments.dept_no = dept_emp.dept_no 
    WHERE (
        employees.first_name LIKE '$nom%' 
        OR employees.last_name LIKE '$nom%' 
        OR employees.first_name LIKE '%$nom%' 
        OR employees.last_name LIKE '%$nom%' 
        OR employees.first_name LIKE '%$nom' 
        OR employees.last_name LIKE '%$nom'
    ) 
    AND TIMESTAMPDIFF(YEAR, employees.birth_date, NOW()) <= $max
    AND TIMESTAMPDIFF(YEAR, employees.birth_date, NOW()) >= $min
    AND dept_emp.dept_no = '$dep'
    GROUP BY employees.emp_no
    LIMIT $n, 20";
    $requette = mysqli_query(dbconnect(), $sql) ;
    return $requette;
}
/*debut*/
function change_dept($id_emp,$id_ancien,$id_nouveau,$date)
{
    $sql = "UPDATE dept_emp SET dept_no = '$id_nouveau' , from_date = '$date' 
    WHERE emp_no = $id_emp AND dept_no = '$id_ancien'";
    echo "<br>$sql<br>";
    $requette = mysqli_query(dbconnect(), $sql) ;
}

function aff_dep_non($var)
{
    $sql = "SELECT COUNT(dept_emp.emp_no) AS nombre, departments.dept_no, departments.dept_name, employees.first_name AS nom ,employees.last_name AS prenom FROM departments
    JOIN dept_manager ON departments.dept_no = dept_manager.dept_no
    JOIN employees ON employees.emp_no = dept_manager.emp_no
    JOIN dept_emp ON dept_emp.dept_no = departments.dept_no
    WHERE departments.dept_no != '$var'
    GROUP BY departments.dept_no
    ORDER BY departments.dept_name";
    $requette = mysqli_query(dbconnect(), $sql) ;
    return $requette;
}
function aff_dep_oui($var)
{
    $sql = "SELECT dept_emp.from_date,COUNT(dept_emp.emp_no) AS nombre, departments.dept_no, departments.dept_name, employees.first_name AS nom ,employees.last_name AS prenom FROM departments
    JOIN dept_manager ON departments.dept_no = dept_manager.dept_no
    JOIN employees ON employees.emp_no = dept_manager.emp_no
    JOIN dept_emp ON dept_emp.dept_no = departments.dept_no
    WHERE departments.dept_no = '$var'
    GROUP BY departments.dept_no
    ORDER BY departments.dept_name";
    $requette = mysqli_query(dbconnect(), $sql) ;
    return $requette;
}/*fin*/

?>
