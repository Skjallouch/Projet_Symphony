<?php

namespace App\Entity;

use App\Repository\HomemadeRecipeRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HomemadeRecipeRepository::class)]
class HomemadeRecipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $recipeName = null;

    #[ORM\Column(length: 150)]
    private ?string $hairType = null;

    #[ORM\Column(length: 150)]
    private ?string $effectHair = null;

    #[ORM\Column(type: "text")]
    private ?string $preparation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipeName(): ?string
    {
        return $this->recipeName;
    }

    public function setRecipeName(string $recipeName): static
    {
        $this->recipeName = $recipeName;

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

    public function getEffectHair(): ?string
    {
        return $this->effectHair;
    }

    public function setEffectHair(string $effectHair): static
    {
        $this->effectHair = $effectHair;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): static
    {
        $this->preparation = $preparation;

        return $this;
    }
}
