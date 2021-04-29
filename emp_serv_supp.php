<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="emp_serv.css">
    <title>Suppression</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] == true) {
            if (isset($_GET['noemp'])) {
                if (isset($_POST["noemp"])) {
                    $noemp = $_POST["noemp"];

                    $bdd = mysqli_init();
                    mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                    mysqli_query($bdd, "DELETE FROM employes WHERE noemp = $noemp");
                    mysqli_close($bdd);
                    header("Location: emp_serv.php");
                }

                $bdd = mysqli_init();
                mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                $result = mysqli_query($bdd, "SELECT e.noemp, e.nom, e.prenom, e.emploi, DATE_FORMAT(e.embauche,'%d/%m/%Y'), e.sup, e.noserv, s.service, concat(e2.nom, ' ', e2.prenom) 
                                      FROM employes e 
                                      INNER JOIN services s ON e.noserv = s.noserv 
                                      INNER JOIN employes e2 ON e.sup = e2.noemp OR e.sup IS NULL
                                      GROUP BY noemp");
                $donnees = mysqli_fetch_all($result);
                mysqli_free_result($result);
                mysqli_close($bdd);
                $i = 0;
                while ($i < count($donnees)) {
                    if ($_GET['noemp'] == $donnees[$i][0]) {
                        $preselec_noemp = $donnees[$i][0];
                        $preselec_nom = $donnees[$i][1];
                        $preselec_prenom = $donnees[$i][2];
                        $preselec_emploi = $donnees[$i][3];
                        $preselec_embauche = $donnees[$i][4];
                        $preselec_sup = $donnees[$i][5];
                        $preselec_noserv = $donnees[$i][6];
                        $preselec_serv = $donnees[$i][7];
                        $preselec_superieur = $donnees[$i][8];
                    }
                    $i++;
                }
    ?>
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='style_formulaire'>
                                <legend>Suppression</legend>
                                <hr>

                                <form action='' method='POST'>
                                    <input id='noemp' type='number' class='form-control' name='noemp' value=<?php echo $preselec_noemp ?> hidden>

                                    <label for='noEmploye'>N° Employé</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_noemp</div>"; ?>

                                    <label for='nomPersonne'>Nom</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_nom</div>"; ?>

                                    <label for='prenomPersonne'>Prénom</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_prenom</div>"; ?>

                                    <label for='emploiPersonne'>Emploi</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_emploi</div>"; ?>

                                    <label for='embauchePersonne'>Date d'embauche</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_embauche</div>"; ?>

                                    <?php if ($preselec_sup != NULL) { ?>
                                        <label for='superieurPersonne'>Supérieur</label>
                                        <br>
                                    <?php echo "<div class='imitation_input'>$preselec_superieur</div>";
                                    } ?>

                                    <label for='servPersonne'>Service</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_serv</div>"; ?>

                                    <input type='submit' class='btn btn-danger btn-sm' name='supprimer' value='Supprimer'>
                                </form>

                                <a href='emp_serv.php'><button class='btn btn-primary btn-lg'>Page d'Accueil</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            if (isset($_GET['noserv'])) {
                if (isset($_POST["noserv"])) {
                    $noserv = $_POST["noserv"];

                    $bdd = mysqli_init();
                    mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                    mysqli_query($bdd, "DELETE FROM services WHERE noserv = $noserv");
                    mysqli_close($bdd);
                    header("Location: emp_serv.php");
                }

                $bdd = mysqli_init();
                mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                $result = mysqli_query($bdd, "SELECT * FROM services");
                $donnees = mysqli_fetch_all($result);
                mysqli_free_result($result);
                mysqli_close($bdd);
                $i = 0;
                while ($i < count($donnees)) {
                    if ($_GET['noserv'] == $donnees[$i][0]) {
                        $preselec_noserv = $donnees[$i][0];
                        $preselec_service = $donnees[$i][1];
                        $preselec_ville = $donnees[$i][2];
                    }
                    $i++;
                }
            ?>
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='style_formulaire'>
                                <legend>Suppression</legend>
                                <hr>
                                <form action='' method='POST'>
                                    <input id='noserv' type='number' class='form-control' name='noserv' value=<?php echo $preselec_noserv ?> hidden>

                                    <label for='nosup'>N° Service</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_noserv</div>"; ?>

                                    <label for='nosup'>Service</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_service</div>"; ?>

                                    <label for='nosup'>Ville</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_ville</div>"; ?>

                                    <input type='submit' class='btn btn-danger btn-sm' name='supprimer' value='Supprimer'>
                                </form>

                                <a href='emp_serv.php'><button class='btn btn-primary btn-lg'>Page d'Accueil</button></a>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
            }
        } else {
            header("location:emp_serv.php");
        }
    } else {
        header("location:emp_serv.php");
    }
    ?>
</body>

</html>