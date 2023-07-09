<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;


    #[ORM\Column(length: 50)]
    private ?string $firstname = null;

    #[ORM\Column]
    private array $role = [];

    #[ORM\Column(length: 50)]
    private ?string $lastname = null;

    // Renvoie l'ID de l'utilisateur
    public function getId(): ?int
    {
        return $this->id;
    }
    // Renvoie l'adresse e-mail de l'utilisateur
    public function getEmail(): ?string
    {
        return $this->email;
    }
    // Définit l'adresse e-mail de l'utilisateur
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Renvoie l'identifiant unique de l'utilisateur, qui est l'adresse e-mail
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * Renvoie les rôles de l'utilisateur. S'assure que l'utilisateur a au moins le rôle ROLE_USER et ajoute ce rôle à la liste des rôles s'il ne l'a pas déjà.
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
    // Définit les rôles de l'utilisateur
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Renvoie le mot de passe hashé de l'utilisateur
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    // Définit le mot de passe hashé de l'utilisateur
    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * // Efface les données sensibles de l'utilisateur. Cette fonction est utilisée pour effacer les données temporaires et sensibles stockées sur l'utilisateur.
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // Si vous stockez des données temporaires et sensibles sur l'utilisateur, effacez-les ici.
        // $this->plainPassword = null;
    }

    // Renvoie le prénom de l'utilisateur
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
    // Définit le prénom de l'utilisateur
    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    // Renvoie les rôles de l'utilisateur
    public function getRole(): array
    {
        return $this->role;
    }
    // Définit les rôles de l'utilisateur
    public function setRole(array $role): static
    {
        $this->role = $role;

        return $this;
    }
    // Renvoie le nom de famille de l'utilisateur
    public function getLastname(): ?string
    {
        return $this->lastname;
    }
    // Définit le nom de famille de l'utilisateur
    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }
}
