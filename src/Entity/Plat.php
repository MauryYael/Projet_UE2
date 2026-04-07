<?php
namespace App\Entity;

use App\Utils\Hydrator;

class Plat{
    use Hydrator;
    protected int $id_plat;
    protected string $nom;
    protected float $prix_vente;
    protected string $description;
    protected int $id_restaurateur;
    public function __construct(array $data = [])
    {
    $this->hydrate($data);
    }
    public function getIdPlat(): int {return $this->id_plat;}
    public function setIdPlat(int $id): self {
        $this->id_plat = $id;return $this;}

    public function getNom(): string {return $this->nom;}
    public function setNom(string $nom): self {
        $this->nom = $nom;
        return $this;}

    public function getPrixVente(): float {return $this->prix_vente;}
    public function setPrixVente(float $prix): self {
        $this->prix_vente = $prix;
        return $this;}

        public function getDescription(): string {return $this->description;}
        public function setDescription(string $description): self {
                $this->description = $description;
                return $this;}

    public function getIdRestaurateur(): int {return $this->id_restaurateur;}
    public function setIdRestaurateur(int $id): self {
        $this->id_restaurateur = $id;
        return $this;}
}