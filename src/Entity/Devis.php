<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DevisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevisRepository::class)]
#[ApiResource]
class Devis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $cout = null;

    #[ORM\Column(length: 255)]
    private ?string $servicesInclus = null;

    #[ORM\Column(length: 50)]
    private ?string $statut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDevis = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateValiditeDevis = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCout(): ?float
    {
        return $this->cout;
    }

    public function setCout(float $cout): static
    {
        $this->cout = $cout;

        return $this;
    }

    public function getServicesInclus(): ?string
    {
        return $this->servicesInclus;
    }

    public function setServicesInclus(string $servicesInclus): static
    {
        $this->servicesInclus = $servicesInclus;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDateDevis(): ?\DateTimeInterface
    {
        return $this->dateDevis;
    }

    public function setDateDevis(\DateTimeInterface $dateDevis): static
    {
        $this->dateDevis = $dateDevis;

        return $this;
    }

    public function getDateValiditeDevis(): ?\DateTimeInterface
    {
        return $this->dateValiditeDevis;
    }

    public function setDateValiditeDevis(\DateTimeInterface $dateValiditeDevis): static
    {
        $this->dateValiditeDevis = $dateValiditeDevis;

        return $this;
    }
}
