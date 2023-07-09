<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * Récupère l'ID de l'inscription
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * Récupère la date de l'inscription
     *
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }
    /**
     * Définit la date de l'inscription
     *
     * @param \DateTimeInterface $date
     * @return static
     */
    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
}
