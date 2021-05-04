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
    include_once("DAO/EmployeDAO.php");
    include_once("DAO/ServiceDAO.php");

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
                        $employe = (new Employe())
                            ->setNoemp($_POST["noemp"])
                            ->setNom($_POST["nom"])
                            ->setPrenom($_POST["prenom"])
                            ->setEmploi($_POST["emploi"])
                            ->setEmbauche($_POST["embauche"])
                            ->setSal($_POST["sal"])
                            ->setComm($_POST["comm"]);
                            
                        (new EmployeDAO())->updateEmp($employe);

                        if (isset($_POST["comm"])) {
                            (new EmployeDAO())->updateComm($employe);
                        } else {
                            $comm = NULL;
                            (new EmployeDAO())->updateComm($employe);
                        }
                        header("Location: emp_serv.php");
                    }
                }

                $dataDisplayEmp = (new EmployeDAO())->displayEmpModif();

                for ($i = 0; $i < count($dataDisplayEmp); $i++) {
                    if ($_GET['noemp'] == $dataDisplayEmp[$i][0]) {
                        $preselec_noemp = $dataDisplayEmp[$i][0];
                        $preselec_nom = $dataDisplayEmp[$i][1];
                        $preselec_prenom = $dataDisplayEmp[$i][2];
                        $preselec_emploi = $dataDisplayEmp[$i][3];
                        $preselec_superieur = $dataDisplayEmp[$i][4];
                        $preselec_embauche = $dataDisplayEmp[$i][5];
                        $preselec_sal = $dataDisplayEmp[$i][6];
                        $preselec_comm = $dataDisplayEmp[$i][7];
                        $preselec_service = $dataDisplayEmp[$i][8];
                        $preselec_sup = $dataDisplayEmp[$i][9];
                    }
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
                        $service = (new Service())->setNoserv($_POST["noserv"])->setService($_POST["service"])->setVille($_POST["ville"]);
                        (new ServiceDAO())->updateServ($service);
                        header("Location: emp_serv.php");
                    }
                }
                $dataDisplayServ = (new ServiceDAO())->displayServ();

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