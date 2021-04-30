<?php
$a = "SELECT * from utilisateurs WHERE id = 12";
$b = "UPDATE utilisateurs SET nom = 'Jules' WHERE id = 12";

$bdd = mysqli_init();
mysqli_real_connect($bdd, "127.0.0.1", "admin", "admin", "emp_serv");
$result = mysqli_query($bdd, $b);
if ($result != "bool(true)" || $result != "bool(false)") {
    $data = mysqli_fetch_all($result);
    mysqli_free_result($result);
    echo "success";
} else {
    echo "Erraur";
}
mysqli_close($bdd);

$bdd = mysqli_init();
mysqli_real_connect($bdd, "127.0.0.1", "admin", "admin", "emp_serv");
$result = mysqli_query($bdd, $a);
if (preg_match("#^SELECT#i", $a)) {
    $data = mysqli_fetch_all($result);
    mysqli_free_result($result);
    echo "success";
} else {
    echo "Erraur";
}
mysqli_close($bdd);



