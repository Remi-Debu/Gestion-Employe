<?php
include_once(__DIR__ . "/../Model/Service.php");

class ServiceDAO
{
    public function displayServ(): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT * FROM services;");
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        foreach ($data as $key => $value) {
            $service[$key] = (new Service())
                ->setNoserv($data[$key][0])
                ->setService($data[$key][1])
                ->setVille($data[$key][2])
                ->setAjout($data[$key][3]);
        }
        $rs->free();
        $bdd->close();
        return $service;
    }

    public function servWithEmp(): array
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

    public function counterServ(): array
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

    public function addServ(Service $service): void
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

    public function updateServ(Service $service): void
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

    public function deleteServ(int $noserv): void
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("DELETE FROM services WHERE noserv = ?;");
        $stmt->bind_param("i", $noserv);
        $stmt->execute();
        $bdd->close();
    }
}
