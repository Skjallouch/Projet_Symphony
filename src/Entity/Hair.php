<?php

namespace App\Entity;

use App\Repository\HairRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 150)]
    private ?string $coloration = null;

    #[ORM\Column(length: 150)]
    private ?string $cutcut = null;

    #[ORM\Column(length: 150)]
    private ?string $hairColor = null;

    #[ORM\ManyToMany(targetEntity: HairProduct::class)]
    private Collection $Use;

    #[ORM\OneToOne(mappedBy: "hair", targetEntity: PhysicalTraits::class)]
    private ?PhysicalTraits $physicalTraits = null;

    public function __construct()
    {
        $this->Use = new ArrayCollection();
    }

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

    public function getColoration(): ?string
    {
        return $this->coloration;
    }

    public function setColoration(string $coloration): static
    {
        $this->coloration = $coloration;

        return $this;
    }

    public function getCutcut(): ?string
    {
        return $this->cutcut;
    }

    public function setCutcut(string $cutcut): static
    {
        $this->cutcut = $cutcut;

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

    public function getPhysicalTraits(): ?PhysicalTraits
    {
        return $this->physicalTraits;
    }

    public function setPhysicalTraits(?PhysicalTraits $physicalTraits): self
    {
        if ($physicalTraits === null && $this->physicalTraits !== null) {
            $this->physicalTraits->setHair(null);
        }

        // set the owning side of the relation if necessary
        if ($physicalTraits !== null && $physicalTraits->getMember() !== $this) {
            $physicalTraits->setHair($this);
        }

        $this->physicalTraits = $physicalTraits;

        return $this;
    }

    /**
     * @return Collection<int, HairProduct>
     */
    public function getUse(): Collection
    {
        return $this->Use;
    }

    public function addUse(HairProduct $use): static
    {
        if (!$this->Use->contains($use)) {
            $this->Use->add($use);
        }

        return $this;
    }

    public function removeUse(HairProduct $use): static
    {
        $this->Use->removeElement($use);

        return $this;
    }
}
