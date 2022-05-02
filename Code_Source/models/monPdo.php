<?php // Template du pdo

/**
 * Casse d'accès aux données Utilise les services de la classe PDO
 * 
 */

class MonPdo
{
    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=db_facebookcfpt';
    private static $user = 'eliaszm';
    private static $mdp = '2404';
    private static $monPdo;
    private static $unPdo = null;

    // Constructeur privé, crée l'instance de PDO qui sera solicité
    // pour toutes les méthodes de la classe

    private function __construct()
    {
        MonPdo::$unPdo = new PDO(MonPdo::$serveur . ";" . MonPdo::$bdd, MonPdo::$user, MonPdo::$mdp);
        MonPdo::$unPdo->query('SET names utf8');
        MonPdo::$unPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function __destruct()
    {
        MonPdo::$unPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe 
     * Appel : $instanceMonPdo = MonPdo::getMonPdo();
     *
     * @return l'unique objet de la classe MonPdo
     */
    public static function getInstance()
    {
        if (self::$unPdo == null) {
            self::$monPdo = new MonPdo();
        }
        return self::$unPdo;
    }
}
?>