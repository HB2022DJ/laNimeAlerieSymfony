<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    collectionOperations: ['get' => ["security" => "is_granted('ROLE_STATS') or is_granted('ROLE_ADMIN') "]],
    //  'post' => ["security" => "is_granted('ROLE_ADMIN')"],
    itemOperations: [
        'get' => ["security" => "is_granted('ROLE_STATS') or is_granted('ROLE_ADMIN')"],
        //  'delete' => ["security" => "is_granted('ROLE_ADMIN')"],
        //  'put' => ["security" => "is_granted('ROLE_ADMIN')"],
    ],
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[
        Assert\Length([
            'min' => 5,
            'max' => 180,
        ]),
        Assert\NotBlank(),
        Assert\Email(
            [

                'message' => 'merci de remplir avec un email valide'
            ]
        )
    ]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[
        Assert\NotBlank,

    ]
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[
        Assert\Length([
            'min' => 5,
            'max' => 50,
        ]),
        Assert\NotBlank(),

    ]
    private ?string $lastName = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[
        Assert\Length([
            'min' => 4,
            'max' => 50,
        ]),
        Assert\NotBlank(),

    ]
    private ?string $firstName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[
        Assert\Expression('this.getBirthAT() < this.getCreatedAt()'),
        Assert\NotBlank([
            'message' => 'Merci de remplir la date',
        ]),
        Assert\LessThan('today'),
        Assert\GreaterThan('2003-01-01')
    ]
    private ?\DateTimeInterface $birthAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    // #[
    //     Assert\NotBlank([
    //         'message' => 'Merci de remplir la date',
    //     ]),
    //     Assert\LessThan('today'),

    // ]
    private ?\DateTimeInterface $registrationAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $genre = null;

    #[ORM\OneToMany(mappedBy: 'ReviewUser', targetEntity: Review::class)]
    private Collection $reviews;

    #[ORM\OneToMany(mappedBy: 'BasketUser', targetEntity: Basket::class)]
    private Collection $baskets;

    #[ORM\ManyToOne(inversedBy: 'users')]
    // #[
    //     Assert\NotBlank()
    // ]
    private ?PostalAddress $userPostalAddress = null;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->baskets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getBirthAt(): ?\DateTimeInterface
    {
        return $this->birthAt;
    }

    public function setBirthAt(\DateTimeInterface $birthAt): self
    {
        $this->birthAt = $birthAt;

        return $this;
    }

    public function getRegistrationAt(): ?\DateTimeInterface
    {
        return $this->registrationAt;
    }

    public function setRegistrationAt(\DateTimeInterface $registrationAt): self
    {
        $this->registrationAt = $registrationAt;

        return $this;
    }

    public function isGenre(): ?bool
    {
        return $this->genre;
    }

    public function setGenre(?bool $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setReviewUser($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getReviewUser() === $this) {
                $review->setReviewUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Basket>
     */
    public function getBaskets(): Collection
    {
        return $this->baskets;
    }

    public function addBasket(Basket $basket): self
    {
        if (!$this->baskets->contains($basket)) {
            $this->baskets->add($basket);
            $basket->setBasketUser($this);
        }

        return $this;
    }

    public function removeBasket(Basket $basket): self
    {
        if ($this->baskets->removeElement($basket)) {
            // set the owning side to null (unless already changed)
            if ($basket->getBasketUser() === $this) {
                $basket->setBasketUser(null);
            }
        }

        return $this;
    }

    public function getUserPostalAddress(): ?PostalAddress
    {
        return $this->userPostalAddress;
    }

    public function setUserPostalAddress(?PostalAddress $userPostalAddress): self
    {
        $this->userPostalAddress = $userPostalAddress;

        return $this;
    }
}
