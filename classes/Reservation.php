<?php
include_once "Database.php";

class Reservation
{
    private $id;
    private $utilisateur_id;
    private $vehicule_id;
    private $date_debut;
    private $date_fin;
    private $duree_jours;
    private $montant_total;
    private $statut;
    private $lieu_prise;
    private $lieu_retour;
    private $assurance_option;
    private $date_creation;

    private static $pdo = null;

    public function __construct(
        $id = null,
        $utilisateur_id = null,
        $vehicule_id = null,
        $date_debut = null,
        $date_fin = null,
        $duree_jours = null,
        $montant_total = null,
        $statut = null,
        $lieu_prise = null,
        $lieu_retour = null,
        $assurance_option = null,
        $date_creation = null
    ) {
        $this->id = $id;
        $this->utilisateur_id = $utilisateur_id;
        $this->vehicule_id = $vehicule_id;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->duree_jours = $duree_jours;
        $this->montant_total = $montant_total;
        $this->statut = $statut;
        $this->lieu_prise = $lieu_prise;
        $this->lieu_retour = $lieu_retour;
        $this->assurance_option = $assurance_option;
        $this->date_creation = $date_creation;

        self::initPDO();
    }

    private static function initPDO()
    {
        if (self::$pdo === null) {
            self::$pdo = Database::getInstance()->getConnection();
        }
    }

    public static function getUserReservations($user_id, $limit = null)
    {
        self::initPDO();

        try {
            $sql = "SELECT * FROM reservations WHERE utilisateur_id = ? ORDER BY date_debut DESC";

            if ($limit !== null) {
                $sql .= " LIMIT " . (int)$limit;
            }

            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$user_id]);

            $reservations = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $date_debut = new DateTime($row['date_debut']);
                $date_fin = new DateTime($row['date_fin']);
                $duree_jours = $date_debut->diff($date_fin)->days + 1;

                $reservations[] = array_merge($row, [
                    'duree_jours' => $duree_jours
                ]);
            }

            return $reservations;
        } catch (PDOException $e) {
            error_log("Error in Reservation::getUserReservations(): " . $e->getMessage());
            return [];
        }
    }

    public static function find($id)
    {
        self::initPDO();

        try {
            $stmt = self::$pdo->prepare("SELECT * FROM reservations WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Reservation(
                    $row['id'],
                    $row['utilisateur_id'],
                    $row['vehicule_id'],
                    $row['date_debut'],
                    $row['date_fin'],
                    null, // duree_jours sera calculé
                    $row['montant_total'],
                    $row['statut'],
                    $row['lieu_prise'],
                    $row['lieu_retour'],
                    $row['assurance_option'],
                    $row['date_creation']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error in Reservation::find(): " . $e->getMessage());
            return null;
        }
    }

    public function create()
    {
        self::initPDO();

        try {
            // Calculer la durée en jours
            $date_debut = new DateTime($this->date_debut);
            $date_fin = new DateTime($this->date_fin);
            $this->duree_jours = $date_debut->diff($date_fin)->days + 1;

            $sql = "INSERT INTO reservations
(utilisateur_id, vehicule_id, date_debut, date_fin, montant_total,
statut, lieu_prise, lieu_retour, assurance_option, date_creation)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([
                $this->utilisateur_id,
                $this->vehicule_id,
                $this->date_debut,
                $this->date_fin,
                $this->montant_total,
                $this->statut,
                $this->lieu_prise,
                $this->lieu_retour,
                $this->assurance_option
            ]);

            $this->id = self::$pdo->lastInsertId();
            return $this->id;
        } catch (PDOException $e) {
            error_log("Error in Reservation::create(): " . $e->getMessage());
            return false;
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
}
