<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DemandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
#[ApiResource]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDemande = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $preferences = null;

    #[ORM\Column]
    private ?float $budget = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $documents = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionDetaillee = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photos = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $videos = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): static
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getPreferences(): ?string
    {
        return $this->preferences;
    }

    public function setPreferences(?string $preferences): static
    {
        $this->preferences = $preferences;

        return $this;
    }

    public function getBudget(): ?float
    {
        return $this->budget;
    }

    public function setBudget(float $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getDocuments(): ?string
    {
        return $this->documents;
    }

    public function setDocuments(?string $documents): static
    {
        $this->documents = $documents;

        return $this;
    }

    public function getDescriptionDetaillee(): ?string
    {
        return $this->descriptionDetaillee;
    }

    public function setDescriptionDetaillee(string $descriptionDetaillee): static
    {
        $this->descriptionDetaillee = $descriptionDetaillee;

        return $this;
    }

    public function getPhotos(): ?string
    {
        return $this->photos;
    }

    public function setPhotos(?string $photos): static
    {
        $this->photos = $photos;

        return $this;
    }

    public function getVideos(): ?string
    {
        return $this->videos;
    }

    public function setVideos(?string $videos): static
    {
        $this->videos = $videos;

        return $this;
    }
}
