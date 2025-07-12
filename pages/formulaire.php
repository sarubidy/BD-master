<?php
require ("../includer/fonction.php");
$id=$_GET['num'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
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
<div class="container">
        <h1>hi<?= $id ?></h1>
    <div class="form-container">
        <form action="trait-dep.php" method="post">
            <div class="form-group">
                <label for="nom">Date</label>
                <p>from_date<input type="date" name="date-now" id="date-now" class="form-control" required></p>
                <p>to_date<input type="date" name="date-aft" id="date-aft" class="form-control" required></p>
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="submit" value="ok">
            </div>
        </form>
  </div>
</div>
</body>
</html>