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

            for ($i = 0; $i < count($dataDisplayEmp); $i++) {
                if ($_GET['noemp'] == $dataDisplayEmp[$i][0]) {
                    $preselec_noemp = $dataDisplayEmp[$i][0];
                    $preselec_nom = $dataDisplayEmp[$i][1];
                    $preselec_prenom = $dataDisplayEmp[$i][2];
                    $preselec_emploi = $dataDisplayEmp[$i][3];
                    $preselec_embauche = $dataDisplayEmp[$i][4];
                    $preselec_sup = $dataDisplayEmp[$i][5];
                    $preselec_noserv = $dataDisplayEmp[$i][6];
                    $preselec_serv = $dataDisplayEmp[$i][7];
                    $preselec_superieur = $dataDisplayEmp[$i][8];
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

            for ($i = 0; $i < count($dataDisplayServ); $i++) {
                if ($_GET['noserv'] == $dataDisplayServ[$i][0]) {
                    $preselec_noserv = $dataDisplayServ[$i][0];
                    $preselec_service = $dataDisplayServ[$i][1];
                    $preselec_ville = $dataDisplayServ[$i][2];
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