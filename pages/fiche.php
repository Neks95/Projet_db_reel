<?php
include("../inc/fonction.php");
$emp_no = $_GET['nb'];
$info = get_info_emp($emp_no);
$salaire = getSalaire($emp_no);
$titre = getTitre($emp_no);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Employé</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>
    <header>
        <div class="container d-flex align-items-center mt-4 mb-4 ">
            <a href="index.php"><img src="../assets/images/bouton-retour.png" height="40px" class="me-3"></a>
            <h1 class="m-0 text-dark">
                Fiche de l'employe
            </h1>
        </div>

        <main class="container my-5">
            <div class="d-flex justify-content-center mb-5">
                <div class="card fiche-card p-3">
                    <div class="card-body text-center">
                        <h4 class="mb-3 text-primary"><?php echo $info['first_name'] . " " . $info['last_name']; ?></h4>
                        <p><strong>Date de naissance :</strong> <?php echo $info['birth_date']; ?></p>
                        <p><strong>Genre :</strong> <?php echo $info['gender']; ?></p>
                        <p><strong>Date d'embauche :</strong> <?php echo $info['hire_date']; ?></p>
                    </div>
                </div>
            </div>
            <section>
                <h2 class="mb-4">Historique des salaires</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Salaire</th>
                                <th>De</th>
                                <th>À</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($salaire as $s) { ?>
                                <tr>
                                    <td><?php echo $s['salary']; ?> $</td>
                                    <td><?php echo $s['from_date']; ?></td>
                                     <td>
                                        <?php
                                        if ($s['to_date'] == "9999-01-01") {
                                            echo "aujourd'hui";
                                        } else {
                                            echo $s['to_date'];
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <section>
                <h2 class="mb-4 mt-4">Historique des titres</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>titre</th>
                                <th>De</th>
                                <th>À</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($titre as $t) { ?>
                                <tr>
                                    <td><?php echo $t['title']; ?></td>
                                    <td><?php echo $t['from_date']; ?></td>
                                    <td>
                                        <?php
                                        if ($t['to_date'] == "9999-01-01") {
                                            echo "aujourd'hui";
                                        } else {
                                            echo $t['to_date'];
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>

            </section>
        </main>
</body>

</html>