<?php
namespace App\Entity;
use App\Utils\Hydrator;
class LigneCommande {
    use Hydrator;
    private int $id_lignecommande;
    private int $quantite; // Sans accent dans le code PHP
    private int $id_commande;
    private int $id_plat;

    public function __construct(array $data = []) {
            $this->hydrate($data);
        
    }


    public function getIdLigneCommande(): int { return $this->id_lignecommande; }
    public function getQuantite(): int { return $this->quantite; }
    public function getIdCommande(): int { return $this->id_commande; }
    public function getIdPlat(): int { return $this->id_plat; }


    public function setIdLigneCommande(int $id): self { $this->id_lignecommande = $id; return $this; }
    public function setQuantite(int $qty): self { $this->quantite = $qty; return $this; }
    public function setIdCommande(int $id): self { $this->id_commande = $id; return $this; }
    public function setIdPlat(int $id): self { $this->id_plat = $id; return $this; }
}