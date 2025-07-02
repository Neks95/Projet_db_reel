<?php
include("../inc/fonction.php");
if (!isset($_SESSION['dep'])) {
    $_SESSION['dep'] = $_GET['departement'];
}
$dep = $_SESSION['dep'];
if (!isset($_SESSION['nom'])) {
    $_SESSION['nom'] = $_GET['nom'];
}
$nom = $_SESSION['nom'];
if (!isset($_SESSION['max'])) {
    $_SESSION['max'] = $_GET['max'];
}
$max = $_SESSION['max'];
if (!isset($_SESSION['min'])) {
    $_SESSION['min'] = $_GET['min'];
}
$min = $_SESSION['min'];
$p = isset($_GET['p']) ? $_GET['p'] : 0;
$limite = $p * 20;
$val = rechercher($dep, $nom, $max, $min, $limite);
$total = rechercherCount($dep, $nom, $max, $min);
$nombre_page = ceil($total / 20);


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
                <span class="text-danger"><?php echo $_SESSION['dep'] ?></span>
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
                    <?php $i = 0;
                    foreach ($val as $v) { ?>
                        <tr>
                            <td><?php echo $limite + $i + 1; ?></td>
                            <td><a href="fiche.php?nb=<?php echo $v['emp_no'] ?>"> <?php echo $v['first_name'] ?></a></td>
                            <td><?php echo $v['last_name'] ?></td>
                        </tr>
                        <?php $i++;
                    } ?>
                </table>
                <nav aria-label="Page navigation example" class="mt-4">
                    <ul class="pagination justify-content-center">
                    
                        <li class="page-item <?php if ($p <= 0)
                            echo 'disabled'; ?>">
                            <a class="page-link"
                                href="resultat.php?p=<?php echo $p - 1; ?>&departement=<?php echo urlencode($dep); ?>&nom=<?php echo urlencode($nom); ?>&max=<?php echo $max; ?>&min=<?php echo $min; ?>">Précédent</a>
                        </li>

                        <!-- //a revoir plus tard -->

                        <?php for ($i = 0; $i < $nombre_page; $i++) { ?>
                            <!-- <li class="page-item <?php if ($i == $p)
                                echo 'active'; ?>">
                                <a class="page-link"
                                    href="resultat.php?p=<?php echo $i; ?>&departement=<?php echo urlencode($dep); ?>&nom=<?php echo urlencode($nom); ?>&max=<?php echo $max; ?>&min=<?php echo $min; ?>"><?php echo $i + 1; ?></a>
                            </li> -->
                        <?php } ?>

                        <li class="page-item <?php if ($p == $nbPages - 1)
                            echo 'disabled'; ?>">
                            <a class="page-link"
                                href="resultat.php?p=<?php echo $p + 1; ?>&departement=<?php echo urlencode($dep); ?>&nom=<?php echo urlencode($nom); ?>&max=<?php echo $max; ?>&min=<?php echo $min; ?>">Suivant</a>
                        </li>
                    </ul>
                </nav>


            <?php } ?>
            <?php if (empty($val)) { ?>
                <h3 class="text-center mt-4 mb-4 text-dark">Aucun employe de ce nom</h3>
            <?php } ?>

        </div>
    </main>

</body>

</html>