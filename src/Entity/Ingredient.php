<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nameIngredient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameIngredient(): ?string
    {
        return $this->nameIngredient;
    }

    public function setNameIngredient(string $nameIngredient): static
    {
        $this->nameIngredient = $nameIngredient;

        return $this;
    }
}
