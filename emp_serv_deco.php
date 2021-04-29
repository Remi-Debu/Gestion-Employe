<?php   
session_start(); 
session_destroy(); 
header("location:emp_serv.php");
exit();
?>