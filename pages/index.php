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
            <section>
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
            </section>
            <section class="container">
                <h1 class="text-center mt-4 mb-4 text-dark">Rechercher Employes</h1>

                <form action="resultat.php" method="GET" class="p-3 shadow rounded bg-light">
                    <div class="form-group mb-3">
                        <label for="departement" class="form-label">Departement :</label>
                        <select name="departement" id="departement" class="form-select">
                        
                            <?php foreach ($dep as $nomdep) { ?>
                                <option value="<?php echo $nomdep['dept_name']; ?>">
                                    <?php echo $nomdep['dept_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

        
                    <div class="form-group mb-3">
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" class="form-control" name="nom">
                    </div>

            
                    <div class="form-group mb-3">
                        <label for="max" class="form-label">Âge maximum :</label>
                        <input type="number" class="form-control" name="max">
                    </div>


                    <div class="form-group mb-3">
                        <label for="min" class="form-label">Âge minimum :</label>
                        <input type="number" class="form-control" name="min">
                    </div>

                    <!-- Bouton -->
                    <button type="submit" class="btn btn-secondary w-100">Rechercher</button>
                </form>
            </section>




        </main>

    </div>

</body>

</html>