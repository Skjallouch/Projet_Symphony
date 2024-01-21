<?php

namespace App\Entity;

use App\Repository\RecommendationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecommendationRepository::class)]
class Recommendation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $HairCut = null;

    #[ORM\Column(length: 150)]
    private ?string $Length = null;

    #[ORM\Column(length: 150)]
    private ?string $Color = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHairCut(): ?string
    {
        return $this->HairCut;
    }

    public function setHairCut(string $HairCut): static
    {
        $this->HairCut = $HairCut;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->Length;
    }

    public function setLength(string $Length): static
    {
        $this->Length = $Length;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->Color;
    }

    public function setColor(string $Color): static
    {
        $this->Color = $Color;

        return $this;
    }
}
