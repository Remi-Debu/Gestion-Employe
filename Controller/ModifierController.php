<?php
include_once(__DIR__ . "/../View/HtmlHeadView.php");
include_once(__DIR__ . "/../View/ModifierView.php");
include_once(__DIR__ . "/../Service/EmployeService.php");
include_once(__DIR__ . "/../Service/ServiceService.php");

$title = "Modification";
htmlhead($title);

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

                    (new EmployeService())->updateEmp($employe);

                    if (isset($_POST["comm"])) {
                        (new EmployeService())->updateComm($employe);
                    } else {
                        $comm = NULL;
                        (new EmployeService())->updateComm($employe);
                    }
                    header("Location: /Controller/AccueilController.php");
                }
            }

            $dataDisplayEmp = (new EmployeService())->displayEmpModif();

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
            $message[] = NULL;
            formulaireEmployeModifier(
                $erreur,
                $message,
                $preselec_noemp,
                $preselec_nom,
                $preselec_prenom,
                $preselec_emploi,
                $preselec_sup,
                $preselec_superieur,
                $preselec_embauche,
                $preselec_sal,
                $preselec_comm,
                $preselec_service
            );
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
                    (new ServiceService())->updateServ($service);
                    header("Location: /Controller/AccueilController.php");
                }
            }
            $dataDisplayServ = (new ServiceService())->displayServ();

            for ($i = 0; $i < count($dataDisplayServ); $i++) {
                if ($_GET['noserv'] == $dataDisplayServ[$i][0]) {
                    $preselec_noserv = $dataDisplayServ[$i][0];
                    $preselec_service = $dataDisplayServ[$i][1];
                    $preselec_ville = $dataDisplayServ[$i][2];
                }
            }
            $message[] = NULL;
            formulaireServiceModifier(
                $erreur,
                $message,
                $preselec_noserv,
                $preselec_service,
                $preselec_ville
            );
        }
    } else {
        header("location: /Controller/AccueilController.php");
    }
} else {
    header("location: /Controller/AccueilController.php");
}
?>
