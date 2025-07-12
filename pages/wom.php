<?php 
require ("../includer/fonction.php");
$num=$_GET['num'];
$n = $_GET['n'];
$aff=sex_woman($num,$n);
$id = get_id($num, $n);
$count=count_wom($num,$n);
$nbr = mysqli_fetch_assoc($count);
$total = $nbr['total'];
?>

<!DOCTYPE html>
<html lang="en">
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
    <div class="container mt-4">
                <div class="table-responsive">
                    <div class="fs-2 bg-dark text-white rounded fw-bold text-start">
                        <h1>Liste des Employées Femme dans le département <span class="ok"><?= $id['id']; ?></span> </h1>
                        <h3 class="text-end">Total : <?= $total; ?></3>
                    </div>
                    <table class="table table-dark table-sm table-index mt-4">
                        <thead class="table-dark">
                            <tr>
                                <th>Numero de l'employée</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Genre</th>
                                <th>Date de naissance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($aff as $donne) {
                            ?>
                                <tr>
                                    <td>
                                        <a href="employe.php?num=<?= urlencode($donne['numero']); ?>">
                                            <?= $donne['numero']; ?>
                                        </a>
                                    </td>
                                    <td><?= $donne['first_name']; ?></td>
                                    <td><?= $donne['last_name']; ?></td>
                                    <td><?= $donne['gn']; ?></td>
                                    <td><?= $donne['anniv']; ?></td>
                                </tr>
                            <?php }  ?>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between">
                        <?php if($n >= 20) { ?>
                            <a class="btn btn-success" href="wom.php?num=<?= $num; ?>&n=<?= ($n - 20); ?>"> < Precedents</a>
                        <?php } else { ?>
                            <span></span>
                        <?php } ?>

                         <?php if(mysqli_num_rows(aff_liste_employer($num, $n + 20)) != 0) { ?>
                            <a class="btn btn-success" href="wom.php?num=<?= $num; ?>&n=<?= ($n + 20); ?>">Suivants ></a>
                        <?php } ?>
                    </div>
                </div>
    </div>
</body>
</html>