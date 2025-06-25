<?php 
include("../inc/fonction.php");
$emp_no = $_GET['nb'];
$info = get_info_emp($emp_no);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <title>Fiche</title>
</head>
<body>
    <header>
        <h1 class= "text-center mt-5">A propos de l'employe(e)</h1>
    </header>

<main>
    <div class="card text-center mb-3 position-absolute top-50 start-50 translate-middle" style="width: 18rem;">
        <div class="card-body">
            <p><b>Nom:</b> <?php echo $info['first_name']?></p>
            <p><b>Prenom:</b> <?php echo $info['last_name']?></p>
            <p><b>Date de naissance:</b> <?php echo $info['birth_date']?></p>
            <p><b>Genre:</b> <?php echo $info['gender']?></p>
            <p><b>A commence le:</b> <?php echo $info['hire_date']?></p>
        </div>
    </div>    
</main>
</body>
</html>