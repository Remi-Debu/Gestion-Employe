<?php
include_once(__DIR__ . "/../Model/Utilisateur.php");

class UtilisateurDAO
{
    public function addUser(string $identifiant, string $hashed_mdp): void
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("INSERT INTO utilisateurs (nom, mdp) VALUES (?, ?);");
        $stmt->bind_param("ss", $identifiant, $hashed_mdp);
        $stmt->execute();
        $bdd->close();
    }

    public function selectUser(string $identifiant): array
    {
        $bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
        $stmt = $bdd->prepare("SELECT * FROM utilisateurs WHERE nom = ?;");
        $stmt->bind_param("s", $identifiant);
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_NUM);
        foreach ($data as $key => $value) {
            $utilisateur[$key] = (new Utilisateur())
                ->setId($data[$key][0])
                ->setNom($data[$key][1])
                ->setMdp($data[$key][2])
                ->setAdmin($data[$key][3]);
        }
        $rs->free();
        $bdd->close();
        return $utilisateur;
    }
}
