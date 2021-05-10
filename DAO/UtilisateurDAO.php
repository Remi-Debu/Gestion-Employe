<?php
include_once(__DIR__ . "/../Model/Utilisateur.php");
include_once(__DIR__ . "/../DAO/CommonDAO.php");

class UtilisateurDAO extends CommonDAO
{
    public function addUser(string $identifiant, string $hashed_mdp): void
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("INSERT INTO utilisateurs (nom, mdp) VALUES (?, ?);");
        $stmt->bind_param("ss", $identifiant, $hashed_mdp);
        $stmt->execute();
        $bdd->close();
    }

    public function selectUser(string $identifiant): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM utilisateurs WHERE nom = ?;");
        $stmt->bind_param("s", $identifiant);
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        foreach ($data as $value) {
            $utilisateur[] = (new Utilisateur())
                ->setId($value["id"])
                ->setNom($value["nom"])
                ->setMdp($value["mdp"])
                ->setAdmin($value["admin"]);
        }
        $rs->free();
        $bdd->close();
        return $utilisateur;
    }
}
