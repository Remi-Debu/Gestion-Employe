<?php
include_once("Model/Employe.php");

class EmployeDAO
{
    function displayEmp(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT e.noemp, e.nom, e.prenom, e.emploi, concat(e2.nom, ' ', e2.prenom) AS 'nom sup', e.noserv, s.service, e.sup FROM employes AS e
                               INNER JOIN services AS s on e.noserv = s.noserv
                               INNER JOIN employes AS e2 on e.sup = e2.noemp OR e.sup IS NULL
                               GROUP BY noemp ORDER BY e.noserv, e.noemp ASC;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    function displayEmpDetails(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT noemp, nom, prenom, emploi, sup, noserv, embauche, sal, comm FROM employes;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    function displayEmpModif(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT e.noemp, e.nom, e.prenom, e.emploi, concat(e2.nom, ' ', e2.prenom) 'superieur', e.embauche, e.sal, e.comm, service, e.sup FROM employes e 
                               INNER JOIN services s ON e.noserv = s.noserv 
                               INNER JOIN employes e2 ON e.sup = e2.noemp OR e.sup IS NULL
                               GROUP BY noemp;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    function displayEmpSupp(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT e.noemp, e.nom, e.prenom, e.emploi, DATE_FORMAT(e.embauche,'%d/%m/%Y'), e.sup, e.noserv, s.service, concat(e2.nom, ' ', e2.prenom) 
                               FROM employes e 
                               INNER JOIN services s ON e.noserv = s.noserv 
                               INNER JOIN employes e2 ON e.sup = e2.noemp OR e.sup IS NULL
                               GROUP BY noemp;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    function selectToday(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT DATE_FORMAT(SYSDATE(), '%Y-%m-%d')");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    function sup(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT DISTINCT sup from employes");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    function counterEmp(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT COUNT(*) FROM employes WHERE ajout = DATE_FORMAT(SYSDATE(), '%Y-%m-%d');");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    function addEmp(Employe $employe): void
    {
        $noemp = $employe->getNoemp();
        $nom = $employe->getNom();
        $prenom = $employe->getPrenom();
        $emploi = $employe->getEmploi();
        $embauche = $employe->getEmbauche();
        $sal = $employe->getSal();
        $noserv = $employe->getNoserv();
        $ajout = $employe->getAjout();


        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("INSERT INTO employes (noemp, nom, prenom, emploi, embauche, sal, noserv, ajout) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("issssdis", $noemp, $nom, $prenom, $emploi, $embauche, $sal, $noserv, $ajout);
        $stmt->execute();
        $bdd->close();
    }

    function updateEmp(Employe $employe): void
    {
        $noemp = $employe->getNoemp();
        $nom = $employe->getNom();
        $prenom = $employe->getPrenom();
        $emploi = $employe->getEmploi();
        $embauche = $employe->getEmbauche();
        $sal = $employe->getSal();
        $noemp = $employe->getNoemp();

        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("UPDATE employes SET noemp = ?, nom = ?, prenom = ?, emploi = ?, embauche = ?, sal = ? WHERE noemp = ?;");
        $stmt->bind_param("issssdi", $noemp, $nom, $prenom, $emploi, $embauche, $sal, $noemp);
        $stmt->execute();
        $bdd->close();
    }

    function updateSup(Employe $employe): void
    {
        $sup = $employe->getSup();
        $noemp = $employe->getNoemp();

        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("UPDATE employes SET sup = ? WHERE noemp = ?;");
        $stmt->bind_param("ii", $sup, $noemp);
        $stmt->execute();
        $bdd->close();
    }

    function updateComm(Employe $employe): void
    {
        $comm = $employe->getComm();
        $noemp = $employe->getNoemp();

        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("UPDATE employes SET comm = ? WHERE noemp = ?;");
        $stmt->bind_param("di", $comm, $noemp);
        $stmt->execute();
        $bdd->close();
    }

    function deleteEmp(int $noemp): void
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("DELETE FROM employes WHERE noemp = ?;");
        $stmt->bind_param("i", $noemp);
        $stmt->execute();
        $bdd->close();
    }
}
