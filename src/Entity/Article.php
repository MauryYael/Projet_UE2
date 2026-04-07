<?php
namespace App\Entity;

use App\Utils\Hydrator;

class Article{
    use Hydrator;
    protected int $id_article;
    protected string $nom_ingredient;
    protected string $type;
    protected float $stock_actuel;
    protected float $seuil_alerte;
    protected string $unite;
    protected int $id_restaurateur;
    public function __construct(array $data = [])
    {
    $this->hydrate($data);
    }
    public function getIdArticle(): int {return $this->id_article;}
    public function setIdArticle(int $id): self {
        $this->id_article = $id;return $this;}

    public function getNomIngredient(): string {return $this->nom_ingredient;}
    public function setNomIngredient(string $nom): self {
        $this->nom_ingredient = $nom;
        return $this;}

    public function getType(): string {return $this->type;}
    public function setType(string $type): self {
        $this->type = $type;
        return $this;}

        public function getStockActuel(): float {return $this->stock_actuel;}
        public function setStockActuel(float $stock): self {
                $this->stock_actuel = $stock;
                return $this;}

    public function getSeuilAlerte(): float {return $this->seuil_alerte;}
    public function setSeuilAlerte(float $seuil): self {
        $this->seuil_alerte = $seuil;
        return $this;}

    public function getUnite(): string {return $this->unite;}
    public function setUnite(string $unite): self {
        $this->unite = $unite;
        return $this;}

    public function getIdRestaurateur(): int {return $this->id_restaurateur;}
    public function setIdRestaurateur(int $id): self {
        $this->id_restaurateur = $id;
        return $this;}
}