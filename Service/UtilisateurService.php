<?php
include_once(__DIR__ . "/../DAO/UtilisateurDAO.php");

class UtilisateurService
{
    public function addUser(string $identifiant, string $mdp): void
    {
        $hashed_mdp = password_hash($mdp, PASSWORD_DEFAULT);
        (new UtilisateurDAO())->addUser($identifiant, $hashed_mdp);
    }

    public function selectUser(string $identifiant): array
    {
        $data = (new UtilisateurDAO())->selectUser($identifiant);
        return $data;
    }

    public function session(string $identifiant, array $data): void
    {
        $_SESSION["ident"] = $identifiant;
        $_SESSION["admin"] = $data[0]->getAdmin();
        (new Utilisateur())->setNom($_SESSION["ident"])->setAdmin($_SESSION["admin"]);
    }
}
