<?php
require ("../includer/fonction.php");
session_start();
$id=$_POST['id'];
$dt_from=$_POST['date-now'];
$dt_to=$_POST['date-aft'];
id_employe($id);

inscr($dt_from,$dt_to);

header("Location:index.php");
?>