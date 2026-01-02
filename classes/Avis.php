<?php
include "DataBase.php";

class Avis
{
    private $id;
    private $client_id;
    private $vehicule_id;
    private $reservation_id;
    private $note;
    private  $commentaire;
    private $date_creation;

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DataBase::getInstance()->getConnection();
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO avis
        (client_id, vehicule_id, reservation_id, note, commentaire)
        VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
}
