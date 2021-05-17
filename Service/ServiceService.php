<?php
include_once("../DAO/ServiceDAO.php");
//require_once("../Exception/ServiceDAOException.php");
//require_once("../Exception/ServiceServiceException.php");

class ServiceService
{
    public function displayServ(): array
    {
        try {
            $data = (new ServiceDAO())->displayServ();
        } catch (ServiceDAOException $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            throw new ServiceServiceException($message, $code);
        }
        return $data;
    }

    public function servWithEmp(): array
    {
        try {
            $data = (new ServiceDAO())->servWithEmp();
        } catch (ServiceDAOException $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            throw new ServiceServiceException($message, $code);
        }
        return $data;
    }

    public function counterServ(): array
    {
        try {
            $data = (new ServiceDAO())->counterServ();
        } catch (ServiceDAOException $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            throw new ServiceServiceException($message, $code);
        }
        return $data;
    }

    public function addServ(Service $service): void
    {
        try {
            (new ServiceDAO())->addServ($service);
        } catch (ServiceDAOException $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            throw new ServiceServiceException($message, $code);
        }
    }

    public function updateServ(Service $service): void
    {
        try {
            (new ServiceDAO())->updateServ($service);
        } catch (ServiceDAOException $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            throw new ServiceServiceException($message, $code);
        }
    }

    public function deleteServ(int $noserv): void
    {
        try {
            (new ServiceDAO())->deleteServ($noserv);
        } catch (ServiceDAOException $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            throw new ServiceServiceException($message, $code);
        }
    }
}
