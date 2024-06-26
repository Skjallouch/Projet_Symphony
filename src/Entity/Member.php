<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\OneToOne(mappedBy: 'member', targetEntity: PhysicalTraits::class, cascade: ['persist', 'remove'])]
    private ?PhysicalTraits $physicalTraits = null;

    #[ORM\OneToMany(mappedBy: 'idMember', targetEntity: Address::class, orphanRemoval: true)]
    private Collection $Has;

    #[ORM\ManyToMany(targetEntity: BlogArticle::class, mappedBy: 'isRead')]
    private Collection $viewedArticles;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $resetToken;

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

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt()
    {
        // Vous pouvez laisser cette méthode vide si vous utilisez bcrypt ou argon2i/argon2id.
        return null;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function eraseCredentials() : void
    {
        // ici on erase toutes les données sensibles/confidentielles
    }

    // Voir si on ajoute encore d'autres méthodes ici
    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $token): self
    {
        $this->resetToken = $token;

        return $this;
    }

    public function getPhysicalTraits(): ?PhysicalTraits
    {
        return $this->physicalTraits;
    }

    public function setPhysicalTraits(?PhysicalTraits $physicalTraits): self
    {
        // unset the owning side of the relation if necessary
        if ($physicalTraits === null && $this->physicalTraits !== null) {
            $this->physicalTraits->setMember(null);
        }

        // set the owning side of the relation if necessary
        if ($physicalTraits !== null && $physicalTraits->getMember() !== $this) {
            $physicalTraits->setMember($this);
        }

        $this->physicalTraits = $physicalTraits;

        return $this;
    }

}
