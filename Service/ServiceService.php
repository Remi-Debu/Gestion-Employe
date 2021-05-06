<?php
include_once(__DIR__ . "/../DAO/ServiceDAO.php");

class ServiceService
{
    public function displayServ(): array
    {
        $data = (new ServiceDAO())->displayServ();
        return $data;
    }

    public function servWithEmp(): array
    {
        $data = (new ServiceDAO())->servWithEmp();
        return $data;
    }

    public function counterServ(): array
    {
        $data = (new ServiceDAO())->counterServ();
        return $data;
    }

    public function addServ(Service $service): void
    {
        (new ServiceDAO())->addServ($service);
    }

    public function updateServ(Service $service): void
    {
        (new ServiceDAO())->updateServ($service);
    }

    public function deleteServ(int $noserv): void
    {
        (new ServiceDAO())->deleteServ($noserv);
    }
}
