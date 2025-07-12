<?php
require ("../includer/fonction.php");
$num = $_POST['num'];
$ancien = $_POST['ancien'];
$nouveau = $_POST['nouveau'];
$date_a = $_POST['date_a'];
$date_b = $_POST['date_b'];
echo $num , " " , $ancien , " " , $nouveau ," ", "nouvelle date $date_b"," " , "ancienne date $date_a"," ";

if($date_b < $date_a)
{
   header("Location:changement_dept.php?num=$num&dep=$ancien&error=1"); 
}else{
    change_dept($num,$ancien,$nouveau,$date_b);
    header("Location:employe.php?num=$num");
}
?>