<?php

namespace App\Entity;

use App\Repository\HairRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HairRepository::class)]
class Hair
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $hairLength = null;

    #[ORM\Column(length: 150)]
    private ?string $hairType = null;

    #[ORM\Column]
    private ?bool $Decoloration = null;

    #[ORM\Column(length: 150)]
    private ?string $hairColor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHairLength(): ?string
    {
        return $this->hairLength;
    }

    public function setHairLength(string $hairLength): static
    {
        $this->hairLength = $hairLength;

        return $this;
    }

    public function getHairType(): ?string
    {
        return $this->hairType;
    }

    public function setHairType(string $hairType): static
    {
        $this->hairType = $hairType;

        return $this;
    }

    public function isDecoloration(): ?bool
    {
        return $this->Decoloration;
    }

    public function setDecoloration(bool $Decoloration): static
    {
        $this->Decoloration = $Decoloration;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    public function setHairColor(string $hairColor): static
    {
        $this->hairColor = $hairColor;

        return $this;
    }
}
