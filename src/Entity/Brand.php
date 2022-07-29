<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
#[ApiResource(
    collectionOperations: ['get' => ["security" => "is_granted('ROLE_STATS')"]],
    itemOperations: ['get' => ["security" => "is_granted('ROLE_STATS')"]],
)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[
        Assert\NotBlank([
            'message' => 'merci de rentrer un nom de marque'
        ]),
        Assert\Length(
            max: 50
        )
    ]
    private ?string $designation = null;

    #[ORM\OneToMany(mappedBy: 'itemBrand', targetEntity: ItemProduct::class)]
    private Collection $itemProducts;

    public function __construct()
    {
        $this->itemProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

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
            $itemProduct->setItemBrand($this);
        }

        return $this;
    }

    public function removeItemProduct(ItemProduct $itemProduct): self
    {
        if ($this->itemProducts->removeElement($itemProduct)) {
            // set the owning side to null (unless already changed)
            if ($itemProduct->getItemBrand() === $this) {
                $itemProduct->setItemBrand(null);
            }
        }

        return $this;
    }
}
