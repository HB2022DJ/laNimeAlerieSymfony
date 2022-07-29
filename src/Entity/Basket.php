<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BasketRepository::class)]
#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'put', 'delete'],
)]
class Basket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $basketAt = null;

    #[ORM\Column(length: 12, nullable: true)]
    #[
        Assert\NotBlank(),
        Assert\Length(
            max: 12
        )
    ]
    private ?string $number = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $billingAt = null;



    #[ORM\OneToMany(mappedBy: 'ContainBasket', targetEntity: Contain::class)]
    private Collection $contains;

    #[ORM\ManyToOne(inversedBy: 'baskets')]
    private ?User $BasketUser = null;

    #[ORM\ManyToOne(inversedBy: 'baskets')]
    private ?StatusCommand $BasketStatus = null;

    #[ORM\OneToMany(mappedBy: 'basket', targetEntity: PaymentMethod::class)]
    private Collection $BasketPayment;

    public function __construct()
    {
        $this->itemProducts = new ArrayCollection();
        $this->contains = new ArrayCollection();
        $this->BasketPayment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBasketAt(): ?\DateTimeInterface
    {
        return $this->basketAt;
    }

    public function setBasketAt(?\DateTimeInterface $basketAt): self
    {
        $this->basketAt = $basketAt;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getBillingAt(): ?\DateTimeInterface
    {
        return $this->billingAt;
    }

    public function setBillingAt(?\DateTimeInterface $billingAt): self
    {
        $this->billingAt = $billingAt;

        return $this;
    }

    /**
     * @return Collection<int, ItemProduct>
     */
    public function getItemProducts(): Collection
    {
        return $this->itemProducts;
    }

    public function addItemProduct(ItemProduct $itemProduct): self
    {
        if (!$this->itemProducts->contains($itemProduct)) {
            $this->itemProducts->add($itemProduct);
            $itemProduct->addItemBasket($this);
        }

        return $this;
    }

    public function removeItemProduct(ItemProduct $itemProduct): self
    {
        if ($this->itemProducts->removeElement($itemProduct)) {
            $itemProduct->removeItemBasket($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Contain>
     */
    public function getContains(): Collection
    {
        return $this->contains;
    }

    public function addContain(Contain $contain): self
    {
        if (!$this->contains->contains($contain)) {
            $this->contains->add($contain);
            $contain->setContainBasket($this);
        }

        return $this;
    }

    public function removeContain(Contain $contain): self
    {
        if ($this->contains->removeElement($contain)) {
            // set the owning side to null (unless already changed)
            if ($contain->getContainBasket() === $this) {
                $contain->setContainBasket(null);
            }
        }

        return $this;
    }

    public function getBasketUser(): ?User
    {
        return $this->BasketUser;
    }

    public function setBasketUser(?User $BasketUser): self
    {
        $this->BasketUser = $BasketUser;

        return $this;
    }

    public function getBasketStatus(): ?StatusCommand
    {
        return $this->BasketStatus;
    }

    public function setBasketStatus(?StatusCommand $BasketStatus): self
    {
        $this->BasketStatus = $BasketStatus;

        return $this;
    }

    /**
     * @return Collection<int, PaymentMethod>
     */
    public function getBasketPayment(): Collection
    {
        return $this->BasketPayment;
    }

    public function addBasketPayment(PaymentMethod $basketPayment): self
    {
        if (!$this->BasketPayment->contains($basketPayment)) {
            $this->BasketPayment->add($basketPayment);
            $basketPayment->setBasket($this);
        }

        return $this;
    }

    public function removeBasketPayment(PaymentMethod $basketPayment): self
    {
        if ($this->BasketPayment->removeElement($basketPayment)) {
            // set the owning side to null (unless already changed)
            if ($basketPayment->getBasket() === $this) {
                $basketPayment->setBasket(null);
            }
        }

        return $this;
    }
}
