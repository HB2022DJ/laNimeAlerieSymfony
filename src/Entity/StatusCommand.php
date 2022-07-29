<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StatusCommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StatusCommandRepository::class)]
#[ApiResource(
    collectionOperations: ['get' => ["security" => "is_granted('ROLE_STATS') or is_granted('ROLE_ADMIN') "]],
    itemOperations: ['get' => ["security" => "is_granted('ROLE_STATS') or is_granted('ROLE_ADMIN')"]],
)]
class StatusCommand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[
        Assert\Choice([
            'choices' => [
                'Réussi',
                'Echoué',
            ]
        ])
    ]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'BasketStatus', targetEntity: Basket::class)]
    private Collection $baskets;

    public function __construct()
    {
        $this->baskets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

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
            $basket->setBasketStatus($this);
        }

        return $this;
    }

    public function removeBasket(Basket $basket): self
    {
        if ($this->baskets->removeElement($basket)) {
            // set the owning side to null (unless already changed)
            if ($basket->getBasketStatus() === $this) {
                $basket->setBasketStatus(null);
            }
        }

        return $this;
    }
}
