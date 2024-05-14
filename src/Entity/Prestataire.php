<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PrestataireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: PrestataireRepository::class)]
#[ApiResource]
class Prestataire implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomEntreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPrestataire = null;

    #[ORM\Column(length: 255)]
    private ?string $typeService = null;

    #[ORM\Column(length: 255)]
    private ?string $competences = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $portfolio = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $motDePasse = null;

    #[ORM\Column(length: 14, unique: true)]
    private ?string $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $pseudo = null;

    #[ORM\Column]
    private ?bool $disponible = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDisponibilite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): static
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    public function getNomPrestataire(): ?string
    {
        return $this->nomPrestataire;
    }

    public function setNomPrestataire(string $nomPrestataire): static
    {
        $this->nomPrestataire = $nomPrestataire;

        return $this;
    }

    public function getTypeService(): ?string
    {
        return $this->typeService;
    }

    public function setTypeService(string $typeService): static
    {
        $this->typeService = $typeService;

        return $this;
    }

    public function getCompetences(): ?string
    {
        return $this->competences;
    }

    public function setCompetences(string $competences): static
    {
        $this->competences = $competences;

        return $this;
    }

    public function getPortfolio(): ?string
    {
        return $this->portfolio;
    }

    public function setPortfolio(?string $portfolio): static
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }


    public function isdisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setdisponible(bool $disponible): static
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getDateDisponibilite(): ?\DateTimeInterface
    {
        return $this->dateDisponibilite;
    }

    public function setDateDisponibilite(?\DateTimeInterface $dateDisponibilite): static
    {
        $this->dateDisponibilite = $dateDisponibilite;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }



    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;
        return $this;
    }
    // Methods required by UserInterface
    public function getRoles(): array
    {
        // Return user roles
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
        // Clean up sensitive temporary data here
    }

    public function getUserIdentifier(): string
    {
        return $this->email; 
    }

    public function getPassword(): string
    {
        return $this->motDePasse;
    }


    public function setPassword(string $motDePasse): static
    {
        $this->motDePasse = $motDePasse;
        return $this;
    }
}
