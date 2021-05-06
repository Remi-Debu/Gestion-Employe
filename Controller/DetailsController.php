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
            foreach ($dataDisplayEmp as $key => $value) {
                if ($_GET['noemp'] == $dataDisplayEmp[$key]->getNoemp()) {
                    $preselec_noemp = $dataDisplayEmp[$key]->getNoemp();
                    $preselec_nom = $dataDisplayEmp[$key]->getNom();
                    $preselec_prenom = $dataDisplayEmp[$key]->getPrenom();
                    $preselec_emploi = $dataDisplayEmp[$key]->getEmploi();
                    $preselec_sup = $dataDisplayEmp[$key]->getSup();
                    $preselec_noserv = $dataDisplayEmp[$key]->getService()->getNoserv();
                    $preselec_embauche = $dataDisplayEmp[$key]->getEmbauche();
                    $preselec_sal = $dataDisplayEmp[$key]->getSal();
                    $preselec_comm = $dataDisplayEmp[$key]->getComm();
                }
            }
            formulaireEmployeDetails($preselec_noemp, $preselec_sup, $preselec_nom, $preselec_prenom, $preselec_emploi, $preselec_embauche, $preselec_sal, $preselec_comm, $preselec_noserv);
        }

        if (isset($_GET['noserv'])) {
            $dataDisplayServ = (new ServiceService())->displayServ();
            foreach ($dataDisplayServ as $key => $value) {
                if ($_GET['noserv'] == $dataDisplayServ[$key]->getNoserv()) {
                    $preselec_noserv = $dataDisplayServ[$key]->getNoserv();
                    $preselec_service = $dataDisplayServ[$key]->getService();
                    $preselec_ville = $dataDisplayServ[$key]->getVille();
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
