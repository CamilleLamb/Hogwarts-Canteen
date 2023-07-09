<?php

namespace App\Entity;

use App\Repository\ChildrenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChildrenRepository::class)]
class Children
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $lastname = null;

    #[ORM\Column(length: 50)]
    private ?string $firstname = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 30)]
    private ?string $house = null;

    /**
     * getId() : retourne l'identifiant unique de l'enfant
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * getLastname() : retourne le nom de famille de l'enfant
     *
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }
    /**
     * setLastname(string $lastname) : définit le nom de famille de l'enfant
     *
     * @param string $lastname
     * @return static
     */
    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }
    /**
     * getFirstname() : retourne le prénom de l'enfant
     *
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
    /**
     * setFirstname(string $firstname) : définit le prénom de l'enfant
     *
     * @param string $firstname
     * @return static
     */
    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }
    /**
     * setFirstname(string $firstname) : définit le prénom de l'enfant
     *
     * @return integer|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }
    /**
     * setAge(int $age) : définit l'âge de l'enfant
     *
     * @param integer $age
     * @return static
     */
    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }
    /**
     * getHouse() : retourne la maison de l'enfant
     *
     * @return string|null
     */
    public function getHouse(): ?string
    {
        return $this->house;
    }
    /**
     * setHouse(string $house) : définit la maison de l'enfant
     *
     * @param string $house
     * @return static
     */
    public function setHouse(string $house): static
    {
        $this->house = $house;

        return $this;
    }
}
