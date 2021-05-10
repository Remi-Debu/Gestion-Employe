<?php
function accueilHeader(bool $erreur_insc, bool $erreur_co): void
{
?>

    <!DOCTYPE html>
    <html lang="en">
    <?php 
    $title = "Accueil";
    HTMLHead($title);
    ?>
    <body>
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <a href="/Style/Logo.png"><img src="/Style/Logo.png" alt="Accueil"></a>
                        <audio controls loop src="/Style/StarWars.mp3">ERROR</audio>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>

<?php
}
?>

<?php
function afficherTableEmploye(array $dataDisplayEmp, array $dataSup): void
{
?>

    <body>
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
                                        <a href='AjouterController.php?noemp=$get_noemp'><button class='btn btn-success btn-sm btn-ajout'>+</button></a>
                                <?php
                                    }
                                }
                                ?>
                                <span class="counter">
                                    <?php
                                    $dataAddCounterEmp = (new EmployeService())->counterEmp();
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
                            foreach ($dataDisplayEmp as $value) {
                                $displayRemove = false;
                                if ($value->getSup() == NULL) {
                                    $value->setSuperieur((new Employe())->setNom("═════════"));
                                }
                                $get_noemp = $value->getNoemp();
                                echo "<tr><td>" . $value->getNom() . "</td>";
                                echo "<td>" . $value->getPrenom() . "</td>";
                                echo "<td>" . $value->getEmploi() . "</td>";
                                echo "<td>" . $value->getSuperieur()->getNom() . " " . $value->getSuperieur()->getPrenom() . "</td>";
                                echo "<td>" . $value->getService()->getNoserv() . "</td>";
                                echo "<td>" . $value->getService()->getService() . "</td>";
                                if (isset($_SESSION["admin"])) {
                                    if ($_SESSION["admin"] == "Y") {
                                        echo "<td><a href='DetailsController.php?noemp=$get_noemp'><button class='btn btn-info btn-sm'>Détails</button></a></td>";
                                        echo "<td><a href='ModifierController.php?noemp=$get_noemp'><button class='btn btn-warning btn-sm'>Modifier</button></a></td>";

                                        for ($j = 0; $j < count($dataSup); $j++) {
                                            if ($value->getNoemp() == $dataSup[$j][0]) {
                                                $displayRemove = true;
                                            }
                                        }
                                        if ($displayRemove == true) {
                                            echo "<td></td></tr>";
                                        } else {
                                            echo "<td><a href='SupprimerController.php?noemp=$get_noemp'><button class='btn btn-danger btn-sm'>Supprimer</button></a></td></tr>";
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
    </body>

<?php
}
?>

<?php
function afficherTableService(?array $dataService, ?array $dataServWithEmp): void
{
?>

    <body>
        <div class="col-lg-5">
            <div class="table_serv">
                <table class="table table-striped table-dark table-hover">
                    <legend>SERVICES
                        <?php
                        if (isset($_SESSION["admin"])) {
                            if ($_SESSION["admin"] == "Y") {
                        ?>
                                <a href='AjouterController.php?noserv=$get_noserv'><button class='btn btn-success btn-sm btn-ajout'>+</button></a>
                        <?php
                            }
                        }
                        ?>
                        <span class="counter">
                            <?php
                            $dataAddCounterServ = (new ServiceService())->counterServ();
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
                    foreach ($dataService as $value) {
                        $displayRemove = false;
                        $get_noserv = $value->getNoserv();
                        echo "<tr><td>" . $value->getNoserv() . "</td>";
                        echo "<td>" . $value->getService() . "</td>";
                        echo "<td>" . $value->getVille() . "</td>";

                        if (isset($_SESSION["admin"])) {
                            if ($_SESSION["admin"] == "Y") {
                                echo "<td><a href='DetailsController.php?noserv=$get_noserv'><button class='btn btn-info btn-sm'>Détails</button></a></td>";
                                echo "<td><a href='ModifierController.php?noserv=$get_noserv'><button class='btn btn-warning btn-sm'>Modifier</button></a></td>";
                                for ($j = 0; $j < count($dataServWithEmp); $j++) {
                                    if ($value->getNoserv() == $dataServWithEmp[$j][0]) {
                                        $displayRemove = true;
                                    }
                                }
                                if ($displayRemove == true) {
                                    echo "<td></td></tr>";
                                } else {
                                    echo "<td><a href='SupprimerController.php?noserv=$get_noserv'><button class='btn btn-danger btn-sm'>Supprimer</button></a></td></tr>";
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
    </body>

<?php
}
?>

<?php
function afficherFooter(): void
{
?>

    <body>
        <footer>
            <div class="container-fluid">
                <div class="row footer">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
        </footer>
    </body>

<?php
}
?>