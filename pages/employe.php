<?php
require ("../includer/fonction.php");
$num = $_GET['num'];
$det = detail_employe($num);
$history = historique($num);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <title>Documet</title>
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
    <div class="container bg-dark mt-4">
    <h1 class="fs-2 text-white fw-bold text-center">Detail de l'employe</h1>
<div class="row ">
    <?php
        while($donne_det = mysqli_fetch_assoc($det)) { ?>
    <div class="card mx-auto mt-4" style="max-width: 40rem;">
        <div class="row g-0 align-items-center">

            <div class="col-md-4 text-center">
                <img src="../assets/images/profil.jpg" class="img-fluid rounded-circle mt-3" style="width: 100px; height: 100px;">
                     <h5 class="card-title fs-5 fs-4 mt-2"><?= $donne_det['first_name']; ?></h5>
            </div>
<div class="col-md-8 p-3">
    <h5 class="mb-3 fw-bold text-success">Edit Profile</h5>
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center fs-5 fst-italic">
            <strong>Nom :</strong><?=$donne_det['first_name']; ?>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center fs-5 fst-italic">
            <strong>Prénom :</strong><?=$donne_det['last_name']; ?>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center fs-5 fst-italic">
            <strong>Date de naissance :</strong><?= date('d M Y', strtotime($donne_det['birth_date'])); ?>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center fs-5 fst-italic">
            <strong>Genre :</strong><?php if($donne_det['gender'] == 'M'){echo 'Masculin';}else{echo 'Feminin';}?>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center fs-5 fst-italic">
            <strong>Date d'embauche :</strong><?= date('d M Y', strtotime($donne_det['hire_date'])); ?>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center fs-5 fst-italic">
            <strong>Département:</strong><?= $donne_det['dept_name']; ?>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center fs-5 fst-italic">
            <strong>Emploi le plus long:</strong><?= $donne_det['title']; ?>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center fs-5 fst-italic">
            <a href="changement_dept.php?num=<?=$num; ?>&dep=<?= $donne_det['dept_no']; ?>"><button class="btn btn-primary">Changer de département</button></a>
        </li>
        </ul>
</div>
        </div>
        <a href="formulaire.php?num=<?=$num; ?>"><button>Devenir Manager</button></a>
    </div>
</div>
    <?php
            }
            mysqli_free_result($det);
    ?>
    <h2 class="mt-5 text-white">Historique des salaires</h2>
   <table class="table table-dark table-sm table-index  mt-4">
        <thead class="table-dark">
        <tr>
            <th>Salaire</th>
            <th>Du</th>
            <th>Au</th>
            <th>Poste occupe</th>
        </tr>
        </thead>
        <tbody>
    <?php
        if ($history && mysqli_num_rows($history) > 0) {
            while ($donne_histo = mysqli_fetch_assoc($history)) {
    ?>
        <tr>
            <td><?=$donne_histo['salary']," ";?>$</td>
            <td><?= date('d M Y', strtotime($donne_histo['from_date'])); ?></td>
            <td><?= date('d M Y', strtotime($donne_histo['to_date'])); ?></td>
            <td><?=$donne_histo['title']; ?></td>
        </tr>
    <?php
            }
            mysqli_free_result($history);
        } else {
            echo '<tr>
                <td>Aucun historique de salaire trouvé.</td>
            </tr>';
        }
    ?>
        </tbody>
    </table>
    </div>
</body>
</html>

