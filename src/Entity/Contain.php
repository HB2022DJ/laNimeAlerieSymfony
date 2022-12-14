<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContainRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContainRepository::class)]
#[ApiResource(
    collectionOperations: ['get' => ["security" => "is_granted('ROLE_STATS')"]],
    itemOperations: ['get' => ["security" => "is_granted('ROLE_STATS')"]],
)]
class Contain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[
        Assert\GreaterThanOrEqual(0),
    ]
    private ?string $unitPrice = null;

    #[ORM\ManyToOne(inversedBy: 'contains')]
    private ?Basket $ContainBasket = null;

    #[ORM\ManyToOne(inversedBy: 'contains')]
    private ?ItemProduct $containItemProduct = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnitPrice(): ?string
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(string $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getContainBasket(): ?Basket
    {
        return $this->ContainBasket;
    }

    public function setContainBasket(?Basket $ContainBasket): self
    {
        $this->ContainBasket = $ContainBasket;

        return $this;
    }

    public function getContainItemProduct(): ?ItemProduct
    {
        return $this->containItemProduct;
    }

    public function setContainItemProduct(?ItemProduct $containItemProduct): self
    {
        $this->containItemProduct = $containItemProduct;

        return $this;
    }
}
