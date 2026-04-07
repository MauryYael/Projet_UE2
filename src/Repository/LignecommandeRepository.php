<?php
namespace App\Repository;

use App\Database;
use App\Entity\LigneCommande;
use PDO;

class LigneCommandeRepository {
    private PDO $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }
// créer une nouvelle ligne de commande 
    public function creer(int $idCommande, int $idPlat, int $quantite): void
    {
        $sql = "INSERT INTO ligne_commande (`quantite`, id_commande, id_plat) VALUES (:qtt, :id_commande, :id_plat)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':qtt'  => $quantite,
            ':id_commande' => $idCommande,
            ':id_plat' => $idPlat
        ]);
    }
}