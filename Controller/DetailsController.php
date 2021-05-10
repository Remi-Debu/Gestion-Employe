<?php
include_once(__DIR__ . "/../View/HtmlHeadView.php");
include_once(__DIR__ . "/../View/DetailsView.php");
include_once(__DIR__ . "/../Service/EmployeService.php");
include_once(__DIR__ . "/../Service/ServiceService.php");

$title = "Détails";
htmlhead($title);

session_start();
if (isset($_SESSION["admin"])) {
    if ($_SESSION["admin"] == true) {
        if (isset($_GET['noemp'])) {
            $dataDisplayEmp = (new EmployeService())->displayEmpDetails();
            foreach ($dataDisplayEmp as $value) {
                if ($_GET['noemp'] == $value->getNoemp()) {
                    $preselec_noemp = $value->getNoemp();
                    $preselec_nom = $value->getNom();
                    $preselec_prenom = $value->getPrenom();
                    $preselec_emploi = $value->getEmploi();
                    $preselec_sup = $value->getSup();
                    $preselec_noserv = $value->getService()->getNoserv();
                    $preselec_embauche = $value->getEmbauche();
                    $preselec_sal = $value->getSal();
                    $preselec_comm = $value->getComm();
                }
            }
            formulaireEmployeDetails($preselec_noemp, $preselec_sup, $preselec_nom, $preselec_prenom, $preselec_emploi, $preselec_embauche, $preselec_sal, $preselec_comm, $preselec_noserv);
        }

        if (isset($_GET['noserv'])) {
            $dataDisplayServ = (new ServiceService())->displayServ();
            foreach ($dataDisplayServ as $value) {
                if ($_GET['noserv'] == $value->getNoserv()) {
                    $preselec_noserv = $value->getNoserv();
                    $preselec_service = $value->getService();
                    $preselec_ville = $value->getVille();
                }
            }
            formulaireServiceDetails($preselec_noserv, $preselec_service, $preselec_ville);
        }
    } else {
        header("location: /Controller/AccueilController.php");
    }
} else {
    header("location: /Controller/AccueilController.php");
}
