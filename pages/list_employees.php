<?php
require ("../includer/fonction.php");
$num = $_GET['num'];
$n = $_GET['n'];
$id = get_id($num, $n);
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
    <div class="container mt-4">
        <div class="row bg-dark vh-100">  
            <div class="col-md-2 table-index"> 
                <h2 class="text-white mt-4">Genre</h2>                 
                <div class="card border-success fw-bold" style="width: 10rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-dark"><a href="man.php?num=<?= $id['nam'] ?>&n=0">HOMMES</a></li>
                        <li class="list-group-item bg-dark"><a href="wom.php?num=<?= $id['nam'] ?>&n=0">FEMMES</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 text-white py-4">   
                <h1 class="fs-2 bg-dark text-white rounded fw-bold text-center shadow"> Liste des Employées mixte dans le département <span class="ok"><?= $id['id']; ?></span></h1>             
                <div class="table-responsive mt-4">
                    <table class="table table-dark table-sm table-index">
                        <thead class="table-dark">
                            <tr>
                                <th>Numero de l'employé</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Genre</th>
                                <th>Date de naissance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $retour = aff_liste_employer($num, $n);
                            while ($donne = mysqli_fetch_assoc($retour)) {
                            ?>
                                <tr>
                                    <td>
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
                            mysqli_free_result($retour);
                            ?>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between">
                        <?php if($n >= 20) { ?>
                            <a class="btn btn-success" href="list_employees.php?num=<?= $num; ?>&n=<?= ($n - 20); ?>"> < Precedents</a>
                        <?php } else { ?>
                            <span></span>
                        <?php } ?>

                        <?php if(mysqli_num_rows(aff_liste_employer($num, $n + 20)) != 0) { ?>
                            <a class="btn btn-success" href="list_employees.php?num=<?= $num; ?>&n=<?= ($n + 20); ?>">Suivants ></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
