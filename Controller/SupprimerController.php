<?php
include_once(__DIR__ . "/../View/HtmlHeadView.php");
include_once(__DIR__ . "/../View/SupprimerView.php");
include_once(__DIR__ . "/../Service/EmployeService.php");
include_once(__DIR__ . "/../Service/ServiceService.php");

$title = "Suppression";
htmlhead($title);

session_start();
if (isset($_SESSION["admin"])) {
    if ($_SESSION["admin"] == true) {
        if (isset($_GET['noemp'])) {
            if (isset($_POST["noemp"])) {
                $noemp = $_POST["noemp"];
                (new EmployeService())->deleteEmp($noemp);
                header("Location: /Controller/AccueilController.php");
            }

            $dataDisplayEmp = (new EmployeService())->displayEmpSupp();
            foreach ($dataDisplayEmp as $key => $value) {
                if ($_GET['noemp'] == $dataDisplayEmp[$key][0]->getNoemp()) {
                    $preselec_noemp = $dataDisplayEmp[$key][0]->getNoemp();
                    $preselec_nom = $dataDisplayEmp[$key][0]->getNom();
                    $preselec_prenom = $dataDisplayEmp[$key][0]->getPrenom();
                    $preselec_emploi = $dataDisplayEmp[$key][0]->getEmploi();
                    $preselec_embauche = $dataDisplayEmp[$key][0]->getEmbauche();
                    $preselec_sup = $dataDisplayEmp[$key][0]->getSup();
                    $preselec_noserv = $dataDisplayEmp[$key][0]->getService()->getNoserv();
                    $preselec_serv = $dataDisplayEmp[$key][0]->getService()->getService();
                    $preselec_superieur = $dataDisplayEmp[$key][1];
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
                header("Location: /Controller/AccueilController.php");
            }

            $dataDisplayServ = (new ServiceService())->displayServ();
            foreach ($dataDisplayServ as $key => $value) {
                if ($_GET['noserv'] == $dataDisplayServ[$key]->getNoserv()) {
                    $preselec_noserv = $dataDisplayServ[$key]->getNoserv();
                    $preselec_service = $dataDisplayServ[$key]->getService();
                    $preselec_ville = $dataDisplayServ[$key]->getVille();
                }
            }
            formulaireServiceSupprimer($preselec_noserv, $preselec_service, $preselec_ville);
        }
    } else {
        header("location: /Controller/AccueilController.php");
    }
} else {
    header("location: /Controller/AccueilController.php");
}
?>
</body>

</html>