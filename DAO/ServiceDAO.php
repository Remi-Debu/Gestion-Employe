<?php
include_once("Model/Service.php");

class ServiceDAO
{
    function displayServ(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT * FROM services;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    function servWithEmp(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT s.noserv FROM services s INNER JOIN employes e ON s.noserv = e.noserv GROUP BY s.noserv;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    function counterServ(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT COUNT(*) FROM services WHERE ajout = DATE_FORMAT(SYSDATE(), '%Y-%m-%d');");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        $rs->free();
        $bdd->close();
        return $data;
    }

    function addServ(Service $service): void
    {
        $noserv = $service->getNoserv();
        $serv = $service->getService();
        $ville = $service->getVille();
        $ajout = $service->getAjout();

        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("INSERT INTO services (noserv, service, ville, ajout) VALUES (?, ?, ?, ?);");
        $stmt->bind_param("isss", $noserv, $serv, $ville, $ajout);
        $stmt->execute();
        $bdd->close();
    }

    function updateServ(Service $service): void
    {
        $noserv = $service->getNoserv();
        $serv = $service->getService();
        $ville = $service->getVille();
        $noserv = $service->getNoserv();

        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("UPDATE services SET noserv = ?, service = ?, ville = ? WHERE noserv = ?;");
        $stmt->bind_param("issi", $noserv, $serv, $ville, $noserv);
        $stmt->execute();
        $bdd->close();
    }

    function deleteServ(int $noserv): void
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("DELETE FROM services WHERE noserv = ?;");
        $stmt->bind_param("i", $noserv);
        $stmt->execute();
        $bdd->close();
    }
}
