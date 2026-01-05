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

    public static function filter($params = [])
    {
        self::initPDO();

        $search = $params['search'] ?? '';
        $categories = $params['categories'] ?? [];
        $fuels = $params['fuels'] ?? [];
        $sort = $params['sort'] ?? '';

        $query = "SELECT * from listevehicules
              WHERE 1=1";

        $conditions = [];
        $bindings = [];

        if (!empty($search)) {
            $conditions[] = "(marque LIKE ? OR modele LIKE ?)";
            $searchTerm = "%$search%";
            $bindings[] = $searchTerm;
            $bindings[] = $searchTerm;
        }

        if (!empty($categories)) {
            $placeholders = str_repeat('?,', count($categories) - 1) . '?';
            $conditions[] = "categorie_id IN ($placeholders)";
            $bindings = array_merge($bindings, $categories);
        }

        if (!empty($fuels)) {
            $placeholders = str_repeat('?,', count($fuels) - 1) . '?';
            $conditions[] = "carburant IN ($placeholders)";
            $bindings = array_merge($bindings, $fuels);
        }

        if (!empty($conditions)) {
            $query .= " AND " . implode(" AND ", $conditions);
        }

        if ($sort === 'desc') {
            $query .= " ORDER BY prix_journalier DESC";
        } else if ($sort === 'rating') {
            $query .= " ORDER BY note_moyenne DESC";
        } else {
            $query .= " ORDER BY prix_journalier ASC";
        }

        $stmt = self::$pdo->prepare($query);
        $stmt->execute($bindings);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
