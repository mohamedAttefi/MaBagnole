<?php
// classes/Review.php
include_once "DataBase.php";

class Review
{
    private static $pdo = null;

    private static function initPDO()
    {
        if (self::$pdo === null) {
            $db = DataBase::getInstance();
            self::$pdo = $db->getConnection();
        }
    }

    public static function create($data)
    {
        self::initPDO();
        
        try {
            $sql = "
                INSERT INTO avis
                (client_id, vehicule_id, reservation_id, note, commentaire, date_avis, statut)
                VALUES (?, ?, ?, ?, ?, NOW(), ?)
            ";
            
            $stmt = self::$pdo->prepare($sql);
            $result = $stmt->execute([
                $data['client_id'],
                $data['vehicule_id'],
                $data['reservation_id'],
                $data['note'],
                $data['commentaire'],
                $data['statut']
            ]);
            
            if ($result) {
                self::updateVehicleRating($data['vehicule_id']);
                return self::$pdo->lastInsertId();
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error in Review::create(): " . $e->getMessage());
            return false;
        }
    }

    public static function update($id, $data)
    {
        self::initPDO();
        
        try {
            $sql = "
                UPDATE avis 
                SET note = ?, commentaire = ?, date_modification = ?
                WHERE id = ?
            ";
            
            $stmt = self::$pdo->prepare($sql);
            $result = $stmt->execute([
                $data['note'],
                $data['commentaire'],
                $data['date_modification'],
                $id
            ]);
            
            if ($result) {
                // Get vehicle_id to update rating
                $vehicle = self::find($id);
                if ($vehicle) {
                    self::updateVehicleRating($vehicle['vehicule_id']);
                }
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error in Review::update(): " . $e->getMessage());
            return false;
        }
    }

    public static function delete($id)
    {
        self::initPDO();
        
        try {
            // Get vehicle_id before deletion
            $review = self::find($id);
            $vehicle_id = $review ? $review['vehicule_id'] : null;
            
            $sql = "DELETE FROM avis WHERE id = ?";
            $stmt = self::$pdo->prepare($sql);
            $result = $stmt->execute([$id]);
            
            if ($result && $vehicle_id) {
                // Update vehicle's average rating
                self::updateVehicleRating($vehicle_id);
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error in Review::delete(): " . $e->getMessage());
            return false;
        }
    }

    public static function find($id)
    {
        self::initPDO();
        
        try {
            $sql = "SELECT * FROM avis WHERE id = ?";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in Review::find(): " . $e->getMessage());
            return null;
        }
    }

    public static function findByReservation($reservation_id)
    {
        self::initPDO();
        
        try {
            $sql = "SELECT * FROM avis WHERE reservation_id = ?";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$reservation_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in Review::findByReservation(): " . $e->getMessage());
            return null;
        }
    }

    public static function findByUser($user_id, $limit = null)
    {
        self::initPDO();
        
        try {
            $sql = "
                SELECT a.*, v.marque, v.modele, v.image_url
                FROM avis a
                JOIN vehicules v ON a.vehicule_id = v.id
                WHERE a.client_id = ?
                ORDER BY a.date_avis DESC
            ";
            
            if ($limit !== null) {
                $sql .= " LIMIT " . (int)$limit;
            }
            
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in Review::findByUser(): " . $e->getMessage());
            return [];
        }
    }

    private static function updateVehicleRating($vehicle_id)
    {
        try {
            $sql = "
                UPDATE vehicules 
                SET note_moyenne = (
                    SELECT AVG(note) FROM avis WHERE vehicule_id = ? AND statut = 'actif'
                ),
                total_avis = (
                    SELECT COUNT(*) FROM avis WHERE vehicule_id = ? AND statut = 'actif'
                )
                WHERE id = ?
            ";
            
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$vehicle_id, $vehicle_id, $vehicle_id]);
            return true;
        } catch (PDOException $e) {
            error_log("Error in Review::updateVehicleRating(): " . $e->getMessage());
            return false;
        }
    }

    public static function getVehicleReviews($vehicle_id, $limit = null)
    {
        self::initPDO();
        
        try {
            $sql = "
                SELECT a.*, c.nom, c.prenom
                FROM avis a
                JOIN clients c ON a.client_id = c.id
                WHERE a.vehicule_id = ? AND a.statut = 'actif'
                ORDER BY a.date_avis DESC
            ";
            
            if ($limit !== null) {
                $sql .= " LIMIT " . (int)$limit;
            }
            
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$vehicle_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in Review::getVehicleReviews(): " . $e->getMessage());
            return [];
        }
    }
}
?>