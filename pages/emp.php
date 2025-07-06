<?php
include("../inc/fonction.php");
$id = $_GET['id'];
$p = isset($_GET['p']) ? intval($_GET['p']) : 0;
$parPage = 20;
$limite = $p * $parPage;
$emp = getEmp($id, $limite);
$total = countEmp($id);
$nombre_page = ceil($total / $parPage);
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
                
        <h1  class="text-center mb-4 text-dark"> <a href="index.php"><img src="../assets/images/bouton-retour.png" height="40px" class="me-3"></a>
            Les employes dans 
            <?php
            if (isset($emp[0]['dept_name'])) {
                echo htmlspecialchars($emp[0]['dept_name']);
            }?>   
        </h1>
    </header>
        <main>
            <table class="mt-5 table table-hover table-dark ">
                <thead class="table-light text-dark">
                    <tr>
                        <th scope="col">Numero</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>

                    </tr>
                </thead>
                <?php  $i = 0;
                    foreach ($emp as $empp) { ?>
                        <tr>
                            <td><?php echo $limite + $i + 1; ?></td>
                            <td><a href="fiche.php?nb=<?php echo $v['emp_no'] ?>"> <?php echo $empp['first_name'] ?></a></td>
                            <td><?php echo $empp['last_name'] ?></td>
                        </tr>
                        <?php $i++;
                    } ?>
            </table>            
            <div class="d-flex justify-content-center align-items-center mt-3">
                <?php if ($p > 0) { ?>
                    <a class="page-link mx-2"
                    href="emp.php?p=<?php echo $p - 1; ?>&id=<?php echo urlencode($id); ?>&limite=<?php echo urlencode($limite); ?>">
                        Précédent
                    </a>
                <?php } ?>
                <span class="page-link mx-2">
                    Page <?php echo $p + 1; ?> / <?php echo $nombre_page; ?>
                </span>
                <?php if ($p <= $nombre_page - 1) { ?>
                    <a class="page-link mx-2"
                    href="emp.php?p=<?php echo $p + 1; ?>&id=<?php echo urlencode($id); ?>&limite=<?php echo urlencode($limite); ?>">
                        Suivant
                    </a>
                <?php } ?>
            </div>
        </main>
    </div>

</body>

</html>