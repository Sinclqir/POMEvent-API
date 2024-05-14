<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AbonnementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonnementRepository::class)]
#[ApiResource]
class Abonnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomAbonnement = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $tarif = null;

    #[ORM\Column]
    private ?int $dureeEnMois = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $avantages = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $remises = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAbonnement(): ?string
    {
        return $this->nomAbonnement;
    }

    public function setNomAbonnement(string $nomAbonnement): static
    {
        $this->nomAbonnement = $nomAbonnement;

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

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): static
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getDureeEnMois(): ?int
    {
        return $this->dureeEnMois;
    }

    public function setDureeEnMois(int $dureeEnMois): static
    {
        $this->dureeEnMois = $dureeEnMois;

        return $this;
    }

    public function getAvantages(): ?string
    {
        return $this->avantages;
    }

    public function setAvantages(string $avantages): static
    {
        $this->avantages = $avantages;

        return $this;
    }

    public function getRemises(): ?string
    {
        return $this->remises;
    }

    public function setRemises(?string $remises): static
    {
        $this->remises = $remises;

        return $this;
    }
}
