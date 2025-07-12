<?php
require ("../includer/fonction.php");
$nom = $_GET['nom'];
$dep = $_GET['departement'];
if(!isset($_GET['min']))
{
    $min = $_GET['min'];
}else{$min=0;}
if(!isset($_GET['max']))
{
    $max = $_GET['max'];
}else{$max=200;}
$n = $_GET['n'];
$param = "nom=$nom&&departement=$dep&&min=$min&&max=$max";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body class="bg-black">
    <header>
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid" style="height: 50px;">
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white fw-bold" aria-current="page" href="index.php">ACCUEIL</a>
                        </li>
                    </ul>
                    <span class="navbar-text text-primary fw-bold fst-italic fs-3">
                        MADA PRO
                    </span>
                </div>
            </div>
        </nav>
    </header>
    <hr class="text-white">
    <div class="container">
        <h1 class="fs-2 text-center fw-bold text-white">Resulat pour <span class="ok"><?= $nom ?></span></h1>
    <table class="table table-bordered table-dark table-index">
        <thead class="table-dark">
            <tr>
                <th>Numero de l'employe</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Genre</th>
                <th>Date de naissance</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $result = aff_emp($nom,$dep,$min,$max,$n);
        while ($donne = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td class="fw-bold">
                <a href="employe.php?num=<?= urlencode($donne['numero']); ?>">
                    <?= $donne['numero']; ?>
                </a>
            </td>
            <td><?= $donne['first_name']; ?></td>
            <td><?= $donne['last_name']; ?></td>
            <td><?= ($donne['gender'] == 'M' ? 'Masculin' : 'Féminin'); ?></td>
            <td><?= $donne['anniv']; ?></td>
        </tr>
    <?php
        }
        mysqli_free_result($result);
    ?>
        </tbody>
    </table>
<div class="d-flex justify-content-between">
        <?php if($n >= 20){ ?>
            <a class="btn btn-success" href="traitement.php?<?= $param?>&&n=<?= ($n - 20); ?>"> < Precedents</a>
        <?php } else { ?>
            <span></span>
        <?php }if( mysqli_num_rows(aff_emp($nom,$dep,$min,$max,$n+20))!=0){ ?>
        <a class="btn btn-success" href="traitement.php?<?= $param?>&&n=<?= ($n + 20); ?>">Suivants ></a>
    <?php } ?></div>
    </div></body>
</html>