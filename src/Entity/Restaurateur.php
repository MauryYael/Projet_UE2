<?php
namespace App\Entity;
use App\Utils\Hydrator;
class Restaurateur{
    use Hydrator;
    protected int $id_restaurateur;
    protected string $nom_utilisateur;
    protected string $mail;
    protected string $password;
    public function __construct(array $data = []) {
        $this->hydrate($data);
    }
    public function getIdRestaurateur(): int {return $this->id_restaurateur;}
    public function setIdRestaurateur(int $id): self {
        $this->id_restaurateur = $id;return $this;}

    public function getNomUtilisateur(): string {return $this->nom_utilisateur;}
    public function setNomUtilisateur(string $nom): self {
        $this->nom_utilisateur = $nom;
        return $this;}

    public function getMail(): string {return $this->mail;}
    public function setMail(string $mail): self {
        $this->mail = $mail;
        return $this;}

    public function getPassword(): string {return $this->password;}
    public function setPassword(string $password): self {
                $this->password = $password;
                return $this;}

}












?>