<?php

namespace App\Entity;

use App\Repository\HairProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HairProductRepository::class)]
class HairProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $productName = null;

    #[ORM\Column(length: 150)]
    private ?string $hairType = null;

    #[ORM\Column(length: 150)]
    private ?string $hairEffect = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $stock = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): static
    {
        $this->productName = $productName;

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

    public function getHairEffect(): ?string
    {
        return $this->hairEffect;
    }

    public function setHairEffect(string $hairEffect): static
    {
        $this->hairEffect = $hairEffect;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }
}
