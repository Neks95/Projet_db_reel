<?php
include("../inc/fonction.php");
$emp_no = $_GET['nb'];
$info = get_info_emp($emp_no);
$salaire = getSalaire($emp_no);
$titre = getTitre($emp_no);
$longest_title = null;
$max_duration = 0;
foreach ($titre as $t) {
    $from = new DateTime($t['from_date']);
if ($t['to_date'] == "9999-01-01") {
    $to = new DateTime();
} else {
    $to = new DateTime($t['to_date']);} 
$interval = $from->diff($to);
$duration = $interval->days;    
if ($duration > $max_duration) {
        $max_duration = $duration;
        $longest_title = $t;
    }
}
$sa = salaireActuel($emp_no);
$ti = titreActuel($emp_no);
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
                        <p><strong>Departement : </strong><?php echo $info['dept_name']?></p>
                          <?php if (!empty($ti)) { ?>
                            <?php foreach ($ti as $tt) { ?>
                            <?php } ?>
                                <p><strong>Titre : </strong> : <?php echo $tt['title']?></p>
                            <?php }?>
                            <?php if ($longest_title) { ?>
                                <p><strong>Emploi le plus long :</strong> <?php echo htmlspecialchars($longest_title['title']); ?> ( <?php echo $longest_title['from_date']; ?> - <?php echo $longest_title['to_date'] == "9999-01-01" ? "aujourd'hui" : $longest_title['to_date']; ?>)</p>
                            <?php } ?>
                        <?php if (!empty($sa)) { ?>
                            <?php foreach ($sa as $sal) { ?>
                            <?php } ?>
                              <p><strong>Salaire actuel depuis le <?php echo $sal['from_date'] ?></strong> : <?php echo $sal['salary']?> $ </p>
                        <?php }?>
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
                                <?php if ($s['to_date'] != "9999-01-01") { ?>
                                    <tr>
                                        <td><?php echo $s['salary']; ?> $</td>
                                        <td><?php echo $s['from_date']; ?></td>
                                         <td><?php echo $s['to_date'];?>
                                        </td>
                                    </tr>
                                <?php } ?>
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
                                <?php if ($tt['to_date'] != "9999-01-01") { ?>
                                  
                                    <tr>
                                        <td><?php echo $t['title']; ?></td>
                                        <td><?php echo $t['from_date']; ?></td>
                                        <td><?php echo $t['to_date']; ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>

            </section>
        </main>
</body>

</html>