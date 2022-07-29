<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ApiResource(
    collectionOperations: ['get' => ["security" => "is_granted('ROLE_ADMIN')"]],
    itemOperations: ['get' => ["security" => "is_granted('ROLE_ADMIN')"]],
)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[
        Assert\Length(
            [

                'max' => 255
            ]
        )
    ]
    private ?string $review = null;

    #[ORM\Column(nullable: true)]
    #[
        Assert\Count(
            [
                'min' => 0,
                'max' => 5,
                'maxMessage' => 'votre note doit etre comprise entre 0 et 5'
            ]

        )
    ]
    private ?int $note = null;

    #[ORM\ManyToOne(inversedBy: 'itemReview')]
    private ?ItemProduct $itemProduct = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    private ?User $ReviewUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(?string $review): self
    {
        $this->review = $review;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getItemProduct(): ?ItemProduct
    {
        return $this->itemProduct;
    }

    public function setItemProduct(?ItemProduct $itemProduct): self
    {
        $this->itemProduct = $itemProduct;

        return $this;
    }

    public function getReviewUser(): ?User
    {
        return $this->ReviewUser;
    }

    public function setReviewUser(?User $ReviewUser): self
    {
        $this->ReviewUser = $ReviewUser;

        return $this;
    }
}
