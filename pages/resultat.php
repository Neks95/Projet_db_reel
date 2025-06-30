<?php
include("../inc/fonction.php");
$dep = $_GET['departement'];
$nom = $_GET['nom'];
$max = $_GET['max'];
$min = $_GET['min'];
$val = rechercher($dep, $nom, $max, $min);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <header>
        <div class="container d-flex align-items-center mt-4 mb-4">
            <a href="index.php"><img src="../assets/images/bouton-retour.png" height="40px" class="me-3"></a>
            <h1 class="m-0 text-dark">
                Résultat de la recherche dans
                <span class="text-danger"><?php echo $dep ?></span>
            </h1>
        </div>
    </header>

    <main>
        <div class="container">
            <?php if (!empty($val)) { ?>

                <table class="mt-5 table table-hover table-dark table responsive">
                    <thead class="table-light text-dark">
                        <tr>
                            <th scope="col">Numero</th>
                            <th>Nom</th>
                            <th scope="col">Prenom</th>
                        </tr>
                    </thead>
                    <?php foreach ($val as $v) { ?>
                        <tr>
                            <td><?php echo $v['emp_no'] ?></td>
                            <td><a href="fiche.php?nb=<?php echo $v['emp_no'] ?>"> <?php echo $v['first_name'] ?></a></td>
                            <td><?php echo $v['last_name'] ?></td>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <?php if (empty($val)) { ?>
                    <h3 class="text-center mt-4 mb-4 text-dark">Aucun employe de ce nom</h3>
                <?php } ?>
            </table>
        </div>
    </main>

</body>

</html>