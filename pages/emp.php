<?php
include("../inc/fonction.php");
$id = $_GET['id'];
$emp = getEmp($id);
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
    <div class="container mt-5">
        <header>
            <h1 class="text-center mb-4 text-dark"> Departements et les employes</h1>
        </header>

        <main>
            <table class="mt-5 table table-hover table-dark ">
                <thead class="table-light text-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Sexe</th>f
                    </tr>
                </thead>
                <?php foreach ($emp as $empp) { ?>
                    <tr>
                        <td><?php echo $empp['first_name'] ?></td>
                        <td><?php echo $empp['last_name'] ?></td>
                        <td><?php echo $empp['gender'] ?></td>
                        </td>
                    </tr>
                <?php } ?>

            </table>

        </main>

    </div>

</body>

</html>