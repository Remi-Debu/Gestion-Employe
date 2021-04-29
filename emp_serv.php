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
    // GESTION DES POSTS
    $erreur_insc = false;
    $erreur_co = false;
    if (!empty($_POST)) {
        if (isset($_POST["sinscrire"]) || isset($_POST["login"])) {
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

                $bdd = mysqli_init();
                mysqli_real_connect($bdd, "127.0.0.1", "admin", "admin", "emp_serv");
                mysqli_query($bdd, "INSERT INTO utilisateurs (nom, mdp) VALUES ('$identifiant', '$hashed_mdp')");
                mysqli_close($bdd);
                header("Location: emp_serv.php");
            }
        }
        if (isset($_POST["seconnecter"])) {
            if (!isset($_POST["ident"]) || empty($_POST["ident"])) {
                $erreur_co = true;
            }
            if (!isset($_POST["mdp"]) || empty($_POST["mdp"])) {
                $erreur_co = true;
            }
            if ($erreur_co == false) {
                $identifiant = $_POST['ident'];
                $mdp = $_POST['mdp'];

                $bdd = mysqli_init();
                mysqli_real_connect($bdd, "127.0.0.1", "admin", "admin", "emp_serv");
                $result = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE nom = '$identifiant'");
                $data = mysqli_fetch_all($result);
                mysqli_free_result($result);
                mysqli_close($bdd);
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
                                <a class="button_deco" href="emp_serv_deco.php"><button type="button" class="btn btn-primary">Déconnexion</button></a>
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
        $bdd = mysqli_init();
        mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
        $result = mysqli_query($bdd, "SELECT e.noemp, e.nom, e.prenom, e.emploi, concat(e2.nom, ' ', e2.prenom) AS 'nom sup', e.noserv, s.service, e.sup FROM employes AS e
                                      INNER JOIN services AS s on e.noserv = s.noserv
                                      INNER JOIN employes AS e2 on e.sup = e2.noemp OR e.sup IS NULL
                                      GROUP BY noemp ORDER BY e.noserv, e.noemp ASC");
        $donnees = mysqli_fetch_all($result);
        mysqli_free_result($result);
        $result2 = mysqli_query($bdd, "SELECT e2.noemp from employes e INNER JOIN employes e2 on e.sup = e2.noemp GROUP BY e2.noemp");
        $donnees2 = mysqli_fetch_all($result2);
        mysqli_free_result($result2);
        $result3 = mysqli_query($bdd, "SELECT s.noserv FROM services s INNER JOIN employes e ON s.noserv = e.noserv GROUP BY s.noserv");
        $donnees3 = mysqli_fetch_all($result3);
        mysqli_free_result($result3);
        mysqli_close($bdd);
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
                                    $bdd = mysqli_init();
                                    mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                                    $result = mysqli_query($bdd, "SELECT COUNT(*) FROM employes WHERE ajout = DATE_FORMAT(SYSDATE(), '%Y-%m-%d')");
                                    $data = mysqli_fetch_all($result);
                                    mysqli_free_result($result);
                                    mysqli_close($bdd);
                                    echo $data[0][0];
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
                            $i = 0;
                            while ($i < count($donnees)) {
                                $displayRemove = false;
                                if ($donnees[$i][7] == NULL) {
                                    $donnees[$i][4] = "═════════";
                                }
                                $get_noemp = $donnees[$i][0];
                                echo "<tr><td>" . $donnees[$i][1] . "</td>";
                                echo "<td>" . $donnees[$i][2] . "</td>";
                                echo "<td>" . $donnees[$i][3] . "</td>";
                                echo "<td>" . $donnees[$i][4] . "</td>";
                                echo "<td>" . $donnees[$i][5] . "</td>";
                                echo "<td>" . $donnees[$i][6] . "</td>";
                                if (isset($_SESSION["admin"])) {
                                    if ($_SESSION["admin"] == "Y") {
                                        echo "<td><a href='emp_serv_details.php?noemp=$get_noemp'><button class='btn btn-info btn-sm'>Détails</button></a></td>";
                                        echo "<td><a href='emp_serv_modif.php?noemp=$get_noemp'><button class='btn btn-warning btn-sm'>Modifier</button></a></td>";

                                        for ($j = 0; $j < count($donnees2); $j++) {
                                            if ($donnees[$i][0] == $donnees2[$j][0]) {
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
                                $i++;
                            }
                            ?>
                        </table>
                    </div>
                </div>

                <?php
                // PARTIE SERVICES
                $bdd = mysqli_init();
                mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                $result = mysqli_query($bdd, "SELECT * FROM services");
                $donnees = mysqli_fetch_all($result);
                mysqli_free_result($result);
                mysqli_close($bdd);
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
                                    $bdd = mysqli_init();
                                    mysqli_real_connect($bdd, "127.0.0.1", "root", "", "emp_serv");
                                    $result = mysqli_query($bdd, "SELECT COUNT(*) FROM services WHERE ajout = DATE_FORMAT(SYSDATE(), '%Y-%m-%d')");
                                    $data = mysqli_fetch_all($result);
                                    mysqli_free_result($result);
                                    mysqli_close($bdd);
                                    echo $data[0][0];
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
                            $i = 0;
                            while ($i < count($donnees)) {
                                $displayRemove = false;
                                $get_noserv = $donnees[$i][0];
                                echo "<tr><td>" . $donnees[$i][0] . "</td>";
                                echo "<td>" . $donnees[$i][1] . "</td>";
                                echo "<td>" . $donnees[$i][2] . "</td>";

                                if (isset($_SESSION["admin"])) {
                                    if ($_SESSION["admin"] == "Y") {
                                        echo "<td><a href='emp_serv_details.php?noserv=$get_noserv'><button class='btn btn-info btn-sm'>Détails</button></a></td>";
                                        echo "<td><a href='emp_serv_modif.php?noserv=$get_noserv'><button class='btn btn-warning btn-sm'>Modifier</button></a></td>";
                                        for ($j = 0; $j < count($donnees3); $j++) {
                                            if ($donnees[$i][0] == $donnees3[$j][0]) {
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
                                $i++;
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
</body>

</html>