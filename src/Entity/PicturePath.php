<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PicturePathRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PicturePathRepository::class)]
#[ApiResource(
    collectionOperations: ['get' => ["security" => "is_granted('ROLE_STATS')"]],
    itemOperations: ['get' => ["security" => "is_granted('ROLE_STATS')"]],
)]
class PicturePath
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, nullable: true)]
    #[
        Assert\Length(
            max: 150,
        )
    ]
    private ?string $relativePath = null;

    #[ORM\ManyToOne(inversedBy: 'itemPicture')]
    private ?ItemProduct $itemProduct = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRelativePath(): ?string
    {
        return $this->relativePath;
    }

    public function setRelativePath(?string $relativePath): self
    {
        $this->relativePath = $relativePath;

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
}
