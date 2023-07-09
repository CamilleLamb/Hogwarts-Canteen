<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping as ORM;
// Définit la table de base de la classe
#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    // Indique que la propriété suivante est une clé primaire
    #[ORM\Id]
    // Indique que la valeur de la clé primaire est générée automatiquement
    #[ORM\GeneratedValue]
    //Indique que la propriété correspondra à une colonne dans la table de base
    #[ORM\Column]
    // Identifiant unique du menu
    private ?int $id = null;
    // Indique que la propriété correspondra à une colonne avec une longueur maximale de 50 caractères
    #[ORM\Column(length: 50)]
    private ?string $name = null;
    // Indique que la propriété correspondra à une colonne dans la table de base
    #[ORM\Column]
    // Prix du menu
    private ?float $price = null;
  
    public function getId(): ?int
    {
        // Retourne l'identifiant unique du menu
        return $this->id;
    }

    public function getName(): ?string
    {
        // Retourne le nom du menu
        return $this->name;
    }

    public function setName(string $name): static
    {
        // Définit le nom du menu
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        // Retourne le prix du menu
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        // Définit le prix du menu
        $this->price = $price;

        return $this;
    }
}
