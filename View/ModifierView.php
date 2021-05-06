<?php
function formulaireEmployeModifier(
    bool $erreur,
    array $message,
    int $preselec_noemp,
    string $preselec_nom,
    string $preselec_prenom,
    string $preselec_emploi,
    ?int $preselec_sup,
    string $preselec_superieur,
    string $preselec_embauche,
    float $preselec_sal,
    ?float $preselec_comm,
    string $preselec_service
): void {
?>

    <body>
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

                        <a href='/Controller/AccueilController.php'><button class='btn btn-primary btn-lg'>Page d'Accueil</button></a>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
}
?>

<?php
function formulaireServiceModifier(
    bool $erreur,
    array $message,
    int $preselec_noserv,
    string $preselec_service,
    string $preselec_ville
): void {
?>

    <body>
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

                        <a href='/Controller/AccueilController.php'><button class='btn btn-primary btn-lg'>Page d'Accueil</button></a>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
}
?>