<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ItemProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ItemProductRepository::class)]
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
class ItemProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[
        Assert\NotBlank([
            'message' => 'merci de donner un Titre'
        ])
    ]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[
        Assert\NotBlank([
            'message' => 'merci de donner une description'
        ]),
        Assert\Length(
            max: 255
        )
    ]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $priceHt = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $tva = null;

    #[ORM\Column(nullable: true)]
    private ?bool $available = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPromo = null;

    #[ORM\OneToMany(mappedBy: 'itemProduct', targetEntity: PicturePath::class)]
    private Collection $itemPicture;

    #[ORM\ManyToOne(inversedBy: 'itemProducts')]
    private ?Brand $itemBrand = null;

    #[ORM\ManyToOne(inversedBy: 'itemProducts')]
    private ?Category $itemCategory = null;

    #[ORM\OneToMany(mappedBy: 'itemProduct', targetEntity: Review::class)]
    private Collection $itemReview;



    #[ORM\OneToMany(mappedBy: 'containItemProduct', targetEntity: Contain::class)]
    private Collection $contains;

    public function __construct()
    {
        $this->itemPicture = new ArrayCollection();
        $this->itemReview = new ArrayCollection();
        $this->itemBasket = new ArrayCollection();
        $this->contains = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceHt(): ?string
    {
        return $this->priceHt;
    }

    public function setPriceHt(?string $priceHt): self
    {
        $this->priceHt = $priceHt;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(string $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(?bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function isIsPromo(): ?bool
    {
        return $this->isPromo;
    }

    public function setIsPromo(?bool $isPromo): self
    {
        $this->isPromo = $isPromo;

        return $this;
    }

    /**
     * @return Collection<int, PicturePath>
     */
    public function getItemPicture(): Collection
    {
        return $this->itemPicture;
    }

    public function addItemPicture(PicturePath $itemPicture): self
    {
        if (!$this->itemPicture->contains($itemPicture)) {
            $this->itemPicture->add($itemPicture);
            $itemPicture->setItemProduct($this);
        }

        return $this;
    }

    public function removeItemPicture(PicturePath $itemPicture): self
    {
        if ($this->itemPicture->removeElement($itemPicture)) {
            // set the owning side to null (unless already changed)
            if ($itemPicture->getItemProduct() === $this) {
                $itemPicture->setItemProduct(null);
            }
        }

        return $this;
    }

    public function getItemBrand(): ?Brand
    {
        return $this->itemBrand;
    }

    public function setItemBrand(?Brand $itemBrand): self
    {
        $this->itemBrand = $itemBrand;

        return $this;
    }

    public function getItemCategory(): ?Category
    {
        return $this->itemCategory;
    }

    public function setItemCategory(?Category $itemCategory): self
    {
        $this->itemCategory = $itemCategory;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getItemReview(): Collection
    {
        return $this->itemReview;
    }

    public function addItemReview(Review $itemReview): self
    {
        if (!$this->itemReview->contains($itemReview)) {
            $this->itemReview->add($itemReview);
            $itemReview->setItemProduct($this);
        }

        return $this;
    }

    public function removeItemReview(Review $itemReview): self
    {
        if ($this->itemReview->removeElement($itemReview)) {
            // set the owning side to null (unless already changed)
            if ($itemReview->getItemProduct() === $this) {
                $itemReview->setItemProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Basket>
     */
    public function getItemBasket(): Collection
    {
        return $this->itemBasket;
    }

    public function addItemBasket(Basket $itemBasket): self
    {
        if (!$this->itemBasket->contains($itemBasket)) {
            $this->itemBasket->add($itemBasket);
        }

        return $this;
    }

    public function removeItemBasket(Basket $itemBasket): self
    {
        $this->itemBasket->removeElement($itemBasket);

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
            $contain->setContainItemProduct($this);
        }

        return $this;
    }

    public function removeContain(Contain $contain): self
    {
        if ($this->contains->removeElement($contain)) {
            // set the owning side to null (unless already changed)
            if ($contain->getContainItemProduct() === $this) {
                $contain->setContainItemProduct(null);
            }
        }

        return $this;
    }
}
