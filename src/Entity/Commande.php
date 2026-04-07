<?php
namespace App\Entity;
use App\Utils\Hydrator;

class Commande {
    use Hydrator;
    private int $id_commande;
    private string $date_commande;
    private string $statut;
    private int $id_restaurateur;

    public function __construct(array $data = []) {
            $this->hydrate($data);
    }



    // Getters
    public function getIdCommande(): int { return $this->id_commande; }
    public function getDateCommande(): string { return $this->date_commande; }
    public function getStatut(): string { return $this->statut; }
    public function getIdRestaurateur(): int { return $this->id_restaurateur; }

    // Setters
    public function setIdCommande(int $id): self { $this->id_commande = $id; return $this; }
    public function setDateCommande(string $date): self { $this->date_commande = $date; return $this; }
    public function setStatut(string $statut): self { $this->statut = $statut; return $this; }
    public function setIdRestaurateur(int $id): self { $this->id_restaurateur = $id; return $this; }
}