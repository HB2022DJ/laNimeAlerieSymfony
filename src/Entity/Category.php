<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30, nullable: true)]
    #[
        Assert\NotBlank([
            'message' => 'merci de donner un nom à votre categorie'
        ]),
        Assert\Length(
            max: 30
        )
    ]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'itemCategory', targetEntity: ItemProduct::class)]
    private Collection $itemProducts;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categories')]
    private ?self $categoryCategory = null; //parent

    #[ORM\OneToMany(mappedBy: 'categoryCategory', targetEntity: self::class)]
    private Collection $categories; //children

    public function __construct()
    {
        $this->itemProducts = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

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
            $itemProduct->setItemCategory($this);
        }

        return $this;
    }

    public function removeItemProduct(ItemProduct $itemProduct): self
    {
        if ($this->itemProducts->removeElement($itemProduct)) {
            // set the owning side to null (unless already changed)
            if ($itemProduct->getItemCategory() === $this) {
                $itemProduct->setItemCategory(null);
            }
        }

        return $this;
    }

    public function getCategoryCategory(): ?self
    {
        return $this->categoryCategory;
    }

    public function setCategoryCategory(?self $categoryCategory): self
    {
        $this->categoryCategory = $categoryCategory;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setCategoryCategory($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategoryCategory() === $this) {
                $category->setCategoryCategory(null);
            }
        }

        return $this;
    }
}
