<?php
include_once "Database.php";

class Vehicle
{
    private $id;
    private $marque;
    private $modele;
    private $annee;
    private $immatriculation;
    private $categorie_id;
    private $prix_journalier;
    private $carburant;
    private $nb_places;
    private  $description;
    private  $image_url;
    private $disponible;

    private static ?PDO $pdo = null;

    public function __construct()
    {
        self::initPDO();
    }


    private static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = Database::getInstance()->getConnection();
        }
    }

    public static function all()
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT * from listevehicules where disponible = 1;");
        $stmt->execute();
        return $stmt->fetchall();
    }

    public static function find(int $id)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT * FROM listevehicules WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

        public function __get($att)
    {
        return $this->$att;
    }

    public function __set($att, $value)
    {
        $this->$att = $value;
    }

    

}
