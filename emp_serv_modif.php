<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="emp_serv.css">
    <title>Modification</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] == true) {
            $erreur = false;
            if (isset($_GET['noemp'])) {
                if (!empty($_POST)) {
                    if (!isset($_POST["noemp"]) || empty($_POST["noemp"]) || !preg_match("#^[0-9]{1,4}$#", $_POST["noemp"])) {
                        $erreur = true;
                        $message[] = "*Saisie N° Employé incorrecte";
                    }
                    if (!isset($_POST["nom"]) || empty($_POST["nom"]) || !preg_match("#^[A-Z]{1,20}$#", $_POST["nom"])) {
                        $erreur = true;
                        $message[] = "*Saisie Nom incorrecte";
                    }
                    if (!isset($_POST["prenom"]) || empty($_POST["prenom"]) || !preg_match("#^[A-Z]{1,20}$#", $_POST["prenom"])) {
                        $erreur = true;
                        $message[] = "*Saisie Prénom incorrecte";
                    }
                    if (!isset($_POST["emploi"]) || empty($_POST["emploi"]) || !preg_match("#^[A-Z]{1,20}$#", $_POST["emploi"])) {
                        $erreur = true;
                        $message[] = "*Saisie Emploi incorrecte";
                    }
                    if (!isset($_POST["embauche"]) || empty($_POST["embauche"]) || !preg_match("#^[0-9]{4}-[01][0-9]-[0-3][0-9]$#", $_POST["embauche"])) {
                        $erreur = true;
                        $message[] = "*Saisie Date d'embauche incorrecte";
                    }
                    if (!isset($_POST["sal"]) || empty($_POST["sal"]) || !preg_match("#^[0-9]{1,6}[,.]*[0-9]{1,2}$#", $_POST["sal"])) {
                        $erreur = true;
                        $message[] = "*Saisie Salaire incorrecte";
                    }
                    if (isset($_POST["comm"]) && !empty($_POST["comm"]) && !preg_match("#^[0-9]{1,6}[,.]*[0-9]{1,2}$#", $_POST["comm"])) {
                        $erreur = true;
                        $message[] = "*Saisie Commission incorrecte";
                    }
                    if ($erreur == false) {
                        $noemp = $_POST["noemp"];
                        $nom = $_POST["nom"];
                        $prenom = $_POST["prenom"];
                        $emploi = $_POST["emploi"];
                        $embauche = $_POST["embauche"];
                        $sal = $_POST["sal"];
                        $comm = $_POST["comm"];

                        $bdd = mysqli_init();
                        mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                        mysqli_query($bdd, "UPDATE employes SET noemp = $noemp, nom = '$nom', prenom = '$prenom', emploi = '$emploi', embauche = '$embauche', sal = $sal 
                                    WHERE noemp = $noemp");
                        if (isset($_POST["comm"])) {
                            mysqli_query($bdd, "UPDATE employes SET comm = $comm WHERE noemp = $noemp");
                        } else {
                            $comm = NULL;
                            mysqli_query($bdd, "UPDATE employes SET comm = $comm WHERE noemp = $noemp");
                        }
                        mysqli_close($bdd);
                        header("Location: emp_serv.php");
                    }
                }
                $bdd = mysqli_init();
                mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                $result = mysqli_query($bdd, "SELECT e.noemp, e.nom, e.prenom, e.emploi, concat(e2.nom, ' ', e2.prenom) 'superieur', e.embauche, e.sal, e.comm, service, e.sup FROM employes e 
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
                        $preselec_superieur = $donnees[$i][4];
                        $preselec_embauche = $donnees[$i][5];
                        $preselec_sal = $donnees[$i][6];
                        $preselec_comm = $donnees[$i][7];
                        $preselec_service = $donnees[$i][8];
                        $preselec_sup = $donnees[$i][9];
                    }
                    $i++;
                }
    ?>
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='style_formulaire'>
                                <legend>Modification</legend>
                                <hr>
                                <?php
                                if ($erreur == true) {
                                    foreach ($message as $message) {
                                        echo "<div class='erreur'>$message</div>";
                                    }
                                }
                                ?>
                                <form action='' method='POST'>
                                    <label for='noemploye'>N° Employé</label>
                                    <br>
                                    <input id='noemploye' type='number' class='form-control' name='noemp' placeholder='Entrez N° employé' value='<?php if ($erreur == true) {
                                                                                                                                                        echo $_POST["noemp"];
                                                                                                                                                    } else {
                                                                                                                                                        echo $preselec_noemp;
                                                                                                                                                    } ?>' required>
                                    <label for='nomPersonne'>Nom</label>
                                    <br>
                                    <input id='nomPersonne' type='text' class='form-control' name='nom' placeholder='Entrez votre nom' value='<?php if ($erreur == true) {
                                                                                                                                                    echo $_POST["nom"];
                                                                                                                                                } else {
                                                                                                                                                    echo $preselec_nom;
                                                                                                                                                } ?>' required>
                                    <label for='prenomPersonne'>Prénom</label>
                                    <br>
                                    <input id='prenomPersonne' type='text' class='form-control' name='prenom' placeholder='Entrez votre prénom' value='<?php if ($erreur == true) {
                                                                                                                                                            echo $_POST["prenom"];
                                                                                                                                                        } else {
                                                                                                                                                            echo $preselec_prenom;
                                                                                                                                                        } ?>' required>
                                    <label for='emploiPersonne'>Emploi</label>
                                    <br>
                                    <input id='emploiPersonne' type='text' class='form-control' name='emploi' placeholder='Entrez votre emploi' value='<?php if ($erreur == true) {
                                                                                                                                                            echo $_POST["emploi"];
                                                                                                                                                        } else {
                                                                                                                                                            echo $preselec_emploi;
                                                                                                                                                        } ?>' required>
                                    <label for='nosup'>Supérieur</label>
                                    <br>
                                    <div class='imitation_input'><?php $superieur = ($preselec_sup == NULL ? $preselec_sup = "═════════" : $preselec_superieur);
                                                                    echo "$superieur" ?></div>

                                    <label for='dateembauche'>Date d'embauche</label>
                                    <br>
                                    <input id='dateembauche' type='date' class='form-control' name='embauche' required value='<?php if ($erreur == true) {
                                                                                                                                    echo $_POST["embauche"];
                                                                                                                                } else {
                                                                                                                                    echo $preselec_embauche;
                                                                                                                                } ?>'>
                                    <label for='salaire'>Salaire</label>
                                    <br>
                                    <input id='salaire' type='number' step=any class='form-control' name='sal' placeholder='Entrez votre salaire' value='<?php if ($erreur == true) {
                                                                                                                                                                echo $_POST["sal"];
                                                                                                                                                            } else {
                                                                                                                                                                echo $preselec_sal;
                                                                                                                                                            } ?>' required>
                                    <label for='commission'>Commission</label>
                                    <br>
                                    <input id='commission' type='number' step=any class='form-control' name='comm' placeholder='Entrez votre commission' value='<?php if ($erreur == true) {
                                                                                                                                                                    echo $_POST["comm"];
                                                                                                                                                                } else {
                                                                                                                                                                    echo $preselec_comm;
                                                                                                                                                                } ?>'>
                                    <label for='nosup'>Service</label>
                                    <br>
                                    <?php echo "<div class='imitation_input'>$preselec_service</div>"; ?>

                                    <input type='submit' class='btn btn-success btn-sm' name='modifier' value='Modifier'>
                                    <input type='reset' class='btn btn-warning btn-sm' value='Réinitialiser'>
                                </form>

                                <a href='emp_serv.php'><button class='btn btn-primary btn-lg'>Page d'Accueil</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            $erreur = false;
            if (isset($_GET['noserv'])) {
                if (!empty($_POST)) {
                    if (!isset($_POST["noserv"]) || empty($_POST["noserv"]) || !preg_match("#^[0-9]{1,2}$#", $_POST["noserv"])) {
                        $erreur = true;
                        $message[] = "*Saisie N° Service incorrecte";
                    }
                    if (!isset($_POST["service"]) || empty($_POST["service"]) || !preg_match("#^[A-Z]{1,20}$#", $_POST["service"])) {
                        $erreur = true;
                        $message[] = "*Saisie Service incorrecte";
                    }
                    if (!isset($_POST["ville"]) || empty($_POST["ville"]) || !preg_match("#^[A-Z]{1,20}$#", $_POST["ville"])) {
                        $erreur = true;
                        $message[] = "*Saisie Ville incorrecte";
                    }
                    if ($erreur == false) {
                        $noserv = $_POST["noserv"];
                        $service = $_POST["service"];
                        $ville = $_POST["ville"];

                        $bdd = mysqli_init();
                        mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                        mysqli_query($bdd, "UPDATE services SET noserv = $noserv, service = '$service', ville = '$ville' WHERE noserv = $noserv");
                        mysqli_close($bdd);
                        header("Location: emp_serv.php");
                    }
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
                                <legend>Modification</legend>
                                <hr>
                                <?php
                                if ($erreur == true) {
                                    foreach ($message as $message) {
                                        echo "<div class='erreur'>$message</div>";
                                    }
                                }
                                ?>
                                <form action='' method='POST'>
                                    <label for='noservice'>N° Service</label>
                                    <br>
                                    <input id='noservice' type='number' class='form-control' name='noserv' placeholder='Entrez le N° service' value='<?php if ($erreur == true) {
                                                                                                                                                            echo $_POST["noserv"];
                                                                                                                                                        } else {
                                                                                                                                                            echo $preselec_noserv;
                                                                                                                                                        }
                                                                                                                                                        ?>' required>
                                    <label for='serv'>Service</label>
                                    <br>
                                    <input id='serv' type='text' class='form-control' name='service' placeholder='Entrez le service' value='<?php if ($erreur == true) {
                                                                                                                                                echo $_POST["service"];
                                                                                                                                            } else {
                                                                                                                                                echo $preselec_service;
                                                                                                                                            } ?>' required>
                                    <label for='vill'>Ville</label>
                                    <br>
                                    <input id='vill' type='text' class='form-control' name='ville' placeholder='Entrez la ville' value='<?php if ($erreur == true) {
                                                                                                                                            echo $_POST["ville"];
                                                                                                                                        } else {
                                                                                                                                            echo $preselec_ville;
                                                                                                                                        } ?>' required>
                                    <input type='submit' class='btn btn-success btn-sm' name='modifier' value='Modifier'>
                                    <input type='reset' class='btn btn-warning btn-sm' value='Réinitialiser'>
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