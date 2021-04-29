<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="emp_serv.css">
    <title>Ajouter</title>
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
                    if (!isset($_POST["noserv"]) || empty($_POST["noserv"]) || !preg_match("#^[0-9]{1,2}$#", $_POST["noserv"])) {
                        $erreur = true;
                        $message[] = "*Saisie N° Service incorrecte";
                    }
                    if (isset($_POST["sup"]) && !empty($_POST["sup"]) && !preg_match("#^[0-9]{1,4}$#", $_POST["sup"])) {
                        $erreur = true;
                        $message[] = "*Saisie N° Supérieur incorrecte";
                    }
                    if (isset($_POST["comm"]) && !empty($_POST["comm"]) && !preg_match("#^[0-9]{1,6}[,.]*[0-9]{1,2}$#", $_POST["comm"])) {
                        $erreur = true;
                        $message[] = "*Saisie Commission incorrecte";
                    }
                    $bdd = mysqli_init();
                    mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                    $result = mysqli_query($bdd, "SELECT noemp from employes");
                    $donnees = mysqli_fetch_all($result);
                    mysqli_free_result($result);
                    mysqli_close($bdd);
                    for ($i = 0; $i < count($donnees); $i++) {
                        if ($donnees[$i][0] == $_POST["noemp"]) {
                            $erreur = true;
                            $message[] = "*Erreur N° Employé existant";
                        }
                    }
                    if ($erreur == false) {
                        $noemp = $_POST["noemp"];
                        $nom = $_POST["nom"];
                        $prenom = $_POST["prenom"];
                        $emploi = $_POST["emploi"];
                        $embauche = $_POST["embauche"];
                        $sal = $_POST["sal"];
                        $noserv = $_POST["noserv"];
                        $sup = $_POST["sup"];
                        $comm = $_POST["comm"];

                        $bdd = mysqli_init();
                        mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                        $result = mysqli_query($bdd, "SELECT DATE_FORMAT(SYSDATE(), '%Y-%m-%d')");
                        $data = mysqli_fetch_all($result);
                        mysqli_free_result($result);
                        $ajout = $data[0][0];
                        mysqli_query($bdd, "INSERT INTO employes (noemp, nom, prenom, emploi, embauche, sal, noserv, ajout) 
                                    VALUES ($noemp, '$nom', '$prenom', '$emploi', '$embauche', $sal, $noserv, '$ajout')");
                        if (isset($_POST["sup"])) {
                            $result = mysqli_query($bdd, "SELECT noemp from employes");
                            $donnees = mysqli_fetch_all($result);
                            mysqli_free_result($result);
                            for ($i = 0; $i < count($donnees); $i++) {
                                if ($donnees[$i][0] != $_POST["sup"]) {
                                    mysqli_query($bdd, "UPDATE employes SET sup = $sup WHERE noemp = $noemp");
                                }
                            }
                        } else {
                            $sup = NULL;
                            mysqli_query($bdd, "UPDATE employes SET sup = $sup WHERE noemp = $noemp");
                        }
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
    ?>
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='style_formulaire'>
                                <legend>Ajouter</legend>
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
                                                                                                                                                    } ?>' required autofocus>
                                    <label for='nomPersonne'>Nom</label>
                                    <br>
                                    <input id='nomPersonne' type='text' class='form-control' name='nom' placeholder='Entrez votre nom' value='<?php if ($erreur == true) {
                                                                                                                                                    echo $_POST["nom"];
                                                                                                                                                } ?>' required>
                                    <label for='prenomPersonne'>Prénom</label>
                                    <br>
                                    <input id='prenomPersonne' type='text' class='form-control' name='prenom' placeholder='Entrez votre prénom' value='<?php if ($erreur == true) {
                                                                                                                                                            echo $_POST["prenom"];
                                                                                                                                                        } ?>' required>
                                    <label for='emploiPersonne'>Emploi</label>
                                    <br>
                                    <input id='emploiPersonne' type='text' class='form-control' name='emploi' placeholder='Entrez votre emploi' value='<?php if ($erreur == true) {
                                                                                                                                                            echo $_POST["emploi"];
                                                                                                                                                        } ?>' required>
                                    <label for='nosup'>N° Supérieur</label>
                                    <br>
                                    <input id='nosup' type='number' class='form-control' name='sup' placeholder='Entrez N° supérieur' value='<?php if ($erreur == true) {
                                                                                                                                                    echo $_POST["sup"];
                                                                                                                                                } ?>'>
                                    <label for='dateembauche'>Date d'embauche</label>
                                    <br>
                                    <input id='dateembauche' type='date' class='form-control' name='embauche' required value='<?php if ($erreur == true) {
                                                                                                                                    echo $_POST["embauche"];
                                                                                                                                } ?>'>
                                    <label for='salaire'>Salaire</label>
                                    <br>
                                    <input id='salaire' type='number' step=any class='form-control' name='sal' placeholder='Entrez votre salaire' value='<?php if ($erreur == true) {
                                                                                                                                                                echo $_POST["sal"];
                                                                                                                                                            } ?>' required>
                                    <label for='commission'>Commission</label>
                                    <br>
                                    <input id='commission' type='number' step=any class='form-control' name='comm' placeholder='Entrez votre commission' value='<?php if ($erreur == true) {
                                                                                                                                                                    echo $_POST["comm"];
                                                                                                                                                                } ?>'>
                                    <label for='noService'>N° Service</label>
                                    <br>
                                    <input id='noService' type='number' class='form-control' name='noserv' placeholder='Entrez N° service' value='<?php if ($erreur == true) {
                                                                                                                                                        echo $_POST["noserv"];
                                                                                                                                                    } ?>' required>
                                    <input type='submit' class='btn btn-success btn-sm' name='ajouter' value='Ajouter'>
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
                    $bdd = mysqli_init();
                    mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                    $result = mysqli_query($bdd, "SELECT noserv from services");
                    $donnees = mysqli_fetch_all($result);
                    mysqli_free_result($result);
                    mysqli_close($bdd);
                    for ($i = 0; $i < count($donnees); $i++) {
                        if ($donnees[$i][0] == $_POST["noserv"]) {
                            $erreur = true;
                            $message[] = "*Erreur N° Service existant";
                        }
                    }
                    if ($erreur == false) {
                        $noserv = $_POST["noserv"];
                        $service = $_POST["service"];
                        $ville = $_POST["ville"];

                        $bdd = mysqli_init();
                        mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                        $result = mysqli_query($bdd, "SELECT DATE_FORMAT(SYSDATE(), '%Y-%m-%d')");
                        $data = mysqli_fetch_all($result);
                        mysqli_free_result($result);
                        $ajout = $data[0][0];
                        mysqli_query($bdd, "INSERT INTO services (noserv, service, ville, ajout) VALUES ($noserv, '$service', '$ville', '$ajout')");
                        mysqli_close($bdd);

                        header("Location: emp_serv.php");
                    }
                }
            ?>
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div class='style_formulaire'>
                                <legend>Ajouter</legend>
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
                                                                                                                                                        } ?>' required autofocus>
                                    <label for='serv'>Service</label>
                                    <br>
                                    <input id='serv' type='text' class='form-control' name='service' placeholder='Entrez le service' value='<?php if ($erreur == true) {
                                                                                                                                                echo $_POST["service"];
                                                                                                                                            } ?>' required>
                                    <label for='vill'>Ville</label>
                                    <br>
                                    <input id='vill' type='text' class='form-control' name='ville' placeholder='Entrez la ville' value='<?php if ($erreur == true) {
                                                                                                                                            echo $_POST["ville"];
                                                                                                                                        } ?>' required>
                                    <input type='submit' class='btn btn-success btn-sm' name='ajouter' value='Ajouter'>
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