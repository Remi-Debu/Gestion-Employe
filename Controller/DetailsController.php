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

            for ($i = 0; $i < count($dataDisplayEmp); $i++) {
                if ($_GET['noemp'] == $dataDisplayEmp[$i][0]) {
                    $preselec_noemp = $dataDisplayEmp[$i][0];
                    $preselec_nom = $dataDisplayEmp[$i][1];
                    $preselec_prenom = $dataDisplayEmp[$i][2];
                    $preselec_emploi = $dataDisplayEmp[$i][3];
                    $preselec_sup = $dataDisplayEmp[$i][4];
                    $preselec_noserv = $dataDisplayEmp[$i][5];
                    $preselec_embauche = $dataDisplayEmp[$i][6];
                    $preselec_sal = $dataDisplayEmp[$i][7];
                    $preselec_comm = $dataDisplayEmp[$i][8];
                }
            }

            formulaireEmployeDetails($preselec_noemp, $preselec_sup, $preselec_nom, $preselec_prenom, $preselec_emploi, $preselec_embauche, $preselec_sal, $preselec_comm, $preselec_noserv);
        }

        if (isset($_GET['noserv'])) {
            $dataDisplayServ = (new ServiceService())->displayServ();
            for ($i = 0; $i < count($dataDisplayServ); $i++) {
                if ($_GET['noserv'] == $dataDisplayServ[$i][0]) {
                    $preselec_noserv = $dataDisplayServ[$i][0];
                    $preselec_service = $dataDisplayServ[$i][1];
                    $preselec_ville = $dataDisplayServ[$i][2];
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
?>
