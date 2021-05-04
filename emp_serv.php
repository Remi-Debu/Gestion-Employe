<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="emp_serv.css">
    <title>Accueil</title>
</head>

<body>
    <?php
    include_once("DAO/EmployeDAO.php");
    include_once("DAO/ServiceDAO.php");
    include_once("DAO/UtilisateurDAO.php");

    // GESTION DES POSTS
    $erreur_insc = false;
    $erreur_co = false;
    if (!empty($_POST)) {
        if (isset($_POST["sinscrire"])) {
            $erreur_insc = inscription();
        }
        if (isset($_POST["seconnecter"])) {
            $erreur_co = connexion();
        }
        if (isset($_POST["deconnexion"])) {
            deconnexion();
        }
    }
    ?>

    <!-- HEADER -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <a href="emp_serv.php"><img src="emp_serv_logo.png" alt="Accueil"></a>
                    <audio controls loop src="StarWars.mp3">ERROR</audio>
                </div>
                <div class="col-lg-8">
                    <div class="gestion_compte">
                        <?php
                        if (!isset($_SESSION)) {
                            session_start();
                        }
                        if (isset($_SESSION['ident'])) {
                            echo "<div class='display_ident'>" . $_SESSION['ident'] . "</div>";
                        ?>
                            <div class="button_deco">
                                <form action="" method="POST">
                                    <input type="submit" class="btn btn-primary" style="margin:0;margin-bottom:6px;" name="deconnexion" value="Déconnexion">
                                </form>
                            </div>
                        <?php
                        } else {
                        ?>
                            <!-- Button Modal Connexion-->
                            <button type="button" class="btn btn-primary button_conn" data-bs-toggle="modal" data-bs-target="#conn_modal">
                                Connexion
                            </button>

                            <!-- Button Modal Inscription-->
                            <button type="button" class="btn btn-primary button_insc" data-bs-toggle="modal" data-bs-target="#insc_modal">
                                Inscription
                            </button>
                        <?php
                        }
                        if ($erreur_insc == true) {
                        ?>
                            <div class="erreur_insc"><span>Inscription invalide</span></div>
                        <?php
                        }
                        if ($erreur_co == true) {
                        ?>
                            <div class="erreur_co">Invalides :<br>- Nom de compte<br>- Mot de passe</div>
                        <?php
                        }
                        ?>

                        <!-- Modal Connexion -->
                        <div class="modal fade" id="conn_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <label for="identifiant">Nom de compte</label>
                                            <input id="identifiant" type="text" class="form-control" name="ident" placeholder="Entrer votre nom de compte" required>

                                            <label for="motdepasse">Mot de Passe</label>
                                            <input id="motdepasse" type="password" class="form-control" name="mdp" placeholder="Entrer votre mot de passe" required>

                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary" name="seconnecter" value="Se connecter">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Inscription -->
                        <div class="modal fade" id="insc_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Inscription</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">

                                            <label for="identifiant">Nom de compte</label>
                                            <input id="identifiant" type="text" class="form-control" name="ident" placeholder="Entrer votre nom de compte" size="1000" required>

                                            <label for="motdepasse">Mot de Passe</label>
                                            <input id="motdepasse" type="password" class="form-control" name="mdp" placeholder="Entrer votre mot de passe" required>

                                            <label for="motdepasse">Confirmation du Mot de Passe</label>
                                            <input id="motdepasse" type="password" class="form-control" name="confmdp" placeholder="Confirmer votre mot de passe" required>

                                            <input id="accepter" type="checkbox" class="form-check-input button_accept" name="accepte" required>
                                            <label for="accepter" class="form-check-label">J'accepte les conditions générales d'utilisation</label>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary" name="sinscrire" value="S'inscrire">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php
    if (isset($_SESSION["admin"])) {

        // PARTIE EMPLOYÉS
        $dataDisplayEmp = (new EmployeDAO())->displayEmp();
        $dataSup = (new EmployeDAO())->sup();
        $dataServWithEmp = (new ServiceDAO())->servWithEmp();
    ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7">
                    <div class="table_emp">
                        <table class="table table-striped table-dark table-hover">
                            <legend>EMPLOYÉS
                                <?php
                                if (isset($_SESSION["admin"])) {
                                    if ($_SESSION["admin"] == "Y") {
                                ?>
                                        <a href='emp_serv_ajout.php?noemp=$get_noemp'><button class='btn btn-success btn-sm btn-ajout'>+</button></a>
                                <?php
                                    }
                                }
                                ?>
                                <span class="counter">
                                    <?php
                                    $dataAddCounterEmp = (new EmployeDAO())->counterEmp();
                                    echo $dataAddCounterEmp[0][0];
                                    ?>
                                </span>
                            </legend>
                            <hr>
                            <thead class="table-dark" style="font-size: 1.5rem;">
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Emploi</th>
                                    <th>Supérieur</th>
                                    <th>N° Serv</th>
                                    <th>Service</th>
                                    <?php
                                    if (isset($_SESSION["admin"])) {
                                        if ($_SESSION["admin"] == "Y") {
                                            echo "<th></th><th></th><th></th>";
                                        }
                                    }
                                    ?>
                                </tr>
                            </thead>

                            <?php
                            for ($i = 0; $i < count($dataDisplayEmp); $i++) {
                                $displayRemove = false;
                                if ($dataDisplayEmp[$i][7] == NULL) {
                                    $dataDisplayEmp[$i][4] = "═════════";
                                }
                                $get_noemp = $dataDisplayEmp[$i][0];
                                echo "<tr><td>" . $dataDisplayEmp[$i][1] . "</td>";
                                echo "<td>" . $dataDisplayEmp[$i][2] . "</td>";
                                echo "<td>" . $dataDisplayEmp[$i][3] . "</td>";
                                echo "<td>" . $dataDisplayEmp[$i][4] . "</td>";
                                echo "<td>" . $dataDisplayEmp[$i][5] . "</td>";
                                echo "<td>" . $dataDisplayEmp[$i][6] . "</td>";
                                if (isset($_SESSION["admin"])) {
                                    if ($_SESSION["admin"] == "Y") {
                                        echo "<td><a href='emp_serv_details.php?noemp=$get_noemp'><button class='btn btn-info btn-sm'>Détails</button></a></td>";
                                        echo "<td><a href='emp_serv_modif.php?noemp=$get_noemp'><button class='btn btn-warning btn-sm'>Modifier</button></a></td>";

                                        for ($j = 0; $j < count($dataSup); $j++) {
                                            if ($dataDisplayEmp[$i][0] == $dataSup[$j][0]) {
                                                $displayRemove = true;
                                            }
                                        }
                                        if ($displayRemove == true) {
                                            echo "<td></td></tr>";
                                        } else {
                                            echo "<td><a href='emp_serv_supp.php?noemp=$get_noemp'><button class='btn btn-danger btn-sm'>Supprimer</button></a></td></tr>";
                                        }
                                    } else {
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>

                <?php
                // PARTIE SERVICES
                $dataServices = (new ServiceDAO())->displayServ();
                ?>

                <div class="col-lg-5">
                    <div class="table_serv">
                        <table class="table table-striped table-dark table-hover">
                            <legend>SERVICES
                                <?php
                                if (isset($_SESSION["admin"])) {
                                    if ($_SESSION["admin"] == "Y") {
                                ?>
                                        <a href='emp_serv_ajout.php?noserv=$get_noserv'><button class='btn btn-success btn-sm btn-ajout'>+</button></a>
                                <?php
                                    }
                                }
                                ?>
                                <span class="counter">
                                    <?php
                                    $dataAddCounterServ = (new ServiceDAO())->counterServ();
                                    echo $dataAddCounterServ[0][0];
                                    ?>
                                </span>
                            </legend>
                            <hr>
                            <thead class="table-dark" style="font-size: 1.5rem;">
                                <tr>
                                    <th>N° Service</th>
                                    <th>Service</th>
                                    <th>Ville</th>
                                    <?php
                                    if (isset($_SESSION["admin"])) {
                                        if ($_SESSION["admin"] == "Y") {
                                            echo "<th></th><th></th><th></th>";
                                        }
                                    }
                                    ?>
                                </tr>
                            </thead>

                            <?php
                            for ($i = 0; $i < count($dataServices); $i++) {
                                $displayRemove = false;
                                $get_noserv = $dataServices[$i][0];
                                echo "<tr><td>" . $dataServices[$i][0] . "</td>";
                                echo "<td>" . $dataServices[$i][1] . "</td>";
                                echo "<td>" . $dataServices[$i][2] . "</td>";

                                if (isset($_SESSION["admin"])) {
                                    if ($_SESSION["admin"] == "Y") {
                                        echo "<td><a href='emp_serv_details.php?noserv=$get_noserv'><button class='btn btn-info btn-sm'>Détails</button></a></td>";
                                        echo "<td><a href='emp_serv_modif.php?noserv=$get_noserv'><button class='btn btn-warning btn-sm'>Modifier</button></a></td>";
                                        for ($j = 0; $j < count($dataServWithEmp); $j++) {
                                            if ($dataServices[$i][0] == $dataServWithEmp[$j][0]) {
                                                $displayRemove = true;
                                            }
                                        }
                                        if ($displayRemove == true) {
                                            echo "<td></td></tr>";
                                        } else {
                                            echo "<td><a href='emp_serv_supp.php?noserv=$get_noserv'><button class='btn btn-danger btn-sm'>Supprimer</button></a></td></tr>";
                                        }
                                    } else {
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <footer>
            <div class="container-fluid">
                <div class="row footer">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
        </footer>
    <?php
    }
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <?php
    // FONCTIONS
    function inscription(): bool
    {
        $erreur_insc = false;
        if (!isset($_POST["ident"]) || empty($_POST["ident"]) || !preg_match("#^[A-Za-z0-9]{5,20}$#", $_POST["ident"])) {
            $erreur_insc = true;
        }
        if (!isset($_POST["mdp"]) || empty($_POST["mdp"]) || !preg_match("#^[A-Za-z0-9-_@./]{5,20}$#", $_POST["mdp"])) {
            $erreur_insc = true;
        }
        if (!isset($_POST["confmdp"]) || empty($_POST["confmdp"]) || $_POST["confmdp"] != $_POST["mdp"]) {
            $erreur_insc = true;
        }
        if (!isset($_POST["accepte"]) || empty($_POST["accepte"])) {
            $erreur_insc = true;
        }
        if ($erreur_insc == false) {
            $identifiant = $_POST['ident'];
            $mdp = $_POST['mdp'];
            $hashed_mdp = password_hash($mdp, PASSWORD_DEFAULT);

            (new UtilisateurDAO())->addUser($identifiant, $hashed_mdp);
        }
        return $erreur_insc;
    }

    function connexion(): bool
    {
        $erreur_co = false;
        if (!isset($_POST["ident"]) || empty($_POST["ident"])) {
            $erreur_co = true;
        }
        if (!isset($_POST["mdp"]) || empty($_POST["mdp"])) {
            $erreur_co = true;
        }
        if ($erreur_co == false) {
            $identifiant = $_POST['ident'];
            $mdp = $_POST['mdp'];

            $data = (new UtilisateurDAO)->selectUser($identifiant);

            if (isset($data[0][2])) {
                $verif_data = $data[0][2];
                $verif_mdp = password_verify($mdp, $verif_data);

                if ($verif_mdp == true) {
                    session_start();
                    $_SESSION["ident"] = $identifiant;
                    $_SESSION["admin"] = $data[0][3];
                } else {
                    $erreur_co = true;
                }
            } else {
                $erreur_co = true;
            }
        }
        return $erreur_co;
    }

    function deconnexion()
    {
        session_start();
        session_destroy();
        header("location:emp_serv.php");
        exit();
    }
    ?>

</body>

</html>