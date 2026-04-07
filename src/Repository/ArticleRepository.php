<?php
namespace App\Repository;
use App\Database;
use App\Entity\Article;
use PDO;

class ArticleRepository{
    
    private PDO $connection;
    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }
    // crée un tableau avec tous les aliments rattachés au restaurateur 
    public function findByRestaurateur(int $id):array{
        $sql="SELECT * FROM articles WHERE id_restaurateur = :id";
        $stmt= $this->connection->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $articles=[];
        foreach($results as $row){
            $articles[] = new Article($row);
        }
        return $articles;
    }
    // mets à jour les stock d'un article
    public function updateStock(int $idArticle, float $nouveauStock): void
    {
        $sql = "UPDATE articles SET stock_actuel = :stock WHERE id_article = :id";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':stock', $nouveauStock);
        $stmt->bindParam(':id', $idArticle, PDO::PARAM_INT);
        $stmt->execute();
    }
} 