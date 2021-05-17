<?php
include_once("../DAO/EmployeDAO.php");
require_once("../Exception/EmployeDAOException.php");
require_once("../Exception/EmployeServiceException.php");

class EmployeService
{
    public function displayEmp(): array
    {
        try {
            $data = (new EmployeDAO())->displayEmp();
        } catch (EmployeDAOException $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            throw new EmployeServiceException($message, $code);
        }
        return $data;
    }

    public function displayEmpDetails(): array
    {
        $data = (new EmployeDAO())->displayEmpDetails();
        return $data;
    }

    public function displayEmpModif(): array
    {
        $data = (new EmployeDAO())->displayEmpModif();
        return $data;
    }

    public function displayEmpSupp(): array
    {
        $data = (new EmployeDAO())->displayEmpSupp();
        return $data;
    }

    public function selectToday(): array
    {
        $data = (new EmployeDAO())->selectToday();
        return $data;
    }

    public function sup(): array
    {
        $data = (new EmployeDAO())->sup();
        return $data;
    }

    public function counterEmp(): array
    {
        $data = (new EmployeDAO())->counterEmp();
        return $data;
    }

    public function addEmp(Employe $employe): void
    {
        (new EmployeDAO())->addEmp($employe);
    }

    public function updateEmp(Employe $employe): void
    {
        (new EmployeDAO())->updateEmp($employe);
    }

    public function updateSup(Employe $employe): void
    {
        (new EmployeDAO())->updateSup($employe);
    }

    public function updateComm(Employe $employe): void
    {
        (new EmployeDAO())->updateComm($employe);
    }

    public function deleteEmp(int $noemp): void
    {
        (new EmployeDAO())->deleteEmp($noemp);
    }
}
