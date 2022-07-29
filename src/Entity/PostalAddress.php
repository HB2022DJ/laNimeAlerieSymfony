<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostalAddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostalAddressRepository::class)]
#[ApiResource(
    collectionOperations: ['get' => ["security" => "is_granted('ROLE_STATS')"]],
    itemOperations: ['get' => ["security" => "is_granted('ROLE_STATS')"]],
)]
class PostalAddress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[
        Assert\Length([
            'min' => 5,
            'max' => 50,
        ]),
        Assert\NotBlank(),
    ]
    private ?string $lineOne = null;

    #[ORM\Column(length: 50, nullable: true)]

    private ?string $lineTwo = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $lineThree = null;

    #[ORM\Column(nullable: true)]
    #[
        Assert\NotBlank(),
    ]
    private ?string $postalCode = null;

    #[ORM\Column(length: 150, nullable: true)]
    #[
        Assert\NotBlank(),
    ]
    private ?string $city = null;

    #[ORM\OneToMany(mappedBy: 'userPostalAddress', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLineOne(): ?string
    {
        return $this->lineOne;
    }

    public function setLineOne(?string $lineOne): self
    {
        $this->lineOne = $lineOne;

        return $this;
    }

    public function getLineTwo(): ?string
    {
        return $this->lineTwo;
    }

    public function setLineTwo(?string $lineTwo): self
    {
        $this->lineTwo = $lineTwo;

        return $this;
    }

    public function getLineThree(): ?string
    {
        return $this->lineThree;
    }

    public function setLineThree(?string $lineThree): self
    {
        $this->lineThree = $lineThree;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setUserPostalAddress($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getUserPostalAddress() === $this) {
                $user->setUserPostalAddress(null);
            }
        }

        return $this;
    }
}
