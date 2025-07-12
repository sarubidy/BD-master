<?php
require ("../includer/fonction.php");
$sortie_0 = aff_dep();
$sortie = aff_dep();
$lien=lien_employer();
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
        <nav class="navbar navbar-expand-lg bg-black">
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
    <div class="container mt-4 text-white">
        <form action="traitement.php" method="get" class="card p-4 bg-dark mb-4 shadow-sm">
            <div class="row g-3 align-items-end text-white">
                <div class="col-md-3">
                    <label for="departement" class="form-label">Départements</label>
                    <select id="departement" name="departement" class="form-select" required>
                        <?php
                        while ($donne_0 = mysqli_fetch_assoc($sortie_0))
                        {?>
                        <option value="<?=$donne_0['dept_no']; ?>"><?=$donne_0['dept_name']; ?></option>
                        <?php
                        }
                        mysqli_free_result($sortie_0);
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="min" class="form-label">Age minimum</label>
                    <input type="number" name="min" class="form-control" >
                    <input type="hidden" name="n" value=0>
                </div>
                <div class="col-md-2">
                    <label for="max" class="form-label">Age maximum</label>
                    <input type="number" name="max" class="form-control" >
                </div>
                <div class="col-md-2 ok rounded">
                    <input type="submit" value="OK" class="btn fw-bold text-white w-100 mt-3 mt-md-0">
                </div>
            </div>
        </form>
        <hr class="bg-white">
        <div class="row bg-dark vh-100">
            <!-- Colonne de gauche -->
            <div class="col-md-2">
                <h2 class="mt-3">Voir les listes des Employées</h2>
                <?php foreach($lien as $emp) {?>
                    <a class="text-primary text-decoration-none" href="list_employees.php?num=<?= $emp['dept_no']; ?>&n=0">
                        <?= $emp['dept_name']; ?>
                    </a>
                    <br>
                <?php }?>
            </div>
            <!-- Colonne de droite -->
            <div class="col-md-10 text-white py-4">
                <h1 class="fs-2  text-center mb-4">Liste des Départements</h1>
            <div class="table-responsive">
                <table class="table table-dark table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nom du département </th>
                            <th scope="col">Manager</th>
                            <th scope="col">Nombre d'employés</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider table-index">
                        <?php while ($donne = mysqli_fetch_assoc($sortie)){?>
                            <tr>
                                <td><?=$donne['dept_name']; ?></td>
                                <td><?=$donne['nom']," ",$donne['prenom']?> </td>
                                <td><?=$donne['nombre']; ?></td>
                            </tr>
                       <?php } mysqli_free_result($sortie); ?>
                   </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
