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

    #[ORM\OneToOne(inversedBy: 'physicalTraits', targetEntity: Member::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Member $member = null;

    #[ORM\OneToOne(targetEntity: Hair::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hair $hair = null;


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

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(Member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getHair(): ?Hair
    {
        return $this->hair;
    }

    public function setHair(Hair $hair): self
    {
        $this->hair = $hair;

        return $this;
    }

}
