<?php
function formulaireEmployeSupprimer(
    int $preselec_noemp,
    string $preselec_nom,
    string $preselec_prenom,
    string $preselec_emploi,
    string $preselec_embauche,
    ?int $preselec_sup,
    string $preselec_superieur,
    string $preselec_serv
): void {
?>

    <body>
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

                        <a href='/gestion-employe/Controller/AccueilController.php'><button class='btn btn-primary btn-lg'>Page d'Accueil</button></a>
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
function formulaireServiceSupprimer(
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

                        <a href='/gestion-employe/Controller/AccueilController.php'><button class='btn btn-primary btn-lg'>Page d'Accueil</button></a>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
}
?>