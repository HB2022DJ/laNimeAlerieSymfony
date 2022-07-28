<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $review = null;

    #[ORM\Column(nullable: true)]
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
