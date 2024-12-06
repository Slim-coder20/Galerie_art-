<?php

class Database
{
    private static $instance = null; // Utilisez null comme valeur par défaut
    private $connexion;

    private function __construct($host, $username, $password, $database)
    {
        try {
            // Correction de la chaîne PDO
            $this->connexion = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de la connexion à la base de données : " . $e->getMessage());
        }
    }

    // Cette méthode va être un intermédiaire pour l'instanciation de notre classe 
    public static function getInstance()
    {
        // Vérifier si l'instance n'est pas déjà créée
        if (!self::$instance) {
            require_once 'config.php';
            self::$instance = new Database(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }

        return self::$instance; // Retourner l'instance
    }

    // On va faire une autre méthode qui va renvoyer la connexion à notre base de données
    public function getConnexion()
    {
        return $this->connexion;
    }
}
