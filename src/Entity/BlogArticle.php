<?php

namespace App\Entity;

use App\Repository\BlogArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogArticleRepository::class)]
class BlogArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $title = null;

    #[ORM\Column(length: 150000)]
    private ?string $content = null;

    #[ORM\Column(length: 150)]
    private ?string $authorName = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $hairColor = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $hairLength = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $haircut = null;

    #[ORM\ManyToMany(targetEntity: Member::class, inversedBy: 'viewedArticles')]
    private Collection $isRead;

    public function __construct()
    {
        $this->isRead = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): static
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    public function setHairColor(?string $hairColor): static
    {
        $this->hairColor = $hairColor;

        return $this;
    }

    public function getHairLength(): ?string
    {
        return $this->hairLength;
    }

    public function setHairLength(?string $hairLength): static
    {
        $this->hairLength = $hairLength;

        return $this;
    }

    public function getHaircut(): ?string
    {
        return $this->haircut;
    }

    public function setHaircut(?string $haircut): static
    {
        $this->haircut = $haircut;

        return $this;
    }

    /**
     * @return Collection<int, Member>
     */
    public function getIsRead(): Collection
    {
        return $this->isRead;
    }

    public function addIsRead(Member $isRead): static
    {
        if (!$this->isRead->contains($isRead)) {
            $this->isRead->add($isRead);
        }

        return $this;
    }

    public function removeIsRead(Member $isRead): static
    {
        $this->isRead->removeElement($isRead);

        return $this;
    }
}
