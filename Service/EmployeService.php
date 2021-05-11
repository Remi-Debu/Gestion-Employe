<?php
include_once("../DAO/EmployeDAO.php");

class EmployeService
{
    public function displayEmp(): array
    {
        $data = (new EmployeDAO())->displayEmp();
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
