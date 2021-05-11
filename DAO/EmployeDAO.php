<?php
include_once("../Model/Employe.php");
include_once("../DAO/CommonDAO.php");

class EmployeDAO extends CommonDAO
{
    public function displayEmp(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT e.noemp, e.nom, e.prenom, e.emploi, e2.nom as 'nomsup', e2.prenom as 'prenomsup', e.noserv, s.service, e.sup FROM employes AS e
                               INNER JOIN services AS s on e.noserv = s.noserv
                               INNER JOIN employes AS e2 on e.sup = e2.noemp OR e.sup IS NULL
                               GROUP BY noemp ORDER BY e.noserv, e.noemp ASC;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        foreach ($data as $value) {
            $employe[] = (new Employe())
                ->setNoemp($value['noemp'])
                ->setNom($value['nom'])
                ->setPrenom($value['prenom'])
                ->setEmploi($value['emploi'])
                ->setSuperieur((new Employe())->setNom($value['nomsup'])->setPrenom($value['prenomsup']))
                ->setService((new Service())->setNoserv($value['noserv'])->setService($value['service']))
                ->setSup($value['sup']);
        }
        $rs->free();
        $bdd->close();
        return $employe;
    }

    public function displayEmpDetails(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT noemp, nom, prenom, emploi, sup, noserv, embauche, sal, comm FROM employes;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        foreach ($data as $value) {
            $employe[] = (new Employe())
                ->setNoemp($value["noemp"])
                ->setNom($value["nom"])
                ->setPrenom($value["prenom"])
                ->setEmploi($value["emploi"])
                ->setSup($value["sup"])
                ->setService((new Service())->setNoserv($value["noserv"]))
                ->setEmbauche($value["embauche"])
                ->setSal($value["sal"])
                ->setComm($value["comm"]);
        }
        $rs->free();
        $bdd->close();
        return $employe;
    }

    public function displayEmpModif(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT e.noemp, e.nom, e.prenom, e.emploi, e2.nom as 'nomsup', e2.prenom as 'prenomsup', e.embauche, e.sal, e.comm, s.service, e.sup FROM employes e 
                               INNER JOIN services s ON e.noserv = s.noserv 
                               INNER JOIN employes e2 ON e.sup = e2.noemp OR e.sup IS NULL
                               GROUP BY noemp;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        foreach ($data as $value) {
            $employe[] = (new Employe())
                ->setNoemp($value["noemp"])
                ->setNom($value["nom"])
                ->setPrenom($value["prenom"])
                ->setEmploi($value["emploi"])
                ->setEmbauche($value["embauche"])
                ->setSuperieur((new Employe())->setNom($value['nomsup'])->setPrenom($value['prenomsup']))
                ->setSal($value["sal"])
                ->setComm($value["comm"])
                ->setService((new Service())->setService($value["service"]))
                ->setSup($value["sup"]);
        }
        $rs->free();
        $bdd->close();
        return $employe;
    }

    public function displayEmpSupp(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT e.noemp, e.nom, e.prenom, e.emploi, DATE_FORMAT(e.embauche,'%d/%m/%Y') as 'embauche', e.sup, e.noserv, s.service, e2.nom as 'nomsup', e2.prenom as 'prenomsup' 
                               FROM employes e 
                               INNER JOIN services s ON e.noserv = s.noserv 
                               INNER JOIN employes e2 ON e.sup = e2.noemp OR e.sup IS NULL
                               GROUP BY noemp;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        foreach ($data as $value) {
            $employe[] = (new Employe())
                ->setNoemp($value["noemp"])
                ->setNom($value["nom"])
                ->setPrenom($value["prenom"])
                ->setEmploi($value["emploi"])
                ->setEmbauche($value["embauche"])
                ->setSup($value["sup"])
                ->setService((new Service())->setNoserv($value["noserv"])->setService($value["service"]))
                ->setSuperieur((new Employe())->setNom($value['nomsup'])->setPrenom($value['prenomsup']));
        }
        $rs->free();
        $bdd->close();
        return $employe;
    }

    public function selectToday(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT DATE_FORMAT(SYSDATE(), '%Y-%m-%d')");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    public function sup(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT DISTINCT sup from employes");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    public function counterEmp(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT COUNT(*) FROM employes WHERE ajout = DATE_FORMAT(SYSDATE(), '%Y-%m-%d');");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    public function addEmp(Employe $employe): void
    {
        $noemp = $employe->getNoemp();
        $nom = $employe->getNom();
        $prenom = $employe->getPrenom();
        $emploi = $employe->getEmploi();
        $embauche = $employe->getEmbauche();
        $sal = $employe->getSal();
        $noserv = $employe->getService()->getNoserv();
        $ajout = $employe->getAjout();


        $bdd = $this->connexion();
        $stmt = $bdd->prepare("INSERT INTO employes (noemp, nom, prenom, emploi, embauche, sal, noserv, ajout) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("issssdis", $noemp, $nom, $prenom, $emploi, $embauche, $sal, $noserv, $ajout);
        $stmt->execute();
        $bdd->close();
    }

    public function updateEmp(Employe $employe): void
    {
        $noemp = $employe->getNoemp();
        $nom = $employe->getNom();
        $prenom = $employe->getPrenom();
        $emploi = $employe->getEmploi();
        $embauche = $employe->getEmbauche();
        $sal = $employe->getSal();
        $noemp = $employe->getNoemp();

        $bdd = $this->connexion();
        $stmt = $bdd->prepare("UPDATE employes SET noemp = ?, nom = ?, prenom = ?, emploi = ?, embauche = ?, sal = ? WHERE noemp = ?;");
        $stmt->bind_param("issssdi", $noemp, $nom, $prenom, $emploi, $embauche, $sal, $noemp);
        $stmt->execute();
        $bdd->close();
    }

    public function updateSup(Employe $employe): void
    {
        $sup = $employe->getSup();
        $noemp = $employe->getNoemp();

        $bdd = $this->connexion();
        $stmt = $bdd->prepare("UPDATE employes SET sup = ? WHERE noemp = ?;");
        $stmt->bind_param("ii", $sup, $noemp);
        $stmt->execute();
        $bdd->close();
    }

    public function updateComm(Employe $employe): void
    {
        $comm = $employe->getComm();
        $noemp = $employe->getNoemp();

        $bdd = $this->connexion();
        $stmt = $bdd->prepare("UPDATE employes SET comm = ? WHERE noemp = ?;");
        $stmt->bind_param("di", $comm, $noemp);
        $stmt->execute();
        $bdd->close();
    }

    public function deleteEmp(int $noemp): void
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("DELETE FROM employes WHERE noemp = ?;");
        $stmt->bind_param("i", $noemp);
        $stmt->execute();
        $bdd->close();
    }
}
