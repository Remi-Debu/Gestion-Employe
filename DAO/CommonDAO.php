<?php
class CommonDAO
{
    protected function connexion(): object
    {
        $bdd = new mysqli("127.0.0.1", "root", "", "gestion_employe");
        return $bdd;
    }
}
