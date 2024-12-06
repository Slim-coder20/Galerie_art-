<?php

require_once 'DB/DataBase.php';

class Users
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function register($nom, $prenom, $email, $password, $biographie, $photo_profile)
    {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $requete = "INSERT INTO artiste(nom, prenom, email, mot_de_passe, biographie, photo_profile) VALUES (:nom, :prenom, :email, :mot_de_passe, :biographie, :photo_profile)";

        $dbConnexion = $this->db->getConnexion();

        $req = $dbConnexion->prepare($requete);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':email', $email);
        $req->bindParam(':mot_de_passe', $hashedPassword);
        $req->bindParam(':biographie', $biographie);
        $req->bindParam(':photo_profile', $photo_profile);

        $req->execute(); 
        return $req->rowCount() > 0; 
    }
}
