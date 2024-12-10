<?php

require_once 'DB/DataBase.php';

class Users
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * La méthode register nous permets d'insérer des données dans la base de donnée qu'on avait créé 
     */

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


    /**
     * Gestion de la connexion utiisatyeur 
     * création d'une méthode qui nous permettra de faire la connexion de nos utilisateurs 
     */


     public function login($email, $password){

        $query = "SELECT id_artiste , mot_de_passe FROM artiste WHERE email = :email"; 
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query); 

        $req->bindParam(':email', $email);
        $req->execute(); 

        /**
         * On va récupérer le resultat dans un tableau associatif : voici comment faut faire 
         */

         $user = $req->fetch(PDO::FETCH_ASSOC);

         /**
          * On va faire une condition qui nous sert à vérifier qu'oin a un résultat retourné par notre requette et que les mots de passe saisi par l'utilisateur et celui qui se trouve dans notre table sont identiques 
          */
        if($user && password_verify($password, $user['mot_de_passe'])){
            return $user['id_artiste']; 
        }
        return false; 
     }

     /**
      * On va créer une méthode qui va nous permettre de récupéré les données de nos utulisateurs grâce à son identifiant 
      */

     public function getUserById($id_artiste){
        $query = "SELECT * FROM artiste WHERE id_artiste = :id_artiste"; 
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query); 
        $req->bindParam(':id_artiste', $id_artiste); 
        $req->execute();

        return $req->fetch(PDO::FETCH_ASSOC); 

     }

/**
 * On va créer une méthode qui va nous permettre d'insérer des mises à jour de nos utilisateurs dans notre base de donné galerie 
 */

public function updateProfile($id_artiste, $prenom, $nom, $email, $biographie, $photo_profile){

    $query = "UPDATE artiste SET prenom = :prenom, nom = :nom, email = :email, biographie = :biographie, photo_profile = :photo_profile WHERE id_artiste = :id_artiste"; 

    $dbConnexion = $this->db->getConnexion(); 
    $req = $dbConnexion->prepare($query); 
    $req->bindParam(':prenom', $prenom); 
    $req->bindParam(':nom', $nom); 
    $req->bindParam(':email', $email); 
    $req->bindParam(':biographie', $biographie); 
    $req->bindParam(':photo_profile', $photo_profile); 
    $req->bindParam(':id_artiste', $id_artiste); 

    $req->execute(); 
    return $req->rowCount() > 0; 


}




}
