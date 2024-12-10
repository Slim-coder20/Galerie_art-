<?php


require_once 'DB/config.php'; 

session_start(); 

session_destroy(); 
header('location:login.php'); 
exit(); 

?>