<?php
include_once("../View/HtmlHeadView.php");
include_once("../View/SupprimerView.php");
include_once("../Service/EmployeService.php");
include_once("../Service/ServiceService.php");

$title = "Suppression";
htmlhead($title);

session_start();
if (isset($_SESSION["admin"])) {
    if ($_SESSION["admin"] == true) {
        if (isset($_GET['noemp'])) {
            if (isset($_POST["noemp"])) {
                $noemp = $_POST["noemp"];
                (new EmployeService())->deleteEmp($noemp);
                header("Location: /gestion-employe/Controller/AccueilController.php");
            }

            $dataDisplayEmp = (new EmployeService())->displayEmpSupp();
            foreach ($dataDisplayEmp as $value) {
                if ($_GET['noemp'] == $value->getNoemp()) {
                    $preselec_noemp = $value->getNoemp();
                    $preselec_nom = $value->getNom();
                    $preselec_prenom = $value->getPrenom();
                    $preselec_emploi = $value->getEmploi();
                    $preselec_embauche = $value->getEmbauche();
                    $preselec_sup = $value->getSup();
                    $preselec_noserv = $value->getService()->getNoserv();
                    $preselec_serv = $value->getService()->getService();
                    $preselec_superieur = $value->getSuperieur()->getNom() . " " . $value->getSuperieur()->getPrenom();
                }
            }
            formulaireEmployeSupprimer(
                $preselec_noemp,
                $preselec_nom,
                $preselec_prenom,
                $preselec_emploi,
                $preselec_embauche,
                $preselec_sup,
                $preselec_superieur,
                $preselec_serv
            );
        }
        if (isset($_GET['noserv'])) {
            if (isset($_POST["noserv"])) {
                $noserv = $_POST["noserv"];
                (new ServiceService())->deleteServ($noserv);
                header("Location: /gestion-employe/Controller/AccueilController.php");
            }

            $dataDisplayServ = (new ServiceService())->displayServ();
            foreach ($dataDisplayServ as $value) {
                if ($_GET['noserv'] == $value->getNoserv()) {
                    $preselec_noserv = $value->getNoserv();
                    $preselec_service = $value->getService();
                    $preselec_ville = $value->getVille();
                }
            }
            formulaireServiceSupprimer($preselec_noserv, $preselec_service, $preselec_ville);
        }
    } else {
        header("location: /gestion-employe/Controller/AccueilController.php");
    }
} else {
    header("location: /gestion-employe/Controller/AccueilController.php");
}
?>
</body>

</html>