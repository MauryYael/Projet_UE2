<?php
namespace App\Repository;
use App\Database;
use App\Entity\Restaurateur;
use PDO;

class RestaurateurRepository{
    
    private PDO $connection;
    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }
    // génère un stock d'ingrédient remplis
    private function genererStockDeBase(int $idRestaurateur): void 
    {
        $stockDeBase = [
            ['nom' => 'Pain Burger', 'qtt' => 50,'type'=>'aliment' ,'seuil'=> 25 ,'unite' => 'pièce'],
            ['nom' => 'Pain HotDog', 'qtt' => 50,'type'=>'aliment' ,'seuil'=> 25 ,'unite' => 'pièce'],
            ['nom' => 'Steak Haché', 'qtt' => 50,'type'=>'aliment' ,'seuil'=> 25,'unite' => 'pièce'],
            ['nom' => 'Cheddar','qtt' => 50,'type'=>'aliment' ,'seuil'=>30 ,'unite' => 'tranche'],
            ['nom' => 'Saucisse','qtt' => 50,'type'=>'aliment','seuil'=>25, 'unite' => 'pièce'],
            ['nom' => 'Pomme de terre','qtt' => 20,'type'=>'aliment','seuil'=> 10 , 'unite' => 'kg'],
            ['nom' => 'Magnum','qtt' => 20,'type'=>'aliment','seuil'=>10 , 'unite' => 'pièce'],
            ['nom' => 'Coca Cola','qtt' => 30,'type'=>'aliment' ,'seuil'=>15 ,'unite' => 'canette'],
            ['nom' => 'Ice Tea',    'qtt' => 30,'type'=>'aliment' ,'seuil'=>15 ,'unite' => 'canette'],
        ];
        $sql = "INSERT INTO articles (nom_ingredient, stock_actuel,type,seuil_alerte, unite, id_restaurateur) VALUES (:nom, :qtt, :type ,:seuil, :unite, :id)";
        
        $stmt = $this->connection->prepare($sql);
        foreach ($stockDeBase as $item) {
        $stmt->execute([
                ':nom'   => $item['nom'],
                ':qtt'   => $item['qtt'],
                ':type'  => $item['type'],
                ':unite' => $item['unite'],
                ':seuil' => $item['seuil'],
                ':id'    => $idRestaurateur
                        ]);
        }
    }
// gènère les différents plats
    private function genererPlatsDeBase(int $idRestaurateur): void
    {
$menu = [
            [
                'nom' => 'Burger Classique', 
                'prix' => 12.50, 
                'desc' => 'Pain brioché, Steak, Fromage, Oignons',
                'ingredients' => ['Pain Burger' => 1, 'Steak Haché' => 1, 'Cheddar' => 1]
            ],
            [
                'nom' => 'Hot Dog', 
                'prix' => 14.00, 
                'desc' => 'Pain brioché, moutarde , saucisse',
                'ingredients' => ['Saucisse' => 1, 'Pain HotDog' => 1]
            ],
            [
                'nom' => 'Frites', 
                'prix' => 5.00, 
                'desc' => 'Pommes de terre frites maison',
                'ingredients' => ['Pomme de terre' => 0.3] 
            ],
            [
                'nom' => 'Magnum', 
                'prix' => 3.00, 
                'desc' => 'Glace chocolat amande',
                'ingredients' => ['Magnum' => 1]
            ],
            [
                'nom' => 'Coca Cola', 
                'prix' => 2.00, 
                'desc' => 'Canette 33cl',
                'ingredients' => ['Coca Cola' => 1]
            ],
            [
                'nom' => 'Ice Tea', 
                'prix' => 2.00, 
                'desc' => 'Canette 33cl',
                'ingredients' => ['Ice Tea' => 1]
            ]
        ];


        $sqlPlat = "INSERT INTO plats (nom, prix_vente, description, id_restaurateur) VALUES (:nom, :prix, :desc, :id)";
        $stmtPlat = $this->connection->prepare($sqlPlat);

        $sqlFind = "SELECT id_article FROM articles WHERE nom_ingredient = :nom AND id_restaurateur = :id";
        $stmtFind = $this->connection->prepare($sqlFind);

        $sqlCompo = "INSERT INTO composition (id_plat, id_article, quantite) VALUES (:id_plat, :id_art, :qty)";
        $stmtCompo = $this->connection->prepare($sqlCompo);

        foreach ($menu as $plat) {

            $stmtPlat->execute([
                ':nom'  => $plat['nom'], 
                ':prix' => $plat['prix'], 
                ':desc' => $plat['desc'], 
                ':id'   => $idRestaurateur
            ]);
            
            $idPlat = $this->connection->lastInsertId();

            foreach ($plat['ingredients'] as $nomIngred => $qty) {

                $stmtFind->execute([':nom' => $nomIngred, ':id' => $idRestaurateur]);
                $article = $stmtFind->fetch(PDO::FETCH_ASSOC);

                if ($article) {

                    $stmtCompo->execute([
                        ':id_plat' => $idPlat,
                        ':id_art'  => $article['id_article'],
                        ':qty'     => $qty
                    ]);
                }
            }
        }
    }

    // crée le compte et crypte le mdp
    public function inscription(string $nom , string $mail , string $password){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `restaurateur` ( `nom_utilisateur`, `mail`, `password`) VALUES (:nom,:mail,:mdp)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':nom',$nom ,PDO::PARAM_STR);
        $stmt->bindParam(':mail',$mail ,PDO::PARAM_STR);
        $stmt->bindParam(':mdp',$hash ,PDO::PARAM_STR);
        
        if($stmt->execute()){
            $nouvelId = $this->connection->lastInsertId();
            $this->genererStockDeBase($nouvelId);
            $this->genererPlatsDeBase($nouvelId);
            return true;
        }
        else {return false;}
    }
    // cherche si il existe un user avec cet email si oui elle renvoie un objet restaurateur sinon elle renvoie null
    public function findByEmail(string $mail): ?Restaurateur 
    {
        $sql = "SELECT * FROM restaurateur WHERE mail = :mail";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':mail', $mail, \PDO::PARAM_STR);
        $stmt->execute();
        
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return new Restaurateur($data);
        }
        return null; 
    }
    // cherche si il existe un user avec cet email si oui elle renvoie un objet restaurateur sinon elle renvoie null
    public function findByUserName(string $nom): ?Restaurateur 
    {
        $sql = "SELECT * FROM restaurateur WHERE nom_utilisateur = :nom";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':nom', $nom, \PDO::PARAM_STR);
        $stmt->execute();
        
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return new Restaurateur($data);
        }
        return null; 
    }
}