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
                    $deleteEmp = "DELETE FROM employes WHERE noemp = $noemp";
                    requestBDD($deleteEmp);
                    header("Location: emp_serv.php");
                }

                $displayEmp = "SELECT e.noemp, e.nom, e.prenom, e.emploi, DATE_FORMAT(e.embauche,'%d/%m/%Y'), e.sup, e.noserv, s.service, concat(e2.nom, ' ', e2.prenom) 
                               FROM employes e 
                               INNER JOIN services s ON e.noserv = s.noserv 
                               INNER JOIN employes e2 ON e.sup = e2.noemp OR e.sup IS NULL
                               GROUP BY noemp";
                $dataDisplayEmp = requestBDD($displayEmp);

                for ($i = 0; $i < count($dataDisplayEmp); $i++) {
                    if ($_GET['noemp'] == $dataDisplayEmp[$i][0]) {
                        $preselec_noemp = $dataDisplayEmp[$i][0];
                        $preselec_nom = $dataDisplayEmp[$i][1];
                        $preselec_prenom = $dataDisplayEmp[$i][2];
                        $preselec_emploi = $dataDisplayEmp[$i][3];
                        $preselec_embauche = $dataDisplayEmp[$i][4];
                        $preselec_sup = $dataDisplayEmp[$i][5];
                        $preselec_noserv = $dataDisplayEmp[$i][6];
                        $preselec_serv = $dataDisplayEmp[$i][7];
                        $preselec_superieur = $dataDisplayEmp[$i][8];
                    }
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

                                    <label for='noEmploye'>N?? Employ??</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_noemp</div>"; ?>

                                    <label for='nomPersonne'>Nom</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_nom</div>"; ?>

                                    <label for='prenomPersonne'>Pr??nom</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_prenom</div>"; ?>

                                    <label for='emploiPersonne'>Emploi</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_emploi</div>"; ?>

                                    <label for='embauchePersonne'>Date d'embauche</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_embauche</div>"; ?>

                                    <?php if ($preselec_sup != NULL) { ?>
                                        <label for='superieurPersonne'>Sup??rieur</label>
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
                    $deleteServ = "DELETE FROM services WHERE noserv = $noserv";
                    requestBDD($deleteServ);
                    header("Location: emp_serv.php");
                }

                $displayServ = "SELECT * FROM services";
                $dataDisplayServ = requestBDD($displayServ);

                for ($i = 0; $i < count($dataDisplayServ); $i++) {
                    if ($_GET['noserv'] == $dataDisplayServ[$i][0]) {
                        $preselec_noserv = $dataDisplayServ[$i][0];
                        $preselec_service = $dataDisplayServ[$i][1];
                        $preselec_ville = $dataDisplayServ[$i][2];
                    }
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

                                    <label for='nosup'>N?? Service</label>
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

    <?php
    // FONCTIONS
    function requestBDD($requete)
    {
        $bdd = mysqli_init();
        mysqli_real_connect($bdd, "127.0.0.1", "admin", "admin", "emp_serv");
        $result = mysqli_query($bdd, $requete);
        if (preg_match("#^SELECT#i", $requete)) {
            $data = mysqli_fetch_all($result);
            mysqli_free_result($result);
            mysqli_close($bdd);
            return $data;
        } else {
            mysqli_close($bdd);
        }
    }
    ?>
</body>

</html>