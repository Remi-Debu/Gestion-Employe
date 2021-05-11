<?php
function formulaireEmployeAjouter(bool $erreur, array $message): void
{
?>

    <body>
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
function formulaireServiceAjouter(bool $erreur, array $message): void
{
?>

    <body>
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