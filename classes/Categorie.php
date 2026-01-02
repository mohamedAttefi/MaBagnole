<?php
include_once "DataBase.php";

class Categorie
{
    private $id;
    private $nom;
    private $description;
    private $disponible;

    private static ?PDO $pdo = null;

    public function __construct($id = null, $nom = null, $description = null, $disponible = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->disponible = $disponible;
        self::initPDO();
    }

    private static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = Database::getInstance()->getConnection();
        }
    }

    public function __get($att)
    {
        return $this->$att;
    }

    public function __set($att, $value)
    {
        $this->$att = $value;
    }
    public static function all()
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT * FROM categories WHERE disponible = 1");
        $stmt->execute();
        return $stmt->fetchall();
    }
    public static function one($caregorieName)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("SELECT * FROM categories WHERE disponible = 1 and nom = ?");
        $stmt->execute([$caregorieName]);
        return $stmt->fetch();
    }

     public static function countVehicle($caregorieName)
    {
        self::initPDO();
        $stmt = self::$pdo->prepare("select count(v.categorie_id) as count, c.nom from categories c JOIN vehicules v ON c.id = v.categorie_id where c.nom = ?");
        $stmt->execute([$caregorieName]);
        return $stmt->fetch();
    }
}
