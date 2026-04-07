<?php
namespace App\Repository;

use App\Database;
use App\Entity\Commande;
use PDO;

class CommandeRepository {
    private PDO $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    // crée un reçu de commande(avec un nouvel id) vierge avec la date de sa création et son état en payé
    public function creer(int $idRestaurateur): int 
    {
        $sql = "INSERT INTO commande (date_commande, statut, id_restaurateur) VALUES (NOW(), 'Payée', :id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id',$idRestaurateur,PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->connection->lastInsertId();
    }

    // Récupérer l'historique complet avec les détails et le prix total
    public function findHistoriqueByRestaurateur(int $idRestaurateur): array
    {
        $sql = "
            SELECT commande.id_commande,commande.date_commande,commande.statut,GROUP_CONCAT(CONCAT(ligne_commande.`quantite`, 'x ', p.nom) SEPARATOR ', ') as details, SUM(ligne_commande.`quantite` * p.prix_vente) as total_prix
            FROM commande
            JOIN ligne_commande ON commande.id_commande = ligne_commande.id_commande
            JOIN plats p ON ligne_commande.id_plat = p.id_plat
            WHERE commande.id_restaurateur = :id
            GROUP BY commande.id_commande
            ORDER BY commande.date_commande DESC
        ";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([':id' => $idRestaurateur]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}