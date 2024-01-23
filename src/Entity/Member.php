<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $firstName = null;

    #[ORM\Column(length: 100)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'idMember', targetEntity: Address::class, orphanRemoval: true)]
    private Collection $Has;

    #[ORM\ManyToMany(targetEntity: BlogArticle::class, mappedBy: 'isRead')]
    private Collection $viewedArticles;

    public function __construct()
    {
        $this->Has = new ArrayCollection();
        $this->viewedArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getHas(): Collection
    {
        return $this->Has;
    }

    public function addHa(Address $ha): static
    {
        if (!$this->Has->contains($ha)) {
            $this->Has->add($ha);
            $ha->setIdMember($this);
        }

        return $this;
    }

    public function removeHa(Address $ha): static
    {
        if ($this->Has->removeElement($ha)) {
            // set the owning side to null (unless already changed)
            if ($ha->getIdMember() === $this) {
                $ha->setIdMember(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BlogArticle>
     */
    public function getViewedArticles(): Collection
    {
        return $this->viewedArticles;
    }

    public function addViewedArticle(BlogArticle $viewedArticle): static
    {
        if (!$this->viewedArticles->contains($viewedArticle)) {
            $this->viewedArticles->add($viewedArticle);
            $viewedArticle->addIsRead($this);
        }

        return $this;
    }

    public function removeViewedArticle(BlogArticle $viewedArticle): static
    {
        if ($this->viewedArticles->removeElement($viewedArticle)) {
            $viewedArticle->removeIsRead($this);
        }

        return $this;
    }
}
