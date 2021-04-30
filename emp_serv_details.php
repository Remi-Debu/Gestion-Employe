<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="emp_serv.css">
    <title>Détails</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] == true) {
            if (isset($_GET['noemp'])) {
                $displayEmp = "SELECT noemp, nom, prenom, emploi, sup, noserv, embauche, sal, comm FROM employes";
                $dataDisplayEmp = requestBDD($displayEmp);

                for ($i = 0; $i < count($dataDisplayEmp); $i++) {
                    if ($_GET['noemp'] == $dataDisplayEmp[$i][0]) {
                        $preselec_noemp = $dataDisplayEmp[$i][0];
                        $preselec_nom = $dataDisplayEmp[$i][1];
                        $preselec_prenom = $dataDisplayEmp[$i][2];
                        $preselec_emploi = $dataDisplayEmp[$i][3];
                        $preselec_sup = $dataDisplayEmp[$i][4];
                        $preselec_noserv = $dataDisplayEmp[$i][5];
                        $preselec_embauche = $dataDisplayEmp[$i][6];
                        $preselec_sal = $dataDisplayEmp[$i][7];
                        $preselec_comm = $dataDisplayEmp[$i][8];
                    }
                }
    ?>
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='style_formulaire'>
                                <legend>Détails</legend>
                                <hr>

                                <label for='noemp'>N° Employé</label>
                                <br>
                                <input id='noemp' type='number' class='form-control' name='noemp' value=<?php echo $preselec_noemp ?> disabled>
                                <?php
                                if ($preselec_sup != null) { ?>
                                    <label for='supEmp'>N° Supérieur</label>
                                    <br>
                                    <input id='supEmp' type='number' class='form-control' name='sup' value=<?php echo $preselec_sup ?> disabled>
                                <?php
                                }
                                ?>
                                <label for='nomPersonne'>Nom</label>
                                <br>
                                <input id='nomPersonne' type='text' class='form-control' name='nom' value=<?php echo $preselec_nom ?> disabled>

                                <label for='prenomPersonne'>Prénom</label>
                                <br>
                                <input id='prenomPersonne' type='text' class='form-control' name='prenom' value=<?php echo $preselec_prenom ?> disabled>

                                <label for='emploiPersonne'>Emploi</label>
                                <br>
                                <input id='emploiPersonne' type='text' class='form-control' name='emploi' value=<?php echo $preselec_emploi ?> disabled>

                                <label for='embauche'>Date d'embauche</label>
                                <br>
                                <input id='embauche' type='date' class='form-control' name='embauche' value=<?php echo $preselec_embauche ?> disabled>

                                <label for='salaire'>Salaire</label>
                                <br>
                                <input id='salaire' type='number' class='form-control' name='sal' value=<?php echo $preselec_sal ?> disabled>
                                <?php
                                if ($preselec_comm != null) { ?>
                                    <label for='commission'>Commission</label>
                                    <br>
                                    <input id='commission' type='number' class='form-control' name='comm' value=<?php echo $preselec_comm ?> disabled>
                                <?php
                                }
                                ?>
                                <label for='noServ'>N° Service</label>
                                <br>
                                <input id='noServ' type='number' class='form-control' name='noserv' value=<?php echo $preselec_noserv ?> disabled>

                                <a href='emp_serv.php'><button class='btn btn-primary btn-lg'>Page d'Accueil</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }

            if (isset($_GET['noserv'])) {
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
                                <legend>Détails</legend>
                                <hr>

                                <label for='noserv'>N° Service</label>
                                <br>
                                <input id='noserv' type='number' class='form-control' name='noserv' value=<?php echo $preselec_noserv ?> disabled>

                                <label for='service'>Service</label>
                                <br>
                                <input id='service' type='text' class='form-control' name='service' value=<?php echo $preselec_service ?> disabled>

                                <label for='ville'>Ville</label>
                                <br>
                                <input id='ville' type='text' class='form-control' name='ville' value=<?php echo $preselec_ville ?> disabled>

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