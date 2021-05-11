<?php
include_once("../Model/Service.php");
include_once("../DAO/CommonDAO.php");
require_once("../Exception/ServiceDAOException.php");

class ServiceDAO extends CommonDAO
{
    public function displayServ(): array
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("ELECT * FROM services;");
            $stmt->execute();
            $rs = $stmt->get_result();
            $data = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();
            $bdd->close();
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            throw new ServiceDAOException($message, $code);
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
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT s.noserv FROM services s INNER JOIN employes e ON s.noserv = e.noserv GROUP BY s.noserv;");
            $stmt->execute();
            $rs = $stmt->get_result();
            $data = $rs->fetch_all(MYSQLI_NUM);
            $rs->free();
            $bdd->close();
        } catch (mysqli_sql_exception $e) {
            throw new ServiceDAOException($e->getCode(), $e->getMessage());
        }
        return $data;
    }

    public function counterServ(): array
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT COUNT(*) FROM services WHERE ajout = DATE_FORMAT(SYSDATE(), '%Y-%m-%d');");
            $stmt->execute();
            $rs = $stmt->get_result();
            $data = $rs->fetch_all(MYSQLI_NUM);
            $rs->free();
            $bdd->close();
        } catch (mysqli_sql_exception $e) {
            throw new ServiceDAOException($e->getCode(), $e->getMessage());
        }
        return $data;
    }

    public function addServ(Service $service): void
    {
        $noserv = $service->getNoserv();
        $serv = $service->getService();
        $ville = $service->getVille();
        $ajout = $service->getAjout();

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("INSERT INTO services (noserv, service, ville, ajout) VALUES (?, ?, ?, ?);");
            $stmt->bind_param("isss", $noserv, $serv, $ville, $ajout);
            $stmt->execute();
            $bdd->close();
        } catch (mysqli_sql_exception $e) {
            throw new ServiceDAOException($e->getCode(), $e->getMessage());
        }
    }

    public function updateServ(Service $service): void
    {
        $noserv = $service->getNoserv();
        $serv = $service->getService();
        $ville = $service->getVille();
        $noserv = $service->getNoserv();

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("UPDATE services SET noserv = ?, service = ?, ville = ? WHERE noserv = ?;");
            $stmt->bind_param("issi", $noserv, $serv, $ville, $noserv);
            $stmt->execute();
            $bdd->close();
        } catch (mysqli_sql_exception $e) {
            throw new ServiceDAOException($e->getCode(), $e->getMessage());
        }
    }

    public function deleteServ(int $noserv): void
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("DELETE FROM services WHERE noserv = ?;");
            $stmt->bind_param("i", $noserv);
            $stmt->execute();
            $bdd->close();
        } catch (mysqli_sql_exception $e) {
            throw new ServiceDAOException($e->getCode(), $e->getMessage());
        }
    }
}
