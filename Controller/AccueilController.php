<?php
include_once("../View/HtmlHeadView.php");
include_once("../View/AccueilView.php");
include_once("../Service/EmployeService.php");
include_once("../Service/ServiceService.php");
include_once("../Service/UtilisateurService.php");
require_once("../Exception/ServiceServiceException.php");

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
        session_start();
        session_destroy();
        header("location: /gestion-employe/Controller/AccueilController.php");
        exit();
    }
}

// HEADER
accueilHeader($erreur_insc, $erreur_co);

if (isset($_SESSION["admin"])) {

    // PARTIE EMPLOYÉS
    try {
        $dataDisplayEmp = (new EmployeService())->displayEmp();
        $dataSup = (new EmployeService())->sup();
        afficherTableEmploye($dataDisplayEmp, $dataSup, NULL, NULL);
    } catch (EmployeServiceException $e) {
        afficherTableEmploye(NULL, NULL, $e->getCode(), $e->getMessage());
    }

    // PARTIE SERVICES
    try {
        $dataService = (new ServiceService())->displayServ();
        $dataServWithEmp = (new ServiceService())->servWithEmp();
        afficherTableService($dataService, $dataServWithEmp, null);
    } catch (ServiceServiceException $e) {
        afficherTableService(null, null, $e->getCode(), $e->getMessage());
    }

    // FOOTER
    afficherFooter();
}
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

        (new UtilisateurService())->addUser($identifiant, $mdp);
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

        $data = (new UtilisateurService())->selectUser($identifiant);

        if (null !== $data[0]->getMdp()) {
            $verif_data = $data[0]->getMdp();
            $verif_mdp = password_verify($mdp, $verif_data);

            if ($verif_mdp == true) {
                session_start();
                (new UtilisateurService())->session($identifiant, $data);
            } else {
                $erreur_co = true;
            }
        } else {
            $erreur_co = true;
        }
    }
    return $erreur_co;
}
