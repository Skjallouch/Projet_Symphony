<?php

namespace App\Entity;

use App\Repository\EvaluationRecipeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRecipeRepository::class)]
class EvaluationRecipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mark = null;

    #[ORM\Column(length: 255)]
    private ?string $titleComment = null;

    #[ORM\Column(length: 1000)]
    private ?string $comment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(int $mark): static
    {
        $this->mark = $mark;

        return $this;
    }

    public function getTitleComment(): ?string
    {
        return $this->titleComment;
    }

    public function setTitleComment(string $titleComment): static
    {
        $this->titleComment = $titleComment;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }
}
