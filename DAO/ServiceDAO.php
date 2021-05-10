<?php
include_once(__DIR__ . "/../Model/Service.php");
include_once(__DIR__ . "/../DAO/CommonDAO.php");
require_once(__DIR__ . "/../Exception/ServiceDAOException.php");

class ServiceDAO extends CommonDAO
{
    public function displayServ(): array
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT * FROM services;");
            $stmt->execute();
            $rs = $stmt->get_result();
            $data = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();
            $bdd->close();
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
            throw new ServiceDAOException($message);
        }
        foreach ($data as $value) {
            $service[] = (new Service())
                ->setNoserv($value['noserv'])
                ->setService($value['service'])
                ->setVille($value['ville'])
                ->setAjout($value['ajout']);
        }
        return $service;
    }

    public function servWithEmp(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT s.noserv FROM services s INNER JOIN employes e ON s.noserv = e.noserv GROUP BY s.noserv;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    public function counterServ(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT COUNT(*) FROM services WHERE ajout = DATE_FORMAT(SYSDATE(), '%Y-%m-%d');");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    public function addServ(Service $service): void
    {
        $noserv = $service->getNoserv();
        $serv = $service->getService();
        $ville = $service->getVille();
        $ajout = $service->getAjout();

        $bdd = $this->connexion();
        $stmt = $bdd->prepare("INSERT INTO services (noserv, service, ville, ajout) VALUES (?, ?, ?, ?);");
        $stmt->bind_param("isss", $noserv, $serv, $ville, $ajout);
        $stmt->execute();
        $bdd->close();
    }

    public function updateServ(Service $service): void
    {
        $noserv = $service->getNoserv();
        $serv = $service->getService();
        $ville = $service->getVille();
        $noserv = $service->getNoserv();

        $bdd = $this->connexion();
        $stmt = $bdd->prepare("UPDATE services SET noserv = ?, service = ?, ville = ? WHERE noserv = ?;");
        $stmt->bind_param("issi", $noserv, $serv, $ville, $noserv);
        $stmt->execute();
        $bdd->close();
    }

    public function deleteServ(int $noserv): void
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("DELETE FROM services WHERE noserv = ?;");
        $stmt->bind_param("i", $noserv);
        $stmt->execute();
        $bdd->close();
    }
}
