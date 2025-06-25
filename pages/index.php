<?php
include("../inc/fonction.php");
$dep = getManager();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Départements</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

    <div class="container mt-5">
        <header>
            <h1 class="text-center mb-4 text-dark"> Departements et leurs Managers </h1>
        </header>

        <main>
            <table class="mt-5 table table-bordered table-hover table-dark ">
                <thead class="table-light text-dark">
                    <tr>
                        <th scope="col">Numero</th>
                        <th scope="col">Nom du departement</th>
                        <th scope="col">Manager</th>
                        <th scope="col">Employes</th>
                    </tr>
                </thead>
                <?php foreach ($dep as $depp) { ?>
                    <tr>
                        <td><?php echo $depp['dept_no'] ?></td>
                        <td><?php echo $depp['dept_name'] ?></td>
                        <td><?php echo $depp['first_name'] . ' ' . $depp['last_name'] ?></td>
                        <td><a class="btn btn-secondary " href="emp.php?id=<?php echo $depp['dept_no'] ?>">Voir plus</a>
                        </td>
                    </tr>
                <?php } ?>

            </table>

        </main>

    </div>

</body>

</html>