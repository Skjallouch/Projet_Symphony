<?php

namespace App\Entity;

use App\Repository\PhysicalTraitsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhysicalTraitsRepository::class)]
class PhysicalTraits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $faceShape = null;

    #[ORM\Column(length: 150)]
    private ?string $eyeColor = null;

    #[ORM\Column(length: 150)]
    private ?string $skinColor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFaceShape(): ?string
    {
        return $this->faceShape;
    }

    public function setFaceShape(string $faceShape): static
    {
        $this->faceShape = $faceShape;

        return $this;
    }

    public function getEyeColor(): ?string
    {
        return $this->eyeColor;
    }

    public function setEyeColor(string $eyeColor): static
    {
        $this->eyeColor = $eyeColor;

        return $this;
    }

    public function getSkinColor(): ?string
    {
        return $this->skinColor;
    }

    public function setSkinColor(string $skinColor): static
    {
        $this->skinColor = $skinColor;

        return $this;
    }
}
