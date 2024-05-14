<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\Column]
    private ?bool $dateEnvoi = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fichierJoint = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function isDateEnvoi(): ?bool
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(bool $dateEnvoi): static
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    public function getFichierJoint(): ?string
    {
        return $this->fichierJoint;
    }

    public function setFichierJoint(?string $fichierJoint): static
    {
        $this->fichierJoint = $fichierJoint;

        return $this;
    }

}
