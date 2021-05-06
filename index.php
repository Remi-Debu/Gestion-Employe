<?php
include_once("DAO/ServiceDAO.php");
include_once("Model/Service.php");

$bdd = new mysqli("127.0.0.1", "admin", "admin", "emp_serv");
$stmt = $bdd->prepare("SELECT * FROM services;");
$stmt->execute();
$rs = $stmt->get_result();
$data = $rs->fetch_all(MYSQLI_NUM);

foreach ($data as $key => $value) {
    $services[$key] = (new Service())->setNoserv($data[$key][0])->setService($data[$key][1])->setVille($data[$key][2]);
}

$rs->free();
$bdd->close();

foreach ($services as $key => $value) {
    echo $services[$key]->getNoserv();
}
