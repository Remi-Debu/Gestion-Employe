<?php
include_once(__DIR__ . "/../View/HtmlHeadView.php");
include_once(__DIR__ . "/../View/AjouterView.php");
include_once(__DIR__ . "/../Service/EmployeService.php");
include_once(__DIR__ . "/../Service/ServiceService.php");

$title = "Ajouter";
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

                $dataSelectNoemp = (new EmployeService())->displayEmp();

                for ($i = 0; $i < count($dataSelectNoemp); $i++) {
                    if ($dataSelectNoemp[$i][0] == $_POST["noemp"]) {
                        $erreur = true;
                        $message[] = "*Erreur N° Employé existant";
                    }
                }
                if ($erreur == false) {
                    $dataTodaySelect = (new EmployeService())->selectToday();
                    $ajout = $dataTodaySelect[0][0];

                    $service = (new Service())->setNoserv($_POST["noserv"]);

                    $employe = (new Employe())
                        ->setNoemp($_POST["noemp"])
                        ->setNom($_POST["nom"])
                        ->setPrenom($_POST["prenom"])
                        ->setEmploi($_POST["emploi"])
                        ->setEmbauche($_POST["embauche"])
                        ->setSal($_POST["sal"])
                        ->setSup($_POST["sup"])
                        ->setComm($_POST["comm"])
                        ->setService($service)
                        ->setAjout($ajout);

                    (new EmployeService())->addEmp($employe);

                    if (isset($_POST["sup"])) {
                        for ($i = 0; $i < count($dataSelectNoemp); $i++) {
                            if ($dataSelectNoemp[$i][0] != $_POST["sup"]) {
                                (new EmployeService())->updateSup($employe);
                            }
                        }
                    } else {
                        $employe->setSup(NULL);
                        (new EmployeService())->updateSup($employe);
                    }
                    if (isset($_POST["comm"])) {
                        (new EmployeService())->updateComm($employe);
                    } else {
                        $employe->setComm(NULL);
                        (new EmployeService())->updateComm($employe);
                    }
                    header("Location: /Controller/AccueilController.php");
                }
            }
            $message[] = NULL;
            formulaireEmployeAjouter($erreur, $message);
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

                $dataSelectNoserv = (new ServiceService())->displayServ();

                for ($i = 0; $i < count($dataSelectNoserv); $i++) {
                    if ($dataSelectNoserv[$i][0] == $_POST["noserv"]) {
                        $erreur = true;
                        $message[] = "*Erreur N° Service existant";
                    }
                }
                if ($erreur == false) {
                    $dataTodaySelect = (new EmployeService())->selectToday();
                    $ajout = $dataTodaySelect[0][0];

                    $service = (new Service())->setNoserv($_POST["noserv"])->setService($_POST["service"])->setVille($_POST["ville"])->setAjout($ajout);
                    (new ServiceService())->addServ($service);
                    header("Location: /Controller/AccueilController.php");
                }
            }
            $message[] = NULL;
            formulaireServiceAjouter($erreur, $message);
        }
    } else {
        header("location: /Controller/AccueilController.php");
    }
} else {
    header("location: /Controller/AccueilController.php");
}
?>
