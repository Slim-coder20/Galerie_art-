<?php 

require_once 'DB/DataBase.php'; 

$database = Database::getInstance(); 
$connexion = $database->getConnexion();

if($connexion){
    echo "connexion réussie "; 
}
else{
    echo "echec de la connexion"; 
}