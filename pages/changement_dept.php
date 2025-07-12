<?php
require ("../includer/fonction.php");
if(isset($_GET['error']))
{
    $error = $_GET['error'];
}else{$error = 0;}

$num = $_GET['num'];
$ancien = $_GET['dep'];
$sortie_0 = aff_dep_non($ancien);
$sortie_1 = aff_dep_oui($ancien);

while($donne_1 = mysqli_fetch_assoc($sortie_1))
{
    $actuel = $donne_1['dept_name'];
    $anienne_date = $donne_1['from_date'];
}
mysqli_free_result($sortie_1);
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
    <h1 class="text-white" style="text-align:center;">Département actuel : <?=$actuel; ?> </h1>
    <div class="container mt-4 text-white">
                    <form action="traitement_change.php" method="post" class="card p-4 bg-dark mb-4 shadow-sm">
                        <div class="row g-3 align-items-end text-white">
                            <div class="col-md-5">
                                <label for="min" class="form-label">Nouveau département</label>
                                <select id="departement" name="nouveau" class="form-select" required>
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
                            <div class="col-md-5">
                                <label for="min" class="form-label">Date de début</label>
                                <input type="date" name="date_b" class="form-control" required>
                            </div>
                                <input type="hidden" name="date_a" value="<?=$anienne_date; ?>">
                                <input type="hidden" name="ancien" value="<?=$ancien; ?>">
                                <input type="hidden" name="num" value="<?=$num; ?>">
                            <div class="col-md-2  rounded">
                                <input type="submit" value="Valider" class="btn fw-bold text-white w-100 mt-3 mt-md-0">
                            </div>
                        </div>
                <span class="error">
            <?php
            if($error == 1)
            {
                echo "Erreur : la date de début du nouveau département est antérieur à la date du début de l'actuel";
            }
            ?>
                </span>
                    </form>
    </div>
</body>
</html>
