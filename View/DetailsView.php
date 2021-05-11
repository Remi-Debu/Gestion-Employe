<?php
function formulaireEmployeDetails(
    int $preselec_noemp,
    ?int $preselec_sup,
    string $preselec_nom,
    string $preselec_prenom,
    string $preselec_emploi,
    string $preselec_embauche,
    float $preselec_sal,
    ?float $preselec_comm,
    int $preselec_noserv
): void {
?>

    <body>
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
function formulaireServiceDetails(int $preselec_noserv, string $preselec_service, string $preselec_ville): void
{
?>

    <body>
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