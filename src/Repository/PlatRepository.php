<?php
namespace App\Repository;
use App\Database;
use App\Entity\Plat;
use PDO;

class PlatRepository{
    
    private PDO $connection;
    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }
    // fonction qui renvoie un tavleau contenant tous les plats de l'utilisateur dont l'id est mis en param
    public function findByRestaurateur(int $id):array{
        $sql="SELECT * FROM plats WHERE id_restaurateur = :id";
        $stmt= $this->connection->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $plats=[];
        foreach($results as $row){
            $plats[] = new Plat($row);
        }
        return $plats;}

    // soustrait les articles d'un plat en fonction de sa recette
    public function vendrePlat(int $idPlat , int $qtt){
        $sql ="SELECT id_article , quantite FROM composition WHERE id_plat = :id ";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id',$idPlat,PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $ingredient){
            $idArticle = $ingredient['id_article'];
            $doseRecette = $ingredient['quantite'];

            $totalARetirer = $doseRecette * $qtt;

            $updateSql = "UPDATE articles SET stock_actuel = stock_actuel - :retrait WHERE id_article = :idArticle";
            
            $stmtUpdate = $this->connection->prepare($updateSql);
            $stmtUpdate->bindParam(':idArticle',$idArticle,PDO::PARAM_INT);
            $stmtUpdate->bindParam(':retrait',$totalARetirer,PDO::PARAM_STR);
            $stmtUpdate->execute();
        }

    }





    
} 